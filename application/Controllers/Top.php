<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Top extends Controller
{
	public function index()
	{
		// $db = \Config\Database::connect();
		return view('top');
	}
}
