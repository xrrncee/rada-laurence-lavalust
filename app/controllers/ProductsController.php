<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('ProductsModel');
    }

    public function index()
    {
        $this->call->view('products/index', [
            'products' => $this->ProductsModel->_all(),
            'message' => isset($_GET['message']) ? $_GET['message'] : '',
        ]);
    }

    public function create()
    {
        $this->call->view('products/form', [
            'product' => [],
            'heading' => 'Add product',
            'action' => 'products',
        ]);
    }

    public function store()
    {
        $data = $this->validated_input();
        if ($data === false) {
            redirect('products/create?error=1');
        }

        $this->ProductsModel->_insert($data);
        redirect('products?message=created');
    }

    public function edit($id)
    {
        $product = $this->ProductsModel->_find((int) $id);
        if (!$product) {
            show_404();
        }

        $this->call->view('products/form', [
            'product' => $product,
            'heading' => 'Edit product',
            'action' => 'products/edit/' . (int) $id,
        ]);
    }

    public function update($id)
    {
        $data = $this->validated_input();
        if ($data === false) {
            redirect('products/edit/' . (int) $id . '?error=1');
        }

        $this->ProductsModel->_update((int) $id, $data);
        redirect('products?message=updated');
    }

    public function delete($id)
    {
        $this->ProductsModel->_delete((int) $id);
        redirect('products?message=deleted');
    }

    private function validated_input()
    {
        $name = trim((string) $this->io->post('product_name'));
        $description = trim((string) $this->io->post('description'));
        $price = $this->io->post('price');
        $quantity = $this->io->post('quantity');

        if ($name === '' || !is_numeric($price) || (float) $price < 0 || filter_var($quantity, FILTER_VALIDATE_INT) === false || (int) $quantity < 0) {
            return false;
        }

        return [
            'product_name' => $name,
            'description' => $description,
            'price' => number_format((float) $price, 2, '.', ''),
            'quantity' => (int) $quantity,
        ];
    }
}