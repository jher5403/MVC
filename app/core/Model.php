<?php

class Model
{
    use Database;
    protected $table = 'blogs';
    protected $offset = 0;

    /**
     * $data: What your looking for.
     * $filter: What your filtering out
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

        return $this->query($query, $data, $filter);
        //https://www.youtube.com/watch?v=q0JhJBYi4sw&list=PLY3j36HMSHNUCsG7S1lnBg_mOg3_VZrcq
        
    }

    public function first($data, $filter = [])
    {
        
    }
    
    public function insert($data)
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}