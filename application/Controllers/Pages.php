<?php
class Pages extends CodeIgniter\Controller
{
	public function view($page = 'home')
	{
		var_dump(APPPATH.'/Views/Pages/'.$page.'.php');
		if ( ! file_exists(APPPATH.'/Views/Pages/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\PageNotFoundException($page);
		}
		$data['title'] = ucfirst($page); // Capitalize the first letter

		echo view('templates/header', $data);
		echo view('pages/'.$page, $data);
		echo view('templates/footer', $data);
	}
}
