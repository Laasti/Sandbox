<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laasti\Controllers;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of HelloWorld
 *
 * @author Sonia
 */
class HelloWorld
{
    
    /**
     *
     * @var \Laasti\TwigRenderer
     */
    protected $renderer = null;

    //TODO Use an interface to swap renderer if needed
    public function __construct(\Laasti\Services\RendererInterface $renderer, \Spot\Locator $orm)
    {
        $this->renderer = $renderer;
        $this->orm = $orm;
        $this->repo = $this->orm->mapper('Laasti\Entities\Members');
    }

    public function output()
    {
        $response = new Response();
      
        $this->renderer->setVars(array('members' => $this->repo->all(), 'me' => 'Test'));
        $response->setContent($this->renderer->render('hello.html.twig'));
        //$response->setContent('Test');
        
        return $response;
    }
    
    public function hello($name)
    {           
        $response = new Response();
        $response->setContent(sprintf('Hello %s!', $name));
        
        return $response;
    }
    

}
