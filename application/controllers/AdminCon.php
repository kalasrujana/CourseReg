<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminCon
 *
 * @author kalas
 */
class AdminCon extends CI_Controller {
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('dbModel');
        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
    }
    
    //loads the adminlogin.php from the views
    public function adminLogin(){
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
                      $this->db->where(array('username'=>$un,'passwordhash'=>$password,'role'=>1));
                      $query= $this->db->get();
                      $user=$query->row();
                      $rowcount=$query->num_rows();
                      //if there are no rows i.e the un and pwd comb for admin rows is not there
                      if($rowcount==0){
                          //just use the session variable in the admin login page to display the error
                          $this->session->set_flashdata("error","Login Failed:Check the Username and password and tryagain.");
                         //redirect("adminCon/adminLogin","refresh");
                      }
                      else{
                        //if user exists
                        if($user->email){ 
                            //temporary message
                            $this->session->set_flashdata("success","You are logged in");
                            //set the session variables
                            $_SESSION['user_logged']=true;
                            //last username is the column name
                            $_SESSION['username']=$user->username;
                            
                            //redirect to profile page
                            redirect("Admins/profile");
                        }
                        else{
                         //if user with no email 
                        $this->session->set_flashdata("error","No account in the database");
                        redirect("adminCon/adminLogin","refresh");
                        }
                     }   
                  }
        //load the admin login page from views
        $this->load->view('adminLogin');
    }
    
     public function Logout(){
         //echo $_SESSION['username'];
            unset($_SESSION);
           // echo $_SESSION['username'];
            session_destroy();
            //redirect("adminCon/adminLogin");
            redirect("welcome/welcomeView","refresh");
        }
        //check for duplicate courseID in database
        public function isCourseIdExists($cid){
            
           $this->load->model('dbModel');
           $result=$this->dbModel->courseExists($cid);
           //print_r($result);
           if($result==1){
               //echo "username already exists";
                $this->form_validation->set_message('isCourseIdExists', 'Course ID already exists');
                return FALSE; 
           }
           
        }
        
        public function addCourse(){
            $this->load->model('adminModel');
           
            $data['groups'] = $this->adminModel->getAllfaculty();
            
            if(isset($_POST['addCourse'])){
              //validations
                //$this->form_validation->set_rules('cid', 'courseid', 'trim|required|alpha_numeric|callback_username_check');
                $this->form_validation->set_rules('cid', 'courseid', 'trim|alpha_numeric|min_length[4]|max_length[10]|callback_isCourseIdExists');
                $this->form_validation->set_rules('couName', 'Course Name', 'trim|required');
              // $this->form_validation->set_rules('selectDate', 'Creation Date', 'required');
                $this->form_validation->set_rules('yr', 'year', 'trim|min_length[4]|max_length[4]|numeric');
               
                if($this->form_validation->run()==true){
                    //take the input from user in an array
                    $data=array(
                    'course_ID'=>$_POST['cid'],
                    'course_Name'=>$_POST['couName'],
                    
                    'year'=>$_POST['yr'],
                    'semester'=>$_POST['sem'],
                    'credit_Hours'=>$_POST['hrs'],
                    'department'=>$_POST['dept'],
                    'faculty_ID'=>$_POST['insName']
                    );
                    $this->load->model('adminModel');
                     //add user to data base through model
                    if($this->adminModel->insertCourseData($data))
                    {
                        $this->session->set_flashdata("success","You have added course successfully.");
                        //echo "Data inserted";
                       redirect("AdminCon/addCourse");

                    }else{
                        echo "Failed to insert Faculty data";
                    }
                }
                
            }
            //to load the faculty into the dropdown 
            
            $this->load->view('admin/addCourse',$data); 
        }
        
        
        public function changePassword(){
            if($_SESSION['user_logged']==FALSE){
                $this->session->set_flashdata("error","please login first to  view the page");
            redirect("AdminCon/adminLogin");
        }
            
            if(isset($_POST['uPwd'])){
                //validations
            $this->form_validation->set_rules('curPwd', 'current Password', 'required|min_length[3]');
            $this->form_validation->set_rules('nPwd', 'new Password', 'required|min_length[3]');
            $this->form_validation->set_rules('conPwd', 'confirm Password', 'required|matches[nPwd]');
             if($this->form_validation->run()==true){
                // echo "form validated"; 
                //take the inputs and update the password
                 $curPwd=md5($_POST['curPwd']);
                 $newPwd=md5($_POST['nPwd']);
                 $conPwd=md5($_POST['conPwd']);
                 //$_SESSION['username']=$user->username;
                 //to get the logged in user
                 $userName=$_SESSION['username'];
               //  echo $userName;
                $this->load->model('adminModel');
                $password=$this->adminModel->getCurrentPwd($userName);
                //will have all the columns and values from the database
                //print_r($password);
                //if the current password that the user typed and the db password are same
                if($password->passwordhash==$curPwd){
                    //if the new and confirm pwds matches
                    if($newPwd==$conPwd){
                        //update the current pwd with new password
                    if($this->adminModel->updatePwd($newPwd,$userName)){
                         $this->session->set_flashdata("success","Password updated successfully!!");
                         redirect('AdminCon/changePassword');
                           //echo "Password updated successfully!!"; 
                        }else{
                            $this->session->set_flashdata("error","failed to update passowrd");
                            //echo "failed to update passowrd";
                        }  
                        
                    }else{
                        $this->session->set_flashdata("error","New and confirm password not matched!!Please try again");
                       //echo "New and confirm password not matched!!Please try again"; 
                    }
                    
                }
                else{
                    $this->session->set_flashdata("error","current password is not matched!!Please try again.");

                    //echo "current password is not matched!!Please try again";
                }
                
             }
            }
            $this->load->view('changePassword');
            $this->load->model('adminModel');
        }
        
        
        
}
