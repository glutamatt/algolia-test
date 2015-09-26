<?php

namespace AlgoliaTest\Lib;

class Application
{
    protected $router;
    protected $config;

    public function __construct($config)
    {
        $this->router = new Router();
        $this->config = $config;
    }

    public function get($path, $controller)
    {
        $this->router->add($path, $controller);
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function run()
    {
        $controller = $this->router->match($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

        if (!$controller) {
            http_response_code(404);
            echo 'Address not found';
            exit();
        }

        try {
            return $controller();
        } catch (\Exception $e) {
            throw new \Exception("Deal with it", $e->getCode(), $e);
        }
    }

    public function getConfig($key)
    {
        return array_key_exists($key, $this->config) ? $this->config[$key] : null;
    }
}
