<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class Controller
{
    /**
     * String to append to method name call.
     *
     * @var string
     */
    private $methodSuffix = 'Action';

    /**
     *
     * @var \Slim\Http\Request
     */
    private $request;

    /**
     *
     * @var Slim\Http\Response
     */
    private $response;

    /**
     *
     * @param \Slim\Http\Request
     * @param Slim\Http\Response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->setRequest($request);
        $this->setResponse($response);
    }

    /**
     *
     * @param \Slim\Http\Request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     *
     * @return \Slim\Http\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     *
     * @param Slim\Http\Response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     *
     * @return Slim\Http\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Run the requested controller and return appropriate response.
     *
     * @return Slim\Http\Response
     */
    public function getRequestResponse()
    {
        $data = $this->callAction();

        $response = $this->getResponse();

        return $response->write($data);
    }

    /**
     * Process the request and return data by calling the requested controller and
     * its method passing the query parameters and the segments in the URL.
     *
     * @return mixed
     */
    private function callAction()
    {
        $request = $this->getRequest();

        $route = $request->getAttribute('route');

        $action = strtolower($request->getMethod()) . $this->methodSuffix;

        return $this->$action($request->getQueryParams(), $route->getArguments());
    }
}
