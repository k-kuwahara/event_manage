<?php namespace App\Models;

use CodeIgniter\Model;

class JoinModel extends Model
{
	/**
	 * 終了していないイベント情報の取得
	 *
	 * @param  Int $event_id イベントID
	 * @return Array イベント情報
	 */
	public function getEvents($event_id = '')
	{
		try {
			// イベントIDが空の場合はエラー
			if ($event_id == '') {
				return [false, '不正なアクセスです。'];
			}
			$query = $this->db
				->table('dt_event')
				->select('event_id, event_title, event_date, email, del_flg')
				->where([
					'event_id' => $event_id,
					'del_flg'  => 0,
				])
				->get();
			if ($query === false) {
				return [false, 'データベース参照エラーが発生'];
			}
			return [$query->getResultArray(), ''];
		} catch (Exception $e) {
			return [false, $e->getMessage()];
		}
	}
	/**
	* イベントの登録
	*
	* @param  Array $params DBに登録する値の配列
	* @return Bool 登録完了orエラー
	*/
	public function registerMember($params)
	{
		$result = false;
		try {
			if ($params == '' || empty($params)) {
				return [false, 'データベース参照エラーが発生'];
			}
			if (! empty($params['a_id'])) {
				$result = $this->db
					->table('dt_answer')
					->set([
						'event_id'	=> $params['e_id'],
						'answer_date' => date('Y-m-d H:i:s'),
						'answer'	  => $params['join_result'],
						'answer_name' => $params['join_name'],
						'email'	   => $params['join_email'],
						'memo'		=> $params['join_memo'],
					])
					->where([
						'answer_id' => $params['a_id']
					])
					->update();
			} else {
				$result = $this->db
					->table('dt_answer')
					->insert([
						'event_id'	=> $params['e_id'],
						'answer_date' => date('Y-m-d H:i:s'),
						'answer'	  => $params['join_result'],
						'answer_name' => $params['join_name'],
						'email'	   => $params['join_email'],
						'memo'		=> $params['join_memo'],
					]);
			}

			if ($result === false) {
				return [false, 'データベース参照エラーが発生'];
			}
			return [true, ""];

		} catch (Exception $e) {
			return [false, $e->getMessage()];
		}
	}
	/**
	 * イベントの回答情報取得
	 *
	 * @param  Int $answer_id イベントID
	 * @return Array イベント情報
	 */
	public function getAnswer($answer_id = '')
	{
		$result = [];
		try {
			// イベントIDが空の場合はエラー
			if ($answer_id == '') {
				return [false, '不正なアクセスです。'];
			}
			$ret = $this->query_model->select(
				'dt_answer',
				'answer_id,
				 event_id,
				 answer as join_result,
				 answer_name as join_name,
				 email as join_email,
				 memo as join_memo',
				[
					'answer_id' => $answer_id,
				]
			);
			if ($ret === false) {
				return [false, 'データベース参照エラーが発生'];
			}
			$result = $ret->result_array();
			return [$result, ""];
		} catch (Exception $e) {
			return [false, $e->getMessage()];
		}
	}
}