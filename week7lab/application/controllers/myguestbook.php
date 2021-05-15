<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class MyGuestBook extends CI_Controller {
 
    function __construct() {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('myguestbook_model');
    }
 
    function index() {
      $data['title'] = 'MyGuestBook';
      $this->load->view('mainmenu', $data);
    }

    public function view() {
      $data['result'] = $this->myguestbook_model->read(null, null, null);
      $data['title'] = 'List of All Comments';
      $this->load->view('list', $data);
    }
}
 
?>