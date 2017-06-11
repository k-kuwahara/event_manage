<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\JoinModel;

class Join extends Controller
{
	public function index()
	{
		switch ($this->request->getServer('REQUEST_METHOD')) {
		case 'POST':
			// 登録処理
			$this->updateAnswer($this->request->getPost('e_id'));
			return true;
		case 'GET':
			// 編集の場合は回答情報を取得
			if ($this->request->getGet('a_id') !== null && $this->request->getGet('a_id') != '') {
				$this->getAnswerInfo($this->request->getGet['a_id']);
			}
			$event_id = $this->request->getGet('e_id');
			break;
		default:
			showError('不正なアクセスです。');
			break;
		}
		// イベント情報取得
		$events = $this->getEventInfo($event_id);
		// イベント件数によりアサインを変更
		count($events) == 0 ? $data['event_info'] = '' : $data['event_info'] = $events[0];
		$data['a_id']   = '';
		$data['e_id']   = $event_id;
		$data['errors'] = [];
		$data['forms']  = ['join_result' => 1];
		return view("join", $data);
	}

	/**
	 * イベント情報の取得
	 *
	 * @param  Int $event_id イベントID
	 * @return Void
	 */
	private function getEventInfo($event_id = '')
	{
		// モデルの読み込み
		$join_model = new JoinModel();
		// イベントの取得
		list($events, $mess) = $join_model->getEvents($event_id);
		// 何かしらのエラー発生時
		if ($events === false) {
			$data['errors'] = $mess;
			echo view('join', $data);
		} else {
			return $events;
		}
	}

	/**
	 * 回答情報の取得
	 *
	 * @param  Void
	 * @return Void
	 */
	private function getAnswerInfo($answer_id = '')
	{
		// モデルの読み込み
		$join_model = new JoinModel();
		// 回答情報の取得
		list($answer, $mess) = $join_model->getAnswer($answer_id);
		// 何かしらのエラー発生時
		if ($answer === false) {
			show_error($mess);
		} else {
			$data['a_id'] = $answer_id;
			$data['forms'] = $answer[0];
			echo view("join", $data);
		}
	}
	/**
	 * 更新処理
	 *
	 * @param  Array フォームの値
	 * @return Void
	 */
	private function updateAnswer($event_id = '')
	{
		// モデルの読み込み
		$join_model = new JoinModel();
		// バリデーションチェック
		// $check = $this->checkValidate($this->request->getPost());
		$check = true;
		if ($check === false) {
			$data['e_id']  = $event_id;
			$data['forms'] = $this->request->getPost();
			echo view("join", $data);
		} else {
			list($result, $mess) = $join_model->registerMember($this->request->getPost());
			// 何かしらのエラー発生時
			if ($result === false) {
				showError($mess . 'しました。もう一度お手続きください。');
			} else {
				var_dump($event_id);
				$data['e_id'] = $event_id;
				echo view('join_complete', $data);
			}
		}
	}
	/**
	 * バリデーションチェック
	 *
	 * @param  Array $postData フォームの値
	 * @return Array エラー内容
	 */
	private function checkValidate($postData)
	{
		$this->load->library('form_validation');
		// フォームの値を保持
		$forms	= [];
		foreach ($post_data as $key => $val) {
			$forms[$key] = $val;
		}
		// バリデーションのセット
		$this->form_validation->set_rules('join_name', '参加者名', 'required|max_length[50]');
		$this->form_validation->set_rules('join_email', 'メールアドレス', 'required|valid_email|max_length[50]');
		$this->form_validation->set_rules('join_result', '出欠', 'required|max_length[1]|integer');
		if ($this->form_validation->run() == false) {
			// エラーメッセージのセット
			$errors = [];
			$errors['join_name'] = trim(form_error('join_name'));
			$errors['join_email'] = trim(form_error('join_email'));
			$errors['join_result'] = trim(form_error('join_result'));
			// パラメータのアサイン
			$data['errors'] = $errors;
			$data['forms']  = $forms;
			return false;
		}
		return true;
	}
}