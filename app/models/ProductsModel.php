<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductsModel extends Model
{
    protected $table = 'products';

    protected $fillable = ['product_name', 'description', 'price', 'quantity'];
}