<?php
  class User_model extends CI_Model
  {

    function __construct()
    {
      parent:: __construct;
    }

    function get($param1)
    {
      echo "get with param: ".$param1;
    }

    function get_all()
    {
      echo "get all";
    }

  }
?>
