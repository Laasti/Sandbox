<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laasti;

/**
 * Description of TwigRenderer
 *
 * @author Sonia
 */
class TwigRenderer implements Renderer
{
    protected $twig;
    
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }
    
    public function render($template, $data = array()) {
        return $this->twig->render($template, $data);
    }
    
    public function setVariables($variables = array()) {
        $this->twig->mergeGlobals($variables);
        return $this;
    }
    
    public function getVariables() {
        return $this->twig->getGlobals();
    }
    
    public function addLocation($path, $namespace = null) {
        $this->twig->getLoader()->addPath($path, $namespace);
        return $this;
    }
    
    public function prependLocation($path, $namespace) {
        $this->twig->getLoader()->prependPath($path, $namespace);
        return $this;
    }
}
