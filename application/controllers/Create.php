<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Create extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_view("create.tpl");

        // 登録処理
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->regist_event($_POST);
        }
    }

    /**
     * 登録処理
     *
     * @param  Array $post_data フォームの値
     * @return void
     */
    private function regist_event($post_data = '')
    {
        // モデルの読み込み
        $this->load->model('create_model');
        // バリデーションチェック
        $check = $this->check_validate($post_data);

        if ($check === false) {
            log_message('debug', 'Validation error');
            $this->_view("create.tpl");
        } else {
            list($result, $mess) = $this->create_model->register_event($_POST);

            // 何かしらのエラー発生時
            if ($result === false) {
                show_error($mess);
            } else {
                $this->_view("create_complete.tpl");
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
        $forms    = array();
        foreach ($post_data as $key => $val) {
            $forms[$key] = $val;
        }

        // バリデーションのセット
        $this->form_validation->set_rules('event_title', 'イベントタイトル', 'required|max_length[50]');
        $this->form_validation->set_rules('admin_email', 'メールアドレス', 'required|valid_email|max_length[50]');
        $this->form_validation->set_rules('event_date', 'イベント日時', 'required|valid_datetime');

        if ($this->form_validation->run() == false) {
            // エラーメッセージのセット
            $errors = array();
            $errors['event_title'] = trim(form_error('event_title'));
            $errors['admin_email'] = trim(form_error('admin_email'));
            $errors['event_date'] = trim(form_error('event_date'));

            // パラメータのアサイン
            $this->_assign('errors', $errors);
            $this->_assign('forms', $forms);
            return false;
        }

        return true;
    }
}
