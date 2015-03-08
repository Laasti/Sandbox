<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laasti\Controllers;

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
    public function __construct(\Twig_Environment $renderer)
    {
        $this->renderer = $renderer;
    }

    public function output()
    {
        $response = new Response();
      
        $response->setContent($this->renderer->render('hello.html.twig', array('members' => array(), 'me' => 'Test')));
        
        return $response;
    }
    
    public function hello($name)
    {           
        $response = new Response();
        $response->setContent(sprintf('Hello %s!', $name));
        
        return $response;
    }
    

}
