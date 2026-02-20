<?php
include "controller/TaskController.php";

$controller = new TaskController();

$requestUri = $_SERVER['REQUEST_URI'];
$request = explode("/", trim($requestUri, "/"));

if ($_SERVER["REQUEST_METHOD"] === "POST") { // add
    $task = $_POST['task'] ?? '';
    $controller->addTask($task);

} elseif ($_SERVER["REQUEST_METHOD"] === "PUT") { // edit
    $id = (int) strtok(end($request), '?');
    $controller->updateTask($id);

} elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") { // delete
    $id = (int) strtok(end($request), '?');
    $controller->deleteTask($id);

} else { // GET
    $controller->index();
}
