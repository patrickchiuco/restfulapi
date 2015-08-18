<?php
require(APPPATH.'libraries/REST_Controller.php');
  class API_Sample extends REST_Controller
  {
    function user_get()
    {
      //fetch item
      if(!$this->get("id"))
      {
        $this->response(NULL, 400);
      }
      $user = $this->user_model->get_id($this->get("id"));

      if($user)
      {
        //echo $user;
        $this->response($user,200);
      }
      else
      {
        $this->response(NULL,404);
      }
    }

    function user_post()
    {
      //update item and inform success
      $result = $this->user_model->update( $this->post('id'), array(
          'name' => $this->post('first_name'),
          'email' => $this->post('last_name'),
      ));

      if($result === FALSE)
      {
        $this->response(array("status"=>"failed"));
      }
      else
      {
          $this->response(array("status" => "success"));
      }
    }

    function users_get()
    {
      $users = $this->user_model->get_all();

      if($users)
      {
        $this->response($users, 200);
      }
      else
      {
        $this->response(NULL, 404);
      }
    }

    function item_put()
    {
      //create new item and inform success
      $this->data = array("result" => $this->put("id"));
      $this->response($data);
    }

    function item_delete()
    {
      //delete an item and inform success
      $this->data = array("result" => $this->delete("id"));
      $this->response($data);
    }

    /*
    function items_get()
    {
      //get items
      $this->data = array("result" => $this->get("id"));
    }
    */
  }
