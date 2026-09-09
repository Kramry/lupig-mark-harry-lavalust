<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware {
	public function handle($next) {
		if (session_status() !== PHP_SESSION_ACTIVE) session_start();
		if (!empty($_SESSION['authenticated'])) return $next();
		redirect('login');
		exit;
	}
}
