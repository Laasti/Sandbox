<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Laasti\Config;

/**
 * Description of TwigConfig
 *
 * @author Sonia
 */
class TwigConfig extends \Laasti\TwigProvider\TwigConfig
{
    public function __construct($config = array())
    {
        $this->templatesPath = BASEPATH . '/resources/views';
        //$this->cache= BASEPATH . '/cache/twig';

        parent::__construct($config);
    }
}
