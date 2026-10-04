<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
    }

    public function preflight()
    {
        $this->api->respond(null, 204);
    }

    public function login()
    {
        $this->api->require_method('POST');
        $input = $this->request_body();
        $username = is_string($input['username'] ?? null) ? $input['username'] : '';
        $password = is_string($input['password'] ?? null) ? $input['password'] : '';

        foreach (['admin', 'user'] as $role) {
            $configured_username = (string) getenv(strtoupper($role) . '_USERNAME');
            $password_hash = (string) getenv(strtoupper($role) . '_PASSWORD_HASH');

            if ($configured_username !== '' && $password_hash !== '' && $username === $configured_username && password_verify($password, $password_hash)) {
                $token = $this->api->encode_jwt([
                    'sub' => $username,
                    'role' => $role,
                    'scopes' => ['products:read', 'products:write'],
                ]);

                $this->api->respond([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => (int) config_item('payload_token_expiration'),
                    'user' => ['username' => $username, 'role' => $role],
                ]);
            }
        }

        $this->api->respond_error('Invalid username or password.', 401);
    }

    public function logout()
    {
        $this->api->require_method('POST');
        $this->api->require_jwt();
        $this->api->respond(['message' => 'Signed out. Remove the access token from the client.']);
    }

    public function index()
    {
        $this->api->require_method('GET');
        $this->api->require_jwt();
        $this->load_products();
        $this->api->respond(['data' => $this->ProductsModel->_all()]);
    }

    public function show($id)
    {
        $this->api->require_method('GET');
        $this->api->require_jwt();
        $this->load_products();
        $product = $this->find_product($id);
        $this->api->respond(['data' => $product]);
    }

    public function store()
    {
        $this->api->require_method('POST');
        $this->api->require_jwt();
        $this->load_products();
        $product = $this->validated_product($this->request_body());

        if ($product === false) {
            $this->api->respond_error('Provide a product name, a non-negative price, and a non-negative whole-number quantity.', 422);
        }

        $id = $this->ProductsModel->_insert($product);
        $this->api->respond(['data' => $this->find_product($id)], 201);
    }

    public function update($id)
    {
        $this->api->require_method($_SERVER['REQUEST_METHOD']);
        $this->api->require_jwt();
        $this->load_products();
        $existing = $this->find_product($id);
        $product = $this->validated_product($this->request_body(), $existing);

        if ($product === false) {
            $this->api->respond_error('Provide a product name, a non-negative price, and a non-negative whole-number quantity.', 422);
        }

        $this->ProductsModel->_update((int) $id, $product);
        $this->api->respond(['data' => $this->find_product($id)]);
    }

    public function delete($id)
    {
        $this->api->require_method('DELETE');
        $this->api->require_jwt();
        $this->load_products();
        $this->find_product($id);
        $this->ProductsModel->_delete((int) $id);
        $this->api->respond(['message' => 'Product deleted.']);
    }

    private function request_body()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        return is_array($body) ? $body : [];
    }

    private function load_products()
    {
        $this->call->database();
        $this->call->model('ProductsModel');
    }

    private function validated_product(array $input, array $existing = [])
    {
        $values = array_merge($existing, $input);
        $name = trim((string) ($values['product_name'] ?? ''));
        $description = $values['description'] ?? '';
        $price = $values['price'] ?? null;
        $quantity = $values['quantity'] ?? null;

        if ($name === '' || strlen($name) > 100 || !is_numeric($price) || (float) $price < 0 || (float) $price > 99999999.99 || filter_var($quantity, FILTER_VALIDATE_INT) === false || (int) $quantity < 0 || (!is_string($description) && $description !== null)) {
            return false;
        }

        return [
            'product_name' => $name,
            'description' => $description === null ? '' : trim($description),
            'price' => number_format((float) $price, 2, '.', ''),
            'quantity' => (int) $quantity,
        ];
    }

    private function find_product($id)
    {
        if (filter_var($id, FILTER_VALIDATE_INT) === false || (int) $id < 1) {
            $this->api->respond_error('Product not found.', 404);
        }

        $product = $this->ProductsModel->_find((int) $id);
        if (!$product) {
            $this->api->respond_error('Product not found.', 404);
        }

        return $product;
    }
}