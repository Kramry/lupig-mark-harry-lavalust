<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
	public function login()
	{
		$this->call->view('login');
	}

	public function authenticate()
	{
		$username = $this->io->post('username');
		$password = $this->io->post('password');

		// Simple hardcoded authentication for demonstration
		// In production, you should use proper password hashing and database verification
		if ($username === 'admin' && $password === 'admin123') {
			if (session_status() !== PHP_SESSION_ACTIVE) session_start();
			$_SESSION['authenticated'] = true;
			$_SESSION['username'] = $username;
			redirect('products');
		} else {
			if (session_status() !== PHP_SESSION_ACTIVE) session_start();
			$_SESSION['login_error'] = 'Invalid username or password';
			redirect('login');
		}
	}

	public function logout()
	{
		if (session_status() !== PHP_SESSION_ACTIVE) session_start();
		session_destroy();
		redirect('login');
	}
}
