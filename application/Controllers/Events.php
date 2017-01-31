<?php namespace App\Controllers;

use CodeIgniter\Controller;
use \App\Models\EventsModel;

class Events extends Controller
{
	public function index()
	{
		// deleteモードの場合イベントを削除
		if ($this->request->getMethod() === 'post' && $this->request->getPost('mode') === 'delete') {
			$ret = $this->eventDelete($this->request->getPost('event_id'));
			if (is_array($ret)) $data['error'] = $ret['error'];
		}
		// イベントの取得
		$data['events'] = $this->getEvents();
		return view('events', $data);
	}

	/**
	 * イベントの取得
	 *
	 * @param  void
	 * @return $events イベント配列
	 */
	private function getEvents()
	{
		// モデルの読み込み
		$events_model = new EventsModel();
		// 取得
		list($events, $mess) = $events_model->getEvents();

		// 何かしらのエラー発生時
		if ($events === false) {
			show_error($mess . 'しました。もう一度お手続きください。');
		} else {
			// 日付チェック
			foreach ($events as $event) {
				if ($event->event_date < date('Y-m-d')) $this->eventDelete($event->event_id);
			}
			return $events;
		}
	}

	/**
	 * 削除処理
	 *
	 * @param  String $event_id イベントID
	 * @return void
	 */
	private function eventDelete($event_id = '')
	{
		// モデルの読み込み
		$events_model = new EventsModel();
		// 削除
		list($events, $mess) = $events_model->deleteEvent($event_id);

		// 何かしらのエラー発生時
		if ($events === false) {
			return ['error' => $mess];
		} else {
			return true;
		}
	}
}
