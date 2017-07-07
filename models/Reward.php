<?php
namespace models;

use lib\Core;

class Reward
{
    protected $core;

    public function __construct()
    {
        $this->core = Core::getInstance();
    }

    // Get Rewards
    public function getRewards()
    {
        global $pdo;
        $data = array();

        $selectStatement = $pdo->select()
        ->from('rewards');

        if ($stmt = $selectStatement->execute()) {
            $data = $stmt->fetchAll();
        } else {
            $data = 0;
        }
        return $data;
    }

    public function addReward($reward, $cost)
    {
        global $pdo;
        $route = $reward->getAttribute('route');
        $reward = $route->getArgument('reward');
        $reward = $challenge->getArgument('cost');

        $insertStatement = $pdo->prepare("INSERT INTO rewards (reward, cost) VALUES (:reward, :cost)");
        $insertStatement->execute(array(
            "reward" => $reward,
            "cost" => $value
            ));
    }
}
