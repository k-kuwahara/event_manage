<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DetailModel;

class Detail extends Controller
{
	public function index()
	{
		// モデルの読み込み
		$detail_model = new DetailModel();
		// イベントIDを取得
		$event_id = $this->request->getGet('id');
		if (is_null($event_id)) {
			showError('不正なアクセスです。');
		}
		list($members, $mess) = $detail_model->getAnswer($event_id);

		// 何かしらのエラー発生時
		if ($members === false) {
			showError($mess . 'しました。もう一度お手続きください。');
		} else {
			$data['members'] = $members;
			return view('detail', $data);
		}
	}
}