<?php namespace App\Models;

use CodeIgniter\Model;

class CreateModel extends Model
{
	/**
	 * イベントの登録
	 *
	 * @param  Array $params DBに登録する値の配列
	 * @return Bool 登録完了orエラー
	 */
	public function registerEvent($params)
	{
		$result = [];

		try {
			// 重複チェック
			$query = $this->db
					->table('dt_event')
					->select('count(*) as cnt')
					->where(
						[
							'event_title' => $params['event_title'],
							'event_date'  => $params['event_date'],
							'email'	   => $params['admin_email'],
							'del_flg'	 => 0,
						]
					)
					->get();
			$ret = $query->getResult();

			if ($ret[0]->cnt > 0) {
				return [false, '登録済みのデータです。別のイベントを登録してください。'];
			} elseif (! $ret) {
				return [false, 'データベース参照エラーが発生'];
			}

			$result = $this->db
				->table('dt_event')
				->insert(
				[
					'event_title' => $params['event_title'],
					'create_date' => date('Y-m-d H:i:s'),
					'update_date' => date('Y-m-d H:i:s'),
					'event_date'  => $params['event_date'],
					'email'	   => $params['admin_email'],
					'del_flg'	 => 0,
				]
			);

			if ($result === false) {
				return [false, 'データベース登録エラーが発生'];
			}
			return [true, ""];

		} catch (Exception $e) {
			return [false, $e->getMessage()];
		}
	}
}