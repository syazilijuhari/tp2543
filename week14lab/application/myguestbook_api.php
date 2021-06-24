<?php
require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
  
class MyGuestBook_Api extends REST_Controller
{
    public function __construct()
    {
       parent::__construct();
       $this->load->database();
       $this->load->model('myguestbook_model');
    }
 
    // Insert your GET, POST, PUT and DELETE methods here
 
}
 
?>