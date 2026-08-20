<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller {
	private function student() {
		return [
			'student_id' => '2024-00263',
			'name' => 'Lupig, Mark Harry',
			'course' => 'BSIT',
			'year' => '3rd Year',
			'section' => 'F3',
			'email' => 'lupigmarkharry539@gmail.com',
		];
	}

	public function index() {
		if (session_status() !== PHP_SESSION_ACTIVE) session_start();
		$_SESSION['student_access'] = true;
		$this->call->view('student_home', ['student' => $this->student()]);
	}

	public function profile() {
		$this->call->view('student_profile', ['student' => $this->student()]);
	}
}