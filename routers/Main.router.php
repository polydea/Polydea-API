<?php

namespace routers;

use models\Services;

$app->get('/', function () use ($app) {
    // $todolist = new Task();
    // $data = $todolist->getTodo();
    // return json_encode($data);
    echo 'coucou';
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
// })->add($authorization);
});
