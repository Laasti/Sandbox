<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laasti\Providers;

use League\Container\ServiceProvider;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;

/**
 * Description of WhoopsProvider
 *
 * @author Sonia
 */
class WhoopsProvider extends ServiceProvider
{

    protected $provides = [
        'Whoops\Run',
    ];

    public function register()
    {

        $this->getContainer()->add('Whoops\Run', function() {

            $run = new \Whoops\Run;
            $handler = new PrettyPageHandler;
            $handler->setPageTitle("Whoops! There was a problem.");
            /*
              $handler->addDataTable('Killer App Details', array(
              "Important Data" => $myApp->getImportantData(),
              "Thingamajig-id" => $someId
              ));
             */
            $run->pushHandler($handler);

            //For AJAX request
            //$run->pushHandler(new JsonResponseHandler);

            $run->register();
            return $run;
        });
    }

}
