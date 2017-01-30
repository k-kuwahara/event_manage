<?php namespace App\Controllers;

use \App\Models\EventsModel;

class Events extends \CodeIgniter\Controller
{
	public function index()
	{
		// deleteモードの場合イベントを削除
		if ($this->request->getMethod() === 'post' && $this->request->getPost('mode') === 'delete') {
			$this->eventDelete($this->request->getPost('event_id'));
		} else {
			// イベントの取得
			$data['events'] = $this->getEvents();
			echo view('events', $data);
		}
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
				if ($event->event_date < date('Y-m-d')) $this->event_delete($event->event_id);
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
		$events_model = new Model\EventsModel();
		// 削除
		list($events, $mess) = $events_model->delete_event($event_id);

		// 何かしらのエラー発生時
		if ($events === false) {
			show_error($mess . 'しました。もう一度お手続きください。');
		} else {
			$this->get_events();
		}
	}
}
