<?php

namespace App\Controller;

class Index extends Controller
{
    /**
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     * @return string
     */
    protected function getAction($request, $response)
    {
        $content = '<h1>GET a resource</h1>'
            . '<h3>You have requested a GET on /index endpoint and this is the response!</h3>';

        return $content;
    }

    /**
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     * @return string
     */
    protected function postAction($request, $response)
    {
        $content = '<h1>POST to a resource</h1>'
            . '<h3>You have requested a POST on /index endpoint and this is the response!</h3>';

        return $content;
    }

    /**
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     * @return string
     */
    protected function putAction($request, $response)
    {
        $content = '<h1>PUT to a resource</h1>'
            . '<h3>You have requested a PUT on /index endpoint and this is the response!</h3>';

        return $content;
    }

    /**
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     * @return string
     */
    protected function deleteAction($request, $response)
    {
        $content = '<h1>DELETE a resource</h1>'
            . '<h3>You have requested a DELETE on /index endpoint and this is the response!</h3>';

        return $content;
    }
}
