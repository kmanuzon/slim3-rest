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
        $this->setUrlSegments($request);
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

    /**
     * Process the request and return data by calling the requested controller and
     * its method passing the query parameters and the segments in the URL.
     *
     * @return mixed
     */
    private function callAction()
    {
        $request = $this->getRequest();

        $action = strtolower($request->getMethod()) . self::METHOD_SUFFIX;

        return $this->$action($request->getQueryParams(), $this->getUrlSegments());
    }
}
