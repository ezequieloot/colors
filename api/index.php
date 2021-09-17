<?php

require("db.php");

$color = new Color();

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    if(isset($_GET["id"]))
    {
        $color->id = $_GET["id"];
        echo json_encode($color->edit());
        exit();
    }
    else
    {
        $colors = $color->index();
        echo json_encode($colors);
        exit();
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $color->name = $_POST["name"];
    $color->hex = $_POST["hex"];
    $color->store();
    echo "Task completed! " . $color->id;
}

if($_SERVER["REQUEST_METHOD"] == "PUT")
{
    $data = json_decode(file_get_contents("php://input"));
    $color->id = $data->id;
    $color->name = $data->name;
    $color->hex = $data->hex;
    $color->update();
    echo "Task completed!";
}

if($_SERVER["REQUEST_METHOD"] == "DELETE")
{
    if(isset($_GET["id"]))
    {
        $color->id = $_GET["id"];
        $color->destroy();
        echo "Task completed!";
    }
}

?>