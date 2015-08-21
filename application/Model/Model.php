<?php
namespace App\Model;

class Model
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=test', 'root', '');
    }
}
