<?php

namespace Laasti\Dist\Controllers;

use Laasti\Response\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;

class Template
{

    protected $responder;

    public function __construct(ResponderInterface $responder)
    {
        $this->responder = $responder;
    }

    public function display(Request $request)
    {
        $this->responder->setData('title', 'Who am I?');
        $this->responder->setData('name', $request->attributes->get('name'));
        return $this->responder->view('my-name-is');
    }
}
