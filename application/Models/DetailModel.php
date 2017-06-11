<?php namespace App\Models;

use CodeIgniter\Model;

class DetailModel extends Model
{
	/**
	 * イベントの出欠情報の取得
	 *
	 * @param  Int $event_id エベントID
	 * @return Array 出欠情報
	 */
	public function getAnswer($event_id = '')
	{
		$result = [];
		try {
			// イベントIDが空の場合はエラー
			if ($event_id == '') {
				return [false, '不正なアクセスです。'];
			}

			$query = $this->db
				->table('dt_answer')
				->select(
					"answer_id,
					 event_id,
					 answer_date,
					 (CASE WHEN answer = 1 THEN '出席'
						   WHEN answer = 2 THEN '欠席'
						   ELSE '保留' END) AS answer,
					 answer_name as name,
					 memo")
				->where([
					'event_id' => $event_id,
				])
				->get();
			if ($query === false) {
				return [false, 'データベース参照エラーが発生'];
			}
			return [$query->getResultArray(), ""];

		} catch (Exception $e) {
			return [false, $e->getMessage()];
		}
	}
}