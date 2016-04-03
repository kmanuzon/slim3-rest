<?php

namespace App\Controller;

use App\Model\Books as BooksModel;

class Book extends Controller
{
    /**
     * Get book specified by id in URL segment.
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     * @return object
     */
    protected function getAction($request, $response)
    {
        $books = new BooksModel();

        return $books->fetchById($this->getUrlSegment(1));
    }
}
