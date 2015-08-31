<?php

namespace Laasti\Sandbox\Controllers;

use Laasti\Response\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;

class HelloWorld
{

    protected $responder;

    public function __construct(ResponderInterface $responder)
    {
        $this->responder = $responder;
    }

    public function welcome(Request $request)
    {
        return $this->responder->raw('<h1>Hello world!</h1>');
    }
}
