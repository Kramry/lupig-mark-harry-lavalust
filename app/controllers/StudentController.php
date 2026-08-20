<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
	protected function student_record()
	{
		return [
			'student_id' => '2024-00263',
			'name'       => 'Mark Harry B. Lupig',
			'course'     => 'BS Information Technology',
			'year'       => '3rd Year',
			'section'    => 'F3',
			'email'      => 'mark.lupig@sgmail.com',
			'address'    => 'Brgy. Batuhan, Pola, Oriental Mindoro, Philippines',
			'contact'    => '0993-944-8360',
			'skills'     => 'PHP, HTML/CSS, Designer, Animation',
			'hobbies'    => 'Sketching, painting, cooking',
			'about'      => 'A student from Mindoro State University, Calapan City Campus, pursuing a degree in Bachelor of Science in Information Technology. I am passionate about web development and design, and I enjoy creating visually appealing and user-friendly websites. In my free time, I like to explore new technologies and improve my skills in programming and design.',
		];
	}

	public function index()
	{
		if (session_status() !== PHP_SESSION_ACTIVE) {
			session_start();
		}

		$_SESSION['student_access'] = true;

		$this->call->view('student_home', [
			'student' => $this->student_record(),
		]);
	}

	public function profile()
	{
		$this->call->view('student_profile', [
			'student' => $this->student_record(),
		]);
	}
}
