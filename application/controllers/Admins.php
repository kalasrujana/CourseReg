<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admins
 *
 * @author kalas
 */
class Admins extends CI_Controller {
    //put your code here
     public function __construct() {
        parent::__construct();
       // if(!isset($_SESSION['user_logged'])){
        if($_SESSION['user_logged']==FALSE){
            $this->session->set_flashdata("error","please login first to  view the page");
            redirect("AdminCon/adminLogin");
        }
    }
    
    public function profile(){
        
        if($_SESSION['user_logged']==FALSE){
            $this->session->set_flashdata("error","please login first to  view the page");
            redirect("AdminCon/adminLogin");
        }
        $this->load->view('adminProfile');
    }
}
