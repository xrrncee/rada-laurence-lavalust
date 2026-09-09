<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AdminMiddleware
{
    public function handle(Closure $next)
    {
        if (empty($_SESSION['authenticated']) || ($_SESSION['role'] ?? '') !== 'admin') {
            redirect('products');
            exit;
        }

        return $next();
    }
}