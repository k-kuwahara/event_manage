<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
         switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                // 登録処理
                $this->updateAnswer($_POST['eId']);

                return TRUE;

            case 'GET':
                // 編集の場合は回答情報を取得
                if ($_GET['a_id'] !== NULL && $_GET['a_id'] != '') $this->getAnswerInfo($_GET['a_id']);
                $eventId = $_GET['e_id'];
                break;

            default:
                show_error('不正なアクセスです。');
                break;
        }

        // イベント情報取得
        $this->getEventInfo($eventId);

    }

    /**
     * イベント情報の取得
     * @param void
     * @return void
     */
    private function getEventInfo($eventId = '') {
        // モデルの読み込み
        $this->load->model('join_model');

        // イベントの取得
        list($events, $mess) = $this->join_model->getEvents($eventId);

        // 何かしらのエラー発生時
        if ($events === FALSE) {
            show_error($mess);

        } else {
            // イベント件数によりアサインを変更
            count($events) == 0 ? $this->_assign('eventInfo', '') : $this->_assign('eventInfo', $events[0]);

            $this->_assign('eId', $eventId);
            $this->_view("join.tpl");
        }
    }

    /**
     * 回答情報の取得
     * @param void
     * @return void
     */
    private function getAnswerInfo($answerId = '') {
        // モデルの読み込み
        $this->load->model('join_model');
        // 回答情報の取得
        list($answer, $mess) = $this->join_model->getAnswer($answerId);

        // 何かしらのエラー発生時
        if ($answer === FALSE) {
            show_error($mess);
        } else {
            $this->_assign('aId', $answerId);
            $this->_assign('forms', $answer[0]);
            $this->_view("join.tpl");
        }
    }

    /**
     * 更新処理
     * @param Array フォームの値
     * @return void
     */
    private function updateAnswer($eventId = '') {
        // モデルの読み込み
        $this->load->model('join_model');
        // バリデーションチェック
        $check = $this->checkValidate($_POST);

        if ($check === FALSE) {
            $this->_assign('eId', $eventId);
            $this->_view("join.tpl");

        } else {
            list($result, $mess) = $this->join_model->registerMember($_POST);

            // 何かしらのエラー発生時
            if ($result === FALSE) {
                show_error($mess . 'しました。もう一度お手続きください。');
            } else {
                $this->_assign('eId', $_POST['eId']);
                $this->_view("join_complete.tpl");
                return TRUE;
            }
        }
    }

    /**
     * バリデーションチェック
     * @param Array フォームの値
     * @return Array エラー内容
     */
    private function checkValidate($arrPost) {
        $this->load->library('form_validation');

        // フォームの値を保持
        $forms    = array();
        foreach ($arrPost as $key => $val) {
            $forms[$key] = $val;
        }

        // バリデーションのセット
        $this->form_validation->set_rules('joinName', '参加者名', 'required|max_length[50]');
        $this->form_validation->set_rules('joinEmail', 'メールアドレス', 'required|valid_email|max_length[50]');
        $this->form_validation->set_rules('joinResult', '出欠', 'required|max_length[1]|integer');

        if ($this->form_validation->run() == FALSE) {
            // エラーメッセージのセット
            $errors = array();
            $errors['joinName'] = trim(form_error('joinName'));
            $errors['joinEmail'] = trim(form_error('joinEmail'));
            $errors['joinResult'] = trim(form_error('joinResult'));

            // パラメータのアサイン
            $this->_assign('arrErr', $errors);
            $this->_assign('forms', $forms);
            return FALSE;
        }

        return TRUE;
    }
}
