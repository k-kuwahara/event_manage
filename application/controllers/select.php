<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Select extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->_view("select.tpl");

        // 登録処理
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->postSelect($_POST);
        }
    }

    /**
     * 登録処理
     * @param Array フォームの値
     * @return void
     */
    private function postSelect($arrPost = '') {
        // モデルの読み込み
        $this->load->model('select_model');
        // バリデーションチェック
        $check = $this->checkValidate($arrPost);

        if ($check === FALSE) {
            log_message('debug', 'Validation error');
            $this->_view("select.tpl");
        } else {
            list($result, $mess) = $this->select_model->registerEvent($_POST);

            // 何かしらのエラー発生時
            if ($result === false) {
                show_error($mess);
            } else {
                $this->_view("select_complete.tpl");
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
        $this->form_validation->set_rules('eventTitle', 'イベントタイトル', 'required|max_length[50]');
        $this->form_validation->set_rules('adminEmail', 'メールアドレス', 'required|valid_email|max_length[50]');
        $this->form_validation->set_rules('eventDate', 'イベント日時', 'required|valid_datetime');

        if ($this->form_validation->run() == FALSE) {
            // エラーメッセージのセット
            $errors = array();
            $errors['eventTitle'] = trim(form_error('eventTitle'));
            $errors['adminEmail'] = trim(form_error('adminEmail'));
            $errors['eventDate'] = trim(form_error('eventDate'));

            // パラメータのアサイン
            $this->_assign('arrErr', $errors);
            $this->_assign('forms', $forms);
            return FALSE;
        }

        return TRUE;
    }
}
