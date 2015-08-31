<?php

namespace Laasti\Sandbox\Views;

use Symfony\Component\Translation\Translator;

/**
 * RequestHelper Class
 *
 */
class TranslatorHelper
{
    protected $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function trans($id, $parameters = [], $domain = null, $locale = null)
    {
        return $this->translator->trans($id, $parameters, $domain, $locale);
    }
}
