<?php

declare(strict_types=1);

namespace App\Concern\http;

use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\BrowserKit\Response;

class Client extends AbstractBrowser
{
    /**
     * @param Request $request
     * @return Response
     */
    protected function doRequest($request): Response
    {
        // ... convert request into a response
        return new Response();
    }
}
