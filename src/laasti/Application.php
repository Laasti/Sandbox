<?php

namespace Laasti;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Application implements HttpKernelInterface, TerminableInterface
{

    public function __construct($container, $stack, $router)
    {
        //TODO: proper parameters and automatic instantiation
        $this->container = $container;
        //TODO: rename to middleware
        $this->stack = $stack;
        //TODO rename to routes
        $this->router = $router;
    }

    /**
     * Handles the request and delivers the response.
     *
     * @param Request|null $request Request to process
     */
    public function run(Request $request = null)
    {
        if (null === $request) {
            $request_obj = $this->container->get('Symfony\Component\HttpFoundation\Request');
            $request = $request_obj::createFromGlobals();
        }

        $stack_kernel = $this->stack->resolve($this);
        $response = $stack_kernel->handle($request);
        $response->send();
        
        $this->terminate($request, $response);
    }
    
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        
        $dispatcher = $this->router->getDispatcher();

        $response = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());

        return $response;
    }
    
    public function terminate(Request $request, Response $response)
    {
        ;
    }

}
