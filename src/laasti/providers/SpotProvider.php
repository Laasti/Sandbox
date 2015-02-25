<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laasti\Providers;

use League\Container\ServiceProvider;

/**
 * Description of WhoopsProvider
 *
 * @author Sonia
 */
class SpotProvider extends ServiceProvider
{

    protected $provides = [
        'Spot\Config',
        'Spot\Locator'
    ];

    public function register()
    {
        $c = $this->getContainer();
        
        //Default error handler
        if (!$c->isRegistered('Spot\Config')) {
            $c->add('Spot/Config', function() use ($c) {
                $cfg = new \Spot\Config();
                //TODO: Dehardcode
                die;
                $cfg->addConnection('mysql', 'mysql://root:@localhost/spot');            
                return $cfg;
            });
        }
        //TODO: Should provide an interface instead so we can swap if we need to
        //$c->add('Spot\Locator', 'Spot\Locator', true);
        $c->add('Spot\Locator', function() use ($c) {
            $cfg = new \Spot\Config();
            $cfg->addConnection('mysql', 'mysql://root:@localhost/spot');  
            $spot = new \Spot\Locator($cfg);
            return $spot;
        }, true);
    }

}
