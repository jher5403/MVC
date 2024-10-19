<?php
namespace Model;

defined('ROOTPATH') OR exit('Error: Access denied.');

Trait Model
{
    use \Database;
    protected $limit = 30;                  // Amount of queries performed.
    protected $offset = 0;                  // Dunno what for
    protected $order_type = 'asc';          // Can be desc, or asc,
    protected $order_column = 'blog_id';    // What attribute to order by,
    // ORDER BY column1 DESC, column2
    protected $order = ['column' => 'blog_id', 'type' => 'asc'];
    //protected $table;                     // Table used in query. **MUST BE DEFINED BY SUB CLASS**

    /**
     * 
     * $data: Array of keys your searching for.
     * $filter: Array of keys your filtering out.
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
        $query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        $data_merge = array_merge($data, $filter);

        $result = $this->query($query, $data_merge);

        return $result;
        
    }

    /**
     * Select all rows between a given attribute range.
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
        //show($query);

        return $this->query($query);
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->table  ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        return $this->query($query);
    }

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
        $this->query($query, $data);
        
        return false;
    }

    public function update($id, $data, $id_col='blog_id')
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
        $query .= " where $id_col = :$id_col ";

        $data[$id_col] = $id; // Has to go near end for some reason.
        $this->query($query, $data);

        return false;
    }

    public function delete($id, $id_col='blog_id')
    {
        $data[$id_col] = $id;
        $query = "DELETE FROM $this->table WHERE $id_col = :$id_col ";
        $this->query($query, $data);

        return false;
    }
}