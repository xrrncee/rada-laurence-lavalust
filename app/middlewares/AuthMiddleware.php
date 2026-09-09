<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        if (empty($_SESSION['authenticated'])) {
            redirect('login');
            exit;
        }

        return $next();
    }
}