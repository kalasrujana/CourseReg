<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacultyCon
 *
 * @author kalas
 */
class FacultyCon  extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
    }
    
    //will load the facultyLogin.php from views
    public function facultyLogin(){
        //validations
                  $this->form_validation->set_rules('uName', 'UserName', 'required');
                  $this->form_validation->set_rules('pwd', 'Password', 'required|min_length[3]');
                  if($this->form_validation->run()==true){
                      //check the user in db
                      $un1=$_POST['uName'];
                      $un= trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $un1)));
                      //$hashe= $this->db->get('user')->row('passwordhash');
                      //$pwd= trim($hashe);
                      $password= md5($_POST['pwd']);
                      
                      $this->db->select('*');
                      $this->db->from('user');
                      $this->db->where(array('username'=>$un,'passwordhash'=>$password,'role'=>2));
                      $query= $this->db->get();
                      $user=$query->row();
                     $rowcount=$query->num_rows();
                      //if there are no rows i.e the un and pwd comb for admin rows is not there
                      if($rowcount==0){
                          //just use the session variable in the admin login page to display the error
                          $this->session->set_flashdata("error","Login Failed:Check the Username and password and tryagain.");
                         redirect("facultyCon/facultyLogin");
                      }else{
                           //if user exists
                           if($user->email){ 
                          //echo "hi";
                          //temporary message
                          $this->session->set_flashdata("success","You are logged in");
                          
                          //set the session variables
                          $_SESSION['user_logged']=true;
                          //last username is the column name
                          $_SESSION['username']=$user->username;
                          
                          //redirect to profile page
                          redirect("faculty/profile");
                          
                             }
                      
                      else{
                         $this->session->set_flashdata("error","No such account in the database");
                        redirect("FacultyCon/facultyLogin");
                         
                          }
                     }
                  }
           //echo "login page";
                  //load the faculty login page from views
        $this->load->view('facultyLogin');
    }
    public function Logout(){
            unset($_SESSION);
            session_destroy();
            redirect("Welcome/welcomeView");
        }
}
