<?php
namespace App\Controller;

class Controller
{
    public function __construct()
    {
    }

    public function getAction()
    {
        $content = '<h1>Hello World!</h1>'
            . '<h3>This is what you GET</h3>';
        return $content;
    }

    public function postAction()
    {
        $content = '<h1>Hello World!</h1>'
            . '<h3>This is what you POST</h3>';
        return $content;
    }

    public function putAction()
    {
        $content = '<h1>Hello World!</h1>'
            . '<h3>This is what you PUT</h3>';
        return $content;
    }

    public function deleteAction()
    {
        $content = '<h1>Hello World!</h1>'
            . '<h3>This is what you DELETE</h3>';
        return $content;
    }
}
