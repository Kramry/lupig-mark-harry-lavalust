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
		$this->call->view('product_create');
	}

	public function store()
	{
		$product_name = $this->io->post('product_name');
		$description = $this->io->post('description');
		$price = $this->io->post('price');
		$quantity = $this->io->post('quantity');

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

		redirect('products/create');
	}

	public function edit($id)
	{
		$data['product'] = $this->productModel->find($id);
		$this->call->view('product_edit', $data);
	}

	public function update($id)
	{
		$product_name = $this->io->post('product_name');
		$description = $this->io->post('description');
		$price = $this->io->post('price');
		$quantity = $this->io->post('quantity');

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

		redirect('products/edit/' . $id);
	}

	public function delete($id)
	{
		$this->productModel->delete($id);
		redirect('products');
	}
}
