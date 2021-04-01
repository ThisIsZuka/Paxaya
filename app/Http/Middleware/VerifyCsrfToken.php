<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'stripe/*',
        'https://www.ecadigital.xyz/api_paxaya/public/webhooks/*',
        'https://www.ecadigital.xyz/api_paxaya/public/webhooks',
        'https://www.ecadigital.xyz/api_paxaya/public/customer_Add',
        'https://www.ecadigital.xyz/api_paxaya/public/customer_Add*',
        'https://www.ecadigital.xyz/api_paxaya/public/*',
    ];
}
