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

    public function output(Request $request, Response $response)
    {
        
        $response->setContent('Hello world!');
        
        return $response;
    }
    
    public function hello(Request $request, Response $response, $params = array())
    {   
        //TODO: Would prefer for the params to be in the request
        
        $response->setContent(sprintf('Hello %s!', $params['name']));
        
        return $response;
    }
    

}
