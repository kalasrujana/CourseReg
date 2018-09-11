<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author kalas
 */
class User extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
       // if(!isset($_SESSION['user_logged'])){
        if($_SESSION['user_logged']==FALSE){
            $this->session->set_flashdata("error","please login first to  view the page");
            redirect("welcome/Login");
        }
    }
    
    public function profile(){
        
        if($_SESSION['user_logged']==FALSE){
            $this->session->set_flashdata("error","please login first to  view the page");
            redirect("welcome/Login");
        }
        $this->load->view('userprofile');
    }
    
    
}
