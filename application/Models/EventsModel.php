<?php namespace App\Models;

use CodeIgniter\Model;

class EventsModel extends Model
{
	/**
	 * 終了していないイベント情報の取得
	 *
	 * @param  Void
	 * @return Array イベント情報
	 */
	public function getEvents()
	{
		try {
			$query = $this->db->table('dt_event')
					->select('event_id, event_title, event_date, email, del_flg')
					->where(['del_flg' => 0])
					->get();
			return [$query->getResult(), ''];

		} catch (Exception $e) {
			return [false, $e->getMessage()];
		}
	}

	/**
	 * イベント情報の削除
	 *
	 * @param  Int $event_id イベントID
	 * @return Array イベント情報
	 */
	public function deleteEvent($event_id = '')
	{
		try {
			return $this->db->table('dt_event')
					->set('del_flg', 1)
					->where(['event_id' => $event_id])
					->update();

		} catch (Exception $e) {
			return [false, $e->getMessage()];
		}
	}
}