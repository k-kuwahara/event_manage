<?php namespace App\Controllers;

use CodeIgniter\Controller;
use \App\Models\CreateModel;

class Create extends Controller
{
	public function index()
	{
		// 登録処理
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->registEvent($this->request->getPost());
		} else {
			$data['errors'] = [];
			$data['forms']  = [];
			return view("create", $data);
		}
	}

	/**
	 * 登録処理
	 *
	 * @param  Array $post_data フォームの値
	 * @return void
	 */
	private function registEvent($postData = '')
	{
		// モデルの読み込み
		$createModel = new CreateModel();
		// バリデーションチェック
		$check = $this->checkValidate($postData);
		$data['errors'] = [];
		$data['forms']  = $postData;

		if ($check === false) {
			return view('create', $data);
		} else {
			list($result, $mess) = $createModel->registerEvent($_POST);

			// 何かしらのエラー発生時
			if ($result === false) {
				$data['errors'] = ['regist' => $mess];
				$data['forms']  = $postData;
				echo view('create', $data);
			} else {
				echo view('create_complete');
			}
		}
	}

	/**
	 * バリデーションチェック
	 *
	 * @param  Array $postData フォームの値
	 * @return Array エラー内容
	 */
	private function checkValidate()
	{
		// バリデーションのチェック
		if (! $this->validate($this->request, [
				'event_title' => 'required|max_length[50]',
				'admin_email' => 'required|valid_email|max_length[50]',
				'event_date'  => 'required|valid_datetime'
			],
			[
				'event_title' => 'タイトルの指定が間違っております',
				'admin_email' => 'メールアドレスの指定が間違っております',
				'event_date'  => '日付の指定が間違っております'
			])
		) {
			return ['errors' => $this->errors];
		}

		return true;
	}
}
