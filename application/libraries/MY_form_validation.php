<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
    public function __construct() {
        parent::__construct();
    }

   /**
    * Valid DateTime
    *
    * @param   string
    * @return  bool
    */
   public function valid_datetime($str) {
      // 日付と時間を分離
      $datetimes = explode(' ', trim($str));
      $dateData = $datetimes[0];
      $timeData = $datetimes[1];

      // 日付を年月日で分離
      $ymd = explode('/', $dateData);
      // 日付の正確性チェック
      if (!checkdate($ymd[1], $ymd[2], $ymd[0])) {
         return FALSE;
      }

      // 時間を時と分で分離
      $hourmin = explode(':', $timeData);
      // 時間の正確性チェック
      if (0 > $hourmin[0] || $hourmin[0] > 24 ||
          0 > $hourmin[1] || $hourmin[1] > 59) {
         return FALSE;
      }

      return TRUE;
    }
}