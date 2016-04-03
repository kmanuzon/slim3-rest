<?php

namespace App\Controller;

use App\Model\Books as BooksModel;

class Books extends Controller
{
    /**
     * Get all books.
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     * @return object
     */
    protected function getAction($request, $response)
    {
        $books = new BooksModel();

        return $books->fetchAll();
    }
}
