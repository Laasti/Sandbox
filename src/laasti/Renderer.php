<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laasti;

/**
 *
 * @author Sonia
 */
interface Renderer
{
    public function render($template, $data = array());
    public function setVariables($variables = array());
    public function getVariables();
    public function addLocation($path, $namespace);
    public function prependLocation($path, $namespace);
}
