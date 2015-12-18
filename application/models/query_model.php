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
     * @return bool 登録成功・失敗
     */
    public function update($table, $params = '', $condition = '') {
        $ph = array();

        if ($params != '') {
            foreach($params as $key => $val) {
                $ph[] = sprintf('`%s`= ?', $key);
            }

            // where句の指定をセット
            if ($condition != '') {
                $sql = sprintf('UPDATE %s SET %s WHERE %s', $table, implode(',', $ph), $condition);
            } else {
                $sql = sprintf('UPDATE %s SET %s', $table, implode(',', $ph));
            }
            return $this->db->query($sql, array_values($params));
        }

        return true;
    }

    /**
     * レコード論理削除メソッド
     * @param　String $table テーブル情報
     * @param Array $params キー:条件値
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
            $sql = sprintf('UPDATE %s del_flg = 1', $table);
            return $this->db->query($sql, array());
        }
    }

    /**
     * レコード物理削除メソッド
     * @param　String $table テーブル情報
     * @param Array $params キー:条件値
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