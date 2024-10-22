<?php
defined('ROOTPATH') OR exit('Error: Access denied.');

/**
 * Handles mySQL specific functions.
 * Table specific queries are handled by the Model classes.
 * 
 * Extends Model classes.
 */
Trait Database
{
    private function connect() 
    {
        $string = 'mysql:hostname='.DBHOST.';dbname='.DBNAME;
        $conn = new PDO($string, DBUSER, DBPASS);
        return $conn;
    } 

    public function query($query, $data = []) {
        $con = $this->connect();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);
        if($check)
        {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
        
    }

    public function get_row($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);
        if($check)
        {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result[0];
            }
        }
        return false;
    }
}