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
        $username = isset($_POST['username']) && is_string($_POST['username'])
            ? trim($_POST['username'])
            : '';
        $password = isset($_POST['password']) && is_string($_POST['password'])
            ? $_POST['password']
            : '';
        $accounts = [
            'admin' => [
                'username' => (string) getenv('ADMIN_USERNAME'),
                'hash' => (string) getenv('ADMIN_PASSWORD_HASH'),
            ],
            'user' => [
                'username' => (string) getenv('USER_USERNAME'),
                'hash' => (string) getenv('USER_PASSWORD_HASH'),
            ],
        ];
        $role = null;
        $hash = '';

        foreach ($accounts as $account_role => $account) {
            if ($username === $account['username'] && $account['hash'] !== '' && password_verify($password, $account['hash'])) {
                $role = $account_role;
                $hash = $account['hash'];
                break;
            }
        }

        if ($role === null) {
            redirect('login?error=1');
            exit;
        }

        session_regenerate_id(true);
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['auth_fingerprint'] = hash('sha256', $role . '|' . $username . '|' . $hash);
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