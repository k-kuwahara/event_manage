<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 各クエリメソッド用モデル
 */
class Query_model extends CI_Model {

    /**
     * レコード抽出メソッド
     * @param　String $table テーブル情報
     * @param String $columns 抽出カラム
     * @param Array $params キー：条件値
     * @return bool 登録成功・失敗
     */
    public function select($table, $columns = '*', $params = '') {
        $ph = array();

        if ($params != '') {
            foreach($params as $key => $val) {
                $ph[] = sprintf('`%s`= ?', $key);
            }
            $sql = sprintf('SELECT %s FROM %s WHERE %s', $columns, $table, implode(' AND ', $ph));
            return $this->db->query($sql, array_values($params));

        } else {
            $sql = sprintf('SELECT %s FROM %s', $columns, $table);
            return $this->db->query($sql, array());
        }

    }

    /**
     * レコード登録メソッド
     * @param　String $table テーブル情報
     * @param Array $params キー:登録値
     * @return bool 登録成功・失敗
     */
    public function insert($table, $params) {
        $sql = sprintf(
            'INSERT INTO %s (`%s`) VALUES (%s)', $table, implode('`,`', array_keys($params)), implode(',', array_pad(array(), count($params), '?'))
        );
        if (!$this->db->query($sql, array_values($params))) return false;

        return true;
    }

    /**
     * レコード更新メソッド
     * @param　String $table テーブル情報
     * @param Array $params キー:登録値
     * @param Array $condition キー：条件値
     * @return bool 登録成功・失敗
     */
    public function update($table, $params = '', $conditions = '') {
        $ph = [];
        $ch = [];

        if ($params != '') {
            // パラメータ用プレースホルダ
            foreach($params as $key1 => $val1) {
                $ph[] = sprintf('`%s`= ?', $key1);
            }
            // where句用プレースホルダ
            foreach($conditions as $key2 => $val2) {
                $ch[] = sprintf('`%s`= ?', $key2);
            }


            // where句の指定をセット
            if (count($ch) > 0) {
                $sql = sprintf('UPDATE %s SET %s WHERE %s', $table, implode(',', $ph), implode(' AND ', $ch));
            } else {
                $sql = sprintf('UPDATE %s SET %s', $table, implode(',', $ph));
            }
            $mergeParam = array_merge($params, $conditions);

            return $this->db->query($sql, array_values($mergeParam));
        }

        return true;
    }

    /**
     * レコード論理削除メソッド
     * @param　String $table テーブル情報
     * @param Array $params WHERE句パラメータ キー:条件値
     * @return bool 登録成功・失敗
     */
    public function logicalDelete($table, $params = '') {
        $ph = array();

        if ($params != '') {
            foreach($params as $key => $val) {
                $ph[] = sprintf('`%s`= ?', $key);
            }
            $sql = sprintf('UPDATE %s SET del_flg = 1 WHERE %s', $table, implode(' AND ', $ph));
            return $this->db->query($sql, array_values($params));

        } else {
            $sql = sprintf('UPDATE %s SET del_flg = 1', $table);
            return $this->db->query($sql, array());
        }
    }

    /**
     * レコード物理削除メソッド
     * @param　String $table テーブル情報
     * @param Array $params WHERE句パラメータ キー:条件値
     * @return bool 登録成功・失敗
     */
    public function physicalDelete($table, $params = '') {
        $ph = array();

        if ($params != '') {
            foreach($params as $key => $val) {
                $ph[] = sprintf('`%s`= ?', $key);
            }
            $sql = sprintf('DELETE FROM %s WHERE %s', $table, implode(' AND ', $ph));
            return $this->db->query($sql, array_values($params));

        } else {
            // 全件削除
            $sql = sprintf('DELETE FROM %s', $table);
            return $this->db->query($sql, array());
        }
    }
}