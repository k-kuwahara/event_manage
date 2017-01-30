<?php
class NewsModel extends \CodeIgniter\Model
{
	protected $table = 'dt_event';

	public function getNews($slug = false)
	{
	        if ($slug === false)
	        {
	                $this->findAll();
	        }

	        return $this->asArray()
				->where(['event_id' => 1])
				->get();
	}
}