<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
	private $productModel;

	public function __construct()
	{
		parent::__construct();
		$this->productModel = $this->call->model('ProductModel');
	}

	public function index()
	{
		$data['products'] = $this->productModel->all();
		$this->call->view('product_index', $data);
	}

	public function create()
	{
		// Check if form was submitted
		$product_name = $this->io->get('product_name');
		$description = $this->io->get('description');
		$price = $this->io->get('price');
		$quantity = $this->io->get('quantity');

		if ($product_name && $price && $quantity) {
			$data = [
				'product_name' => $product_name,
				'description' => $description,
				'price' => $price,
				'quantity' => $quantity
			];

			$this->productModel->insert($data);
			redirect('products');
		}

		$this->call->view('product_create');
	}

	public function edit($id)
	{
		// Check if form was submitted
		$product_name = $this->io->get('product_name');
		$description = $this->io->get('description');
		$price = $this->io->get('price');
		$quantity = $this->io->get('quantity');

		if ($product_name && $price && $quantity) {
			$data = [
				'product_name' => $product_name,
				'description' => $description,
				'price' => $price,
				'quantity' => $quantity
			];

			$this->productModel->update($id, $data);
			redirect('products');
		}

		$data['product'] = $this->productModel->find($id);
		$this->call->view('product_edit', $data);
	}

	public function delete($id)
	{
		$this->productModel->delete($id);
		redirect('products');
	}
}
