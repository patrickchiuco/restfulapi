<?php
  class User_model extends CI_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    function get_id($param1)
    {
      $query = $this->db->get_where('data', array('id'=>$param1));
      $result = $query->result();
      return $result;
      //$result_formatted = json_encode($result);
      //return $result_formatted;
    }

    function get_all()
    {
      echo "get all";
    }

  }
?>
