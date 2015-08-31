<?php

namespace Laasti\Sandbox\Views;

use Symfony\Component\HttpFoundation\Request;

/**
 * RequestHelper Class
 *
 */
class RequestHelper
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function locale()
    {
        return $this->request->attributes->get('locale') ?: getenv('DEFAULT_LOCALE');
    }

    public function baseUrl()
    {
        return $this->request->getBaseUrl();
    }
}
