<?php

namespace App\Support;

class Tip
{
    const SUCCESS = 200000; // Successful operation.

    const AUTH_USER_NOT_FOUND = 200101; // User not found.
    const AUTH_TOKEN_EXPIRED = 200102; // Token expired.
    const AUTH_TOKEN_INVALID = 200103; // Token invalid.
    const AUTH_JWT_INVALID = 200104; // JWT invalid.
    const AUTH_UNAUTHORIZED = 200105; // Unauthorized.

    const FAILED = 400000; // Failed operation.
}
