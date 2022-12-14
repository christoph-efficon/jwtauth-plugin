<?php

namespace Efficon\JWTAuth\Classes;

use RainLab\User\Classes\AuthManager as RainAuthManager;

/**
 * {@inheritDoc}
 */
class AuthManager extends RainAuthManager
{
    /**
     * {@inheritDoc}
     */
    protected $userModel = \Efficon\JWTAuth\Models\User::class;
}
