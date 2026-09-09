<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function login()
    {
        if (!empty($_SESSION['authenticated'])) {
            redirect('products');
        }

        $this->call->view('auth/login', [
            'error' => isset($_GET['error']) ? 'Invalid username or password.' : '',
        ]);
    }

    public function authenticate()
    {
        $username = trim((string) $this->io->post('username'));
        $password = (string) $this->io->post('password');
        $hash = (string) getenv('ADMIN_PASSWORD_HASH');

        if ($username !== (string) getenv('ADMIN_USERNAME') || $hash === '' || !password_verify($password, $hash)) {
            redirect('login?error=1');
        }

        session_regenerate_id(true);
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        redirect('products');
    }

    public function logout()
    {
        $_SESSION = [];
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        redirect('login');
    }
}