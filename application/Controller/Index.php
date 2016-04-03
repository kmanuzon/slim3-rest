<?php

namespace App\Controller;

class Index extends Controller
{
    /**
     *
     * @param array
     * @param array
     * @return mixed
     */
    public function getAction($queryParams = array(), $segments = array())
    {
        $content = '<h1>GET a resource</h1>'
            . '<h3>You have requested a GET on /index endpoint and this is the response!</h3>';

        return $content;
    }

    /**
     *
     * @param array
     * @param array
     * @return mixed
     */
    public function postAction($queryParams = array(), $segments = array())
    {
        $content = '<h1>POST to a resource</h1>'
            . '<h3>You have requested a POST on /index endpoint and this is the response!</h3>';

        return $content;
    }

    /**
     *
     * @param array
     * @param array
     * @return mixed
     */
    public function putAction($queryParams = array(), $segments = array())
    {
        $content = '<h1>PUT to a resource</h1>'
            . '<h3>You have requested a PUT on /index endpoint and this is the response!</h3>';

        return $content;
    }

    /**
     *
     * @param array
     * @param array
     * @return mixed
     */
    public function deleteAction($queryParams = array(), $segments = array())
    {
        $content = '<h1>DELETE a resource</h1>'
            . '<h3>You have requested a DELETE on /index endpoint and this is the response!</h3>';

        return $content;
    }
}
