<?php

class crud
{

    public $conn='';

    function __construct($host, $username, $password, $database)
    {
        $this->conn = new mysqli($host, $username, $password, $database);

    }
    function create($table, $array)
    {
        $array_keys = implode(' , ', array_keys($array));

        $array_values = implode(" ',' ", array_values($array));

        $sql = "INSERT INTO $table ($array_keys) VALUES ('$array_values')";

        if ($this->conn->query($sql)) {
            return ['status'=>200,'result'=>$this->conn->insert_id];
        } else {
            return false;
        }
    }
    function read($table, $id = false)
    {
        $sql = "SELECT * FROM $table";
        if ($id) {
            $sql .= " WHERE id = $id";
        }
        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);

    }
    function update($table, $params, $id)
    {
        $newArr = [];
        foreach ($params as $key => $value) {
            $newArr[] = "$key = '$value'";
        }

        $params_string = implode(', ', $newArr);

        $sql = "UPDATE $table SET $params_string WHERE id = $id";

        if ($this->conn->query($sql)) {
            return ['status' => 200, 'result' => 'data updated successfuly'];
        } else {
            return ['status' => 400, 'result' => 'error updating the records'];
        }
    }
    function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = $id";

        if ($this->conn->query($sql)) {
            return ['status' => 200, 'result' => 'data deleted successfuly'];
        } else {
            return ['status' => 400, 'result' => 'error deleting the records'];
        }
    }
    function __destruct()
    {
        $this->conn->close();
    }
}

$get = new crud ('localhost','root','','oop_crud');

?>
