<?php

namespace App\Model;

class Books extends Model
{
    /**
     * Get all books.
     *
     * @return object
     */
    public function fetchAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM books");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * Get book specified by id.
     *
     * @return object
     */
    public function fetchById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = ? LIMIT 1");
        $stmt->execute(array(
            $id
        ));

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }
}
