<?php

class Event_model_test extends TestCase {
    // セットアップ
    public function setUp()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('event_model');
        $this->db = $this->CI->event_model;
    }

    public function test_index() {
        $result = $this->db->getEvents();
        
        $this->assertLessThan(count($result), "0");
    }
}
