<?php
namespace App\Model;

class User extends Model
{
    public function getUsers()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();

        $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $rows;
    }

    public function getUser($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $stmt->execute(array(
            $id
        ));
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }
}
