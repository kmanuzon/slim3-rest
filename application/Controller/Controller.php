<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

abstract class Controller
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
     * The request object.
     *
     * @var \Slim\Http\Request
     */
    private $request;

    /**
     * The response object.
     *
     * @var \Slim\Http\Response
     */
    private $response;

    /**
     * Constructor.
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
        $response = $this->getResponse();

        $method = $this->getMethod($request);

        $requestResponse = $this->callAction($method, array($request, $response));

        if ($requestResponse instanceof Response) {

            return $requestResponse;
        }

        if (gettype($requestResponse) === 'string') {

            return $response->write($requestResponse);
        }

        try {

            return $response->withJson($requestResponse);
        } catch (\RuntimeException $e) {

            return $response->withStatus(500)->write(sprintf(
                '%s: %s',
                $e->getCode(),
                $e->getMessage()
            ));
        }
    }

    /**
     * Set the request object.
     *
     * @param \Slim\Http\Request
     */
    protected function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the request object.
     *
     * @return \Slim\Http\Request
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the response object.
     *
     * @param \Slim\Http\Response
     */
    protected function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Get the response object.
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
     * Get all URL segments.
     *
     * @return array
     */
    protected function getUrlSegments()
    {
        return $this->urlSegments;
    }

    /**
     * Get the URL segment specified by index.
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
     * Get the controller method based on request method.
     *
     * @param \Slim\Http\Request
     * @return string
     */
    protected function getMethod(Request $request)
    {
        return strtolower($request->getMethod()) . self::METHOD_SUFFIX;
    }

    /**
     * Execute the requested method on the controller.
     *
     * @param string
     * @param array
     * @return mixed
     */
    protected function callAction($method, $arguments)
    {
        return call_user_func_array(array($this, $method), $arguments);
    }

    /**
     * Handle calls to undefined methods on the controller.
     *
     * @param string
     * @param array
     * @return \Slim\Http\Response
     */
    public function __call($name, $arguments)
    {
        $response = $this->getResponse();

        return $response->withStatus(405)->write('Method Not Allowed');
    }
}
