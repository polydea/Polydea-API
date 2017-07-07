<?php
namespace models;

use lib\Core;

class Users
{
    protected $core;

    public function __construct()
    {
        $this->core = Core::getInstance();
    }

    // Get Tasks
    public function getUsers()
    {
        global $pdo;
        $data = array();

        $selectStatement = $pdo->select()
        ->from('users');

        if ($stmt = $selectStatement->execute()) {
            $data = $stmt->fetchAll();
        } else {
            $data = 0;
        }
        return $data;
    }

    // public function addTask($task, $category)
    // {
    //     global $pdo;
    //     $route = $task->getAttribute('route');
    //     $task = $route->getArgument('task');
    //     $category = $route->getArgument('category');

    //     $insertStatement = $pdo->prepare("INSERT INTO tasks (task, date, category) VALUES (:task, :date, :category)");
    //     $insertStatement->execute(array(
    //         "task" => $task,
    //         "date" => date("y.m.d"),
    //         "category" => $category
    //         ));
    // }
}
