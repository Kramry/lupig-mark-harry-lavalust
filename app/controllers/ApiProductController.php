<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiProductController extends Controller
{
	private $productModel;

	public function __construct()
	{
		parent::__construct();
		$this->call->library('api');
		$this->productModel = $this->call->model('ProductModel');
	}

	public function index()
	{
		$this->api->require_method('GET');

		// Simple token validation
		$token = $this->api->get_bearer_token();
		if (empty($token)) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Unauthorized'
			], 401);
		}

		try {
			$products = $this->productModel->all();
			$this->api->respond([
				'status' => 'success',
				'data' => $products
			]);
		} catch (Exception $e) {
			// Return empty array if table doesn't exist or database error
			$this->api->respond([
				'status' => 'success',
				'data' => [],
				'message' => 'Database not configured - returning empty results'
			]);
		}
	}

	public function show($id)
	{
		$this->api->require_method('GET');

		// Simple token validation
		$token = $this->api->get_bearer_token();
		if (empty($token)) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Unauthorized'
			], 401);
		}

		try {
			$product = $this->productModel->find($id);
			if ($product) {
				$this->api->respond([
					'status' => 'success',
					'data' => $product
				]);
			} else {
				$this->api->respond([
					'status' => 'error',
					'message' => 'Product not found'
				], 404);
			}
		} catch (Exception $e) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage()
			], 500);
		}
	}

	public function store()
	{
		$this->api->require_method('POST');

		// Simple token validation
		$token = $this->api->get_bearer_token();
		if (empty($token)) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Unauthorized'
			], 401);
		}

		// Get JSON input from request body
		$jsonInput = file_get_contents('php://input');
		$data = json_decode($jsonInput, true);

		$product_name = $data['product_name'] ?? '';
		$description = $data['description'] ?? '';
		$price = $data['price'] ?? '';
		$quantity = $data['quantity'] ?? '';

		if (empty($product_name) || empty($price) || empty($quantity)) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Product name, price, and quantity are required'
			], 400);
		}

		$productData = [
			'product_name' => $product_name,
			'description' => $description,
			'price' => $price,
			'quantity' => $quantity
		];

		try {
			$id = $this->productModel->insert($productData);
			if ($id) {
				$this->api->respond([
					'status' => 'success',
					'message' => 'Product created successfully',
					'data' => ['id' => $id]
				], 201);
			} else {
				$this->api->respond([
					'status' => 'error',
					'message' => 'Failed to create product'
				], 500);
			}
		} catch (Exception $e) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage()
			], 500);
		}
	}

	public function update($id)
	{
		$this->api->require_method('POST');

		// Simple token validation
		$token = $this->api->get_bearer_token();
		if (empty($token)) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Unauthorized'
			], 401);
		}

		// Get JSON input from request body
		$jsonInput = file_get_contents('php://input');
		$data = json_decode($jsonInput, true);

		$product_name = $data['product_name'] ?? '';
		$description = $data['description'] ?? '';
		$price = $data['price'] ?? '';
		$quantity = $data['quantity'] ?? '';

		if (empty($product_name) || empty($price) || empty($quantity)) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Product name, price, and quantity are required'
			], 400);
		}

		$productData = [
			'product_name' => $product_name,
			'description' => $description,
			'price' => $price,
			'quantity' => $quantity
		];

		try {
			$result = $this->productModel->update($id, $productData);
			if ($result) {
				$this->api->respond([
					'status' => 'success',
					'message' => 'Product updated successfully'
				]);
			} else {
				$this->api->respond([
					'status' => 'error',
					'message' => 'Failed to update product'
				], 500);
			}
		} catch (Exception $e) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage()
			], 500);
		}
	}

	public function delete($id)
	{
		$this->api->require_method('GET');

		// Simple token validation
		$token = $this->api->get_bearer_token();
		if (empty($token)) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Unauthorized'
			], 401);
		}

		try {
			$result = $this->productModel->delete($id);
			if ($result) {
				$this->api->respond([
					'status' => 'success',
					'message' => 'Product deleted successfully'
				]);
			} else {
				$this->api->respond([
					'status' => 'error',
					'message' => 'Failed to delete product'
				], 500);
			}
		} catch (Exception $e) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage()
			], 500);
		}
	}
}
