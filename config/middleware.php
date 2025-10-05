<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\GuestOrCustomerMiddleware;

return [

    'aliases' => [
        'guest' => RedirectIfAuthenticated::class,
        'role' => RoleMiddleware::class,
        'guest_or_customer' => GuestOrCustomerMiddleware::class,
    ],

];
