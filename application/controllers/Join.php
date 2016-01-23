<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            // 登録処理
            $this->update_answer($_POST['e_id']);
            return true;

        case 'GET':
            // 編集の場合は回答情報を取得
            if ($_GET['a_id'] !== null && $_GET['a_id'] != '') {
                $this->get_answer_info($_GET['a_id']);
            }
            $event_id = $_GET['e_id'];
            break;

        default:
            show_error('不正なアクセスです。');
            break;
        }

        // イベント情報取得
        $this->get_event_info($event_id);
    }

    /**
     * イベント情報の取得
     *
     * @param  Int $event_id イベントID
     * @return Void
     */
    private function get_event_info($event_id = '')
    {
        // モデルの読み込み
        $this->load->model('join_model');

        // イベントの取得
        list($events, $mess) = $this->join_model->get_events($event_id);

        // 何かしらのエラー発生時
        if ($events === false) {
            show_error($mess);

        } else {
            // イベント件数によりアサインを変更
            count($events) == 0 ? $this->_assign('event_info', '') : $this->_assign('event_info', $events[0]);

            $this->_assign('e_id', $event_id);
            $this->_view("join.tpl");
        }
    }

    /**
     * 回答情報の取得
     *
     * @param  Void
     * @return Void
     */
    private function get_answer_info($answer_id = '')
    {
        // モデルの読み込み
        $this->load->model('join_model');
        // 回答情報の取得
        list($answer, $mess) = $this->join_model->get_answer($answer_id);

        // 何かしらのエラー発生時
        if ($answer === false) {
            show_error($mess);
        } else {
            $this->_assign('a_id', $answer_id);
            $this->_assign('forms', $answer[0]);
            $this->_view("join.tpl");
        }
    }

    /**
     * 更新処理
     *
     * @param  Array フォームの値
     * @return Void
     */
    private function update_answer($event_id = '')
    {
        // モデルの読み込み
        $this->load->model('join_model');
        // バリデーションチェック
        $check = $this->check_validate($_POST);

        if ($check === false) {
            $this->_assign('e_id', $event_id);
            $this->_view("join.tpl");

        } else {
            list($result, $mess) = $this->join_model->register_member($_POST);

            // 何かしらのエラー発生時
            if ($result === false) {
                show_error($mess . 'しました。もう一度お手続きください。');
            } else {
                $this->_assign('e_id', $_POST['e_id']);
                $this->_view("join_complete.tpl");
                return true;
            }
        }
    }

    /**
     * バリデーションチェック
     *
     * @param  Array $post_data フォームの値
     * @return Array エラー内容
     */
    private function check_validate($post_data)
    {
        $this->load->library('form_validation');

        // フォームの値を保持
        $forms    = [];
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
            $this->_assign('errors', $errors);
            $this->_assign('forms', $forms);
            return false;
        }

        return true;
    }
}
