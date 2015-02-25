<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laasti\Providers;

use League\Container\ServiceProvider;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Loader\JsonFileLoader;

/**
 * Description of WhoopsProvider
 *
 * @author Sonia
 */
class TranslationProvider extends ServiceProvider
{

    protected $provides = [
        'Symfony\Component\Translation\Translator',
        'Symfony\Component\Translation\MessageSelector',
        'Symfony\Component\Translation\Loader\ArrayLoader',
    ];

    public function register()
    {
        $c = $this->getContainer();

        //TODO: Should provide an interface instead so we can swap if we need to
        //TODO: Parametize locales
        $c->add('Symfony\Component\Translation\Translator', function() use ($c) {
            $translator = new Translator('fr_FR', new MessageSelector());
            $translator->setFallbackLocales(array('fr'));
            $translator->addLoader('array', new ArrayLoader());
            $translator->addResource('array', array(
                'Hello World!' => 'Bonjour',
                    ), 'fr');
            return $translator;
        }, true);
    }

}
