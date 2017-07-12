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

    // Get Users
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

    // Get user
    public function getUser($username, $password)
    {
        $route = $username->getAttribute('route');
        $username = $route->getArgument('username');

        global $pdo;
        $data = array();

        $selectStatement = $pdo->select()
        ->from('users')
        ->where('username', '=', $username);

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
