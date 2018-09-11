<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_Controller extends CI_Controller
{
    public function __construct() {
        parent::__construct();
         $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
    }
    protected $data=array();
            function my_page_builder($content,$title=null){
	   $this->load->view('include/header',$data=array('title'=>$title));
	   $this->load->view($content);
	   $this->load->view('include/footer');
   }
   
   function my_page_builder1($content,$data){
	   $this->load->view('include/header');
	   $this->load->view($content,$data);
	   $this->load->view('include/footer');
   }
   
  
}