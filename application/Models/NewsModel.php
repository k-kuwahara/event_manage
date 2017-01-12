<?php
class NewsModel extends \CodeIgniter\Model
{
	protected $table = 'news';

	public function getNews($slug = false)
	{
		if ($slug === false)
		{
				$this->findAll();
		}

		return $this->asArray()
					->where(['slug' => $slug])
					->first();
	}
}
