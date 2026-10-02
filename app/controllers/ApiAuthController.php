<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuthController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->call->library('api');
	}

	public function login()
	{
		$this->api->require_method('POST');

		// Get JSON input from request body
		$jsonInput = file_get_contents('php://input');
		$data = json_decode($jsonInput, true);

		$username = $data['username'] ?? '';
		$password = $data['password'] ?? '';

		if (empty($username) || empty($password)) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Username and password are required'
			], 400);
		}

		// Simple hardcoded authentication for demonstration
		// In production, you should use proper password hashing and database verification
		if ($username === 'admin' && $password === 'admin123') {
			// Generate a simple token (in production, use proper JWT)
			$token = base64_encode($username . ':' . time() . ':' . md5(uniqid()));

			$this->api->respond([
				'status' => 'success',
				'message' => 'Login successful',
				'data' => [
					'token' => $token,
					'username' => $username
				]
			]);
		} else {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Invalid username or password'
			], 401);
		}
	}

	public function verify()
	{
		$this->api->require_method('GET');

		$token = $this->api->get_bearer_token();

		if (empty($token)) {
			$this->api->respond([
				'status' => 'error',
				'message' => 'No token provided'
			], 401);
		}

		// Simple token validation (in production, use proper JWT validation)
		$decoded = base64_decode($token);
		$parts = explode(':', $decoded);

		if (count($parts) >= 1) {
			$username = $parts[0];
			$this->api->respond([
				'status' => 'success',
				'message' => 'Token is valid',
				'data' => [
					'username' => $username
				]
			]);
		} else {
			$this->api->respond([
				'status' => 'error',
				'message' => 'Invalid token'
			], 401);
		}
	}
}
