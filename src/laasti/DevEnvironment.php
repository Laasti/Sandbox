<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laasti;

use Laasti\Environment\EnvironmentInterface;
use League\Container\Container;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of DevEnvironment
 *
 * @author Sonia
 */
class DevEnvironment implements EnvironmentInterface
{

    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function validate(Request $request)
    {
        return true;
    }

    public function configure(Request $request)
    {
        //TODO: Register environments to the environment manager
        //Environments must implement Environment interface
        //Environment must declare services: email connection, dbconnections, logging handler, error handler
        //The services are initialized here

        $this->container['db.driver'] = 'mysql';
        $this->container['db.dsn'] = 'mysql://root:@localhost/anqintranet';
        $this->container['locales.current'] = 'fr';
        $this->container['locales.fallbacks'] = array('fr');
        
        //$logger = $this->container->get('Psr\Log\LoggerInterface');
    }
}
