<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laasti;

/**
 * Description of DevEnvironment
 *
 * @author Sonia
 */
class DevEnvironment implements \Laasti\Environment\EnvironmentInterface
{

    protected $container;

    public function __construct(\Laasti\Application $container)
    {
        $this->container = $container;
    }

    public function validate(\Symfony\Component\HttpFoundation\Request $request)
    {
        return true;
    }

    public function configure(\Symfony\Component\HttpFoundation\Request $request)
    {
        //TODO: Register environments to the environment manager
        //Environments must implement Environment interface
        //Environment must declare services: email connection, dbconnections, logging handler, error handler
        //The services are initialized here

        $this->container['db.driver'] = 'mysql';
        $this->container['db.dsn'] = 'mysql://root:@localhost/anqintranet';

        $this->container->add('Whoops\Handler\HandlerInterface', function() {
            $handler = new Whoops\Handler\PrettyPageHandler;
            $handler->setPageTitle("Whoops! There was a problem.");

            return $handler;
        });
        $this->container->get('Whoops\Run');
        $logger = $this->container->get('Psr\Log\LoggerInterface');
    }
}
