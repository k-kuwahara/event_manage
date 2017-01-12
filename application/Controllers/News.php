<?php
use App\Models\NewsModel;

class News extends \CodeIgniter\Controller
{
	public function index()
	{
		$model = new NewsModel();

		$data['news'] = $model->getNews();
	}

	public function view($slug = null)
	{
		$model = new NewsModel();

		$data['news'] = $model->getNews($slug);
	}
}