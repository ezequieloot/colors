<?php

require("config.php");

class Color
{
    private $id;
    private $name;
    private $hex;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        return $this->$name = $value;
    }

    public function index()
    {
        $mysqli = new mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_DATABASE);
        $query = "SELECT * FROM colors";
        $result = $mysqli->query($query);
        if($result)
        {
            $list = array();
            while($row = $result->fetch_assoc())
            {
                $list[] = [
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "hex" => $row["hex"]
                ];
            }
            return $list;
        }
        $mysqli->close();
    }

    public function store()
    {
        $mysqli = new mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_DATABASE);
        $query = "INSERT INTO colors(name, hex)
        VALUES(
            '" . $this->name . "',
            '" . $this->hex . "'
        )";
        $mysqli->query($query);
        $this->id = $mysqli->insert_id;
        $mysqli->close();
    }

    public function edit()
    {
        $mysqli = new mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_DATABASE);
        $query = "SELECT * FROM colors WHERE id =" . $this->id;
        $result = $mysqli->query($query);
        if($row = $result->fetch_assoc())
        {
            $color = [
                "id" => $row["id"],
                "name" => $row["name"],
                "hex" => $row["hex"]
            ];
            return $color;
        }
        $mysqli->close();
    }

    public function update()
    {
        $mysqli = new mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_DATABASE);
        $query = "UPDATE colors SET
        name = '" . $this->name . "',
        hex = '" . $this->hex . "' WHERE id =" . $this->id;
        $mysqli->query($query);
        $mysqli->close();
    }

    public function destroy()
    {
        $mysqli = new mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_DATABASE);
        $query = "DELETE FROM colors WHERE id =" . $this->id;
        $mysqli->query($query);
        $mysqli->close();
    }
}

?>