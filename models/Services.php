<?php
namespace models;

use lib\Core;

class Services
{
    protected $core;

    public function __construct()
    {
        $this->core = Core::getInstance();
    }

    // Get Services
    public function getServices()
    {
        global $pdo;
        $data = array();

        $selectStatement = $pdo->select()
        ->from('services');

        if ($stmt = $selectStatement->execute()) {
            $data = $stmt->fetchAll();
        } else {
            $data = 0;
        }
        return $data;
    }

    // public function addService($service, $category)
    // {
    //     global $pdo;
    //     $route = $service->getAttribute('route');
    //     $service = $route->getArgument('service');
    //     $category = $service->getArgument('category');

    //     $insertStatement = $pdo->prepare("INSERT INTO services (service, category) VALUES (:service, :category)");
    //     $insertStatement->execute(array(
    //         "task" => $service,
    //         "category" => $category
    //         ));
    // }
}
