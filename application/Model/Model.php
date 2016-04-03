<?php

namespace App\Model;

abstract class Model
{
    /**
     * PDO instance connected to a dabase.
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=test', 'root', '');
    }
}
