<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware {
	public function handle($next) {
		if (session_status() !== PHP_SESSION_ACTIVE) session_start();
		if (!empty($_SESSION['student_access'])) return $next();
		$_SESSION['student_message'] = 'Open the student home page first to unlock this profile.';
		redirect('student');
		exit;
	}
}