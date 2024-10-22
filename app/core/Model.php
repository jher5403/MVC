<?php
namespace Model;

defined('ROOTPATH') OR exit('Error: Access denied.');

/**
 * Handles queries for specific tables.
 * Contains additional parameters for queries.
 */
Trait Model
{
    use \Database;
    protected $limit = 30;                  // Amount of queries performed.
    protected $offset = 0;                  // Dunno what for
    // ORDER BY column1 DESC, column2
    protected $order = ['column' => 'blog_id', 'type' => 'asc'];
    //protected $table;                     // Table used in query. **MUST BE DEFINED BY SUB CLASS**
    // Might implement primary key for queries.

    /**
     * A complicated select where function that uses arrays for queries.
     * Will select all attributes from the row IF defined by the $data array.
     * Will also filter the query based on the $filter array.
     * 
     * Use whereSimple for a more straightforward selection function.
     * 
     * Example Query: 
     * 
     * 'SELECT * FROM users WHERE email= :email && first_name= :first_name && reset_token!= :reset_token'
     * 
     * @param mixed $data
     * 
     * Array of keys your searching for.
     * 
     * @param array $filter
     *
     * Array of keys your filtering out.
     */
    public function where($data, $filter = []) 
    {
        $keys = array_keys($data);
        $filter_keys = array_keys($filter);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . '= :' . $key . ' && ';
        }

        foreach ($filter_keys as $key) {
            $query .= $key . '!= :' . $key . ' && ';
        }

        $query = trim($query, ' && ');
        //$query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        $data_merge = array_merge($data, $filter);

        $result = $this->query($query, $data_merge);

        return $result;
        
    }

    /**
     * A straightforward select where query function.
     * Selects and filters using strings.
     * 
     * @param string $attributes
     * String of attributes to select.
     * 
     * @param string $filter
     * String of conditions to filter.
     * 
     */
    public function whereSimple(string $attributes, string $filter) 
    {
        $query = "SELECT $attributes FROM $this->table WHERE $filter";
        //show($query);
        $result = $this->query($query);

        return $result;
    }

    /**
     * Select all rows between a given attribute range.
     * It's not very intuitive so I'll probably end up changing this
     * or making a whole different method instead.
     * 
     * SELECT * FROM `blogs` WHERE privacy_filter = 'public' AND (event_date BETWEEN '2024-05-10' AND '2024-08-07');
     * SELECT * FROM `blogs` WHERE privacy_filter = 'public' AND (title LIKE '%$a%') AND (event_date BETWEEN '2024-05-10' AND '2024-08-07'); 
     */
    public function between($col, $min, $max, $sort, $title) {
        $query = "SELECT * FROM $this->table WHERE privacy_filter = 'public' ";

        if ($title !== '') {
            $query .= "AND (title LIKE '%$title%') ";
        }

        if (($max !== '') && ($min !== '') && ($col !== '')) 
        {
            $query .= "AND $col BETWEEN '{$min}' AND '{$max}' ";
        }
        $query .= "ORDER BY ".$sort;

        return $this->query($query);
    }

    /**
     * Returns all rows from a table.
     */
    public function findAll()
    {
        $query = "SELECT * FROM $this->table  ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        return $this->query($query);
    }

    /**
     * Returns the first element of a query.
     */
    public function first($data, $filter = [])
    {
        $keys = array_keys($data);
        $filter_keys = array_keys($filter);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . '= :' . $key . ' && ';
        }

        foreach ($filter_keys as $key) {
            $query .= $key . '!= :' . $key . ' && ';
        }

        $query = trim($query, ' && ');
        $query .= " LIMIT $this->limit OFFSET $this->offset";
        $data_merge = array_merge($data, $filter);

        $result = $this->query($query, $data_merge);
        if ($result) {
            return $result[0];
        }
        return false;
    }
    
    /**
     * Inserts a row into a table.
     * 
     * @param array $data
     * Array of row attributes to insert.
     */
    public function insert($data)
    {
        if(!empty($this->allowed_columns)) {
            foreach ($data as $key => $value) {
                if(!in_array($key, $this->allowed_columns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (".implode(',', $keys).") VALUES (:".implode(',:', $keys).")";
        //echo $query;
        $this->query($query, $data);
        
        return false;
    }

    /**
     * Performs an update query.
     * 
     * @example update(11, $data, 'blog_id')
     *      11      | The ID of the blog your updaing
     *      $data   | data{['creator_email' => 'bob@email.com'], ['blog_id' => 11], ...}
     *      blog_id | The primary key attribute to match to the ID.
     * 
     * @param mixed $id
     * The value of the column your updating.
     * 
     * @param Array $data
     * Collection of key-value pairs.
     * 
     * @param mixed $id_col
     * The primary key of the table.
     */
    public function update($id, $data, $id_col='id')
    {
        if(!empty($this->allowed_columns)) 
        {
            foreach ($data as $key => $value) {
                if(!in_array($key, $this->allowed_columns)) {
                    unset($data[$key]);
                }
            }
        }
        
        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";

        foreach ($keys as $key) {
            $query .= $key . '= :' . $key . ', ';
        }

        $query = trim($query, ', ');
        $query .= " WHERE $id_col = :$id_col ";

        $data[$id_col] = $id; // Has to go near end for some reason.
        return $this->query($query, $data);

        //Old return value
        return false;
    }

    /**
     * Deletes a given row.
     * 
     * @param mixed $id
     * The value of the primary key for the row.
     * 
     * @param mixed $id_col
     * Column of id to delete.
     * 
     * @example {
     * delete(11, 'blog_id')
     * Deletes blog whose blog_id == 11
     */
    public function delete($id, $id_col='id')
    {
        $data[$id_col] = $id;
        $query = "DELETE FROM $this->table WHERE $id_col = :$id_col ";
        return $this->query($query, $data);

        return false;
    }
}