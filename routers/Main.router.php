<?php

namespace routers;

use models\Services;
use models\Users;

$app->get('/', function () use ($app) {
    // $todolist = new Task();
    // $data = $todolist->getTodo();
    // return json_encode($data);
    return 'Homepage';
});

// $app->get('/add[/{task}[/{category}]]', function ($task, $category) use ($app) {
//     $todolist = new TodoList();

//     $todolist->addQuest($task, $category);
//     return true;
// })->add($authorization);

$app->get('/services', function () use ($app) {
    $services = new Services();
    $data = $services->getServices();
    return json_encode($data);
})->add($authorization);

$app->get('/users', function () use ($app) {
    $users = new Users();
    $data = $users->getUsers();
    return json_encode($data);
})->add($authorization);

$app->get('/user[/{username}[/{password}]]', function ($username, $password) use ($app) {
    $user = new Users();

    $data = $user->getUser($username, $password);
    echo json_encode($data);
})->add($authorization);
