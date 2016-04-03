<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class Controller
{
    /**
     * Class name of the default controller to load.
     *
     * @var string
     */
    const DEFAULT_CONTROLLER = 'Index';

    /**
     * String to append to controller method name call.
     *
     * @var string
     */
    const METHOD_SUFFIX = 'Action';

    /**
     * URL segments relative to the root of the application. This includes the
     * controller.
     *
     * @var array
     */
    private $urlSegments = array();

    /**
     *
     * @var \Slim\Http\Request
     */
    private $request;

    /**
     *
     * @var \Slim\Http\Response
     */
    private $response;

    /**
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->setRequest($request);
        $this->setResponse($response);
        $this->setUrlSegments($request);
    }

    /**
     * Call the requested controller method to process the response and return the
     * response.
     *
     * NOTE: The response object is automatically set to JSON if the returned data
     * type of the request method is an array.
     *
     * @return \Slim\Http\Response
     */
    public function getRequestResponse()
    {
        $request = $this->getRequest();

        $action = strtolower($request->getMethod()) . self::METHOD_SUFFIX;

        $data = $this->$action($this->getRequest(), $this->getResponse());

        if ($data instanceof Response) {

            return $data;
        }

        $response = $this->getResponse();

        if (gettype($data) === 'string') {

            return $response->write($data);
        }

        if (gettype($data) === 'array') {

            return $response->withJson($data);
        }
    }

    /**
     *
     * @param \Slim\Http\Request
     */
    protected function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     *
     * @return \Slim\Http\Request
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     *
     * @param \Slim\Http\Response
     */
    protected function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     *
     * @return \Slim\Http\Response
     */
    protected function getResponse()
    {
        return $this->response;
    }

    /**
     * Collects the URL segments from route and builds a numeric array with the
     * controller in index 0.
     *
     * @param \Slim\Http\Request
     */
    protected function setUrlSegments(Request $request)
    {
        $route = $request->getAttribute('route');

        $arguments = $route->getArguments();

        $segments[] = isset($arguments['controller']) ?
            $arguments['controller'] :
            strtolower(self::DEFAULT_CONTROLLER);

        if (isset($arguments['segments'])) {
            $segments = array_merge($segments, explode(
                '/',
                $arguments['segments']
            ));
        }

        $this->urlSegments = $segments;
    }

    /**
     *
     * @return array
     */
    protected function getUrlSegments()
    {
        return $this->urlSegments;
    }

    /**
     *
     * @param bool
     * @return mixed
     */
    protected function getUrlSegment($index)
    {
        if (isset($this->urlSegments[$index])) {

            return $this->urlSegments[$index];
        }

        return null;
    }
}
