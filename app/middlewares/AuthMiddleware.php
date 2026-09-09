<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        $role = (string) ($_SESSION['role'] ?? '');
        $username = (string) getenv(strtoupper($role) . '_USERNAME');
        $hash = (string) getenv(strtoupper($role) . '_PASSWORD_HASH');
        $fingerprint = hash('sha256', $role . '|' . $username . '|' . $hash);

        if (empty($_SESSION['authenticated']) || !in_array($role, ['admin', 'user'], true) || empty($_SESSION['auth_fingerprint']) || !hash_equals($fingerprint, $_SESSION['auth_fingerprint'])) {
            redirect('login');
            exit;
        }

        return $next();
    }
}