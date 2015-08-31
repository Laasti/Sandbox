<?php

namespace Laasti\Sandbox\Controllers;

use Laasti\Response\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;

class Template
{

    protected $responder;
    protected $translator;

    public function __construct(ResponderInterface $responder, \Symfony\Component\Translation\Translator $translator)
    {
        $this->responder = $responder;
        $this->translator = $translator;
    }

    public function display(Request $request)
    {
        $this->responder->setData('title', 'Who am I?');
        $this->responder->setData('name_label', $this->translator->trans('my_name_is'));
        $this->responder->setData('name', $request->attributes->get('name'));
        return $this->responder->view('my-name-is');
    }
}
