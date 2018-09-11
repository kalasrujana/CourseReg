<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
        public function __construct() {
            parent::__construct();
            // load form and url helpers
            //to destroy the cache
            $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
        }
        //to load the welcome.php page in views
        public function welcomeView(){
            
            //check the submit and enter into the dropown loop
            if($this->input->post('login')==true){
                //take the user input from the drop down
                $roleValue=$_POST['role'];
                //redirecting to corresponding pages basing on dropdown values selected
                if($roleValue==3){
                    redirect("welcome/login");
                }else if($roleValue==2){
                    redirect("facultyCon/facultyLogin");
                }else if($roleValue==1){
                    redirect("admincon/adminLogin");
                }
                else {
                    echo "<center><div style='margin-top:80px;color:yellow;'>please select the role and click on submit.</div></center>";
                }
            }
            $this->load->view('welcome');
            
        }

        //user or student login page -Userlogin.php in views
        public function Login()
	{
                   //validations
                  $this->form_validation->set_rules('uName', 'UserName', 'required');
                  $this->form_validation->set_rules('pwd', 'Password', 'required|min_length[3]');
                  if($this->form_validation->run()==true){
                      //check the user in db
                      $un1=$_POST['uName'];
                      $un= trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $un1)));
                      $password= md5($_POST['pwd']);
                      $this->db->select('*');
                      $this->db->from('user');
                      $this->db->where(array('username'=>$un,'passwordhash'=>$password,'role'=>3));
                      $query= $this->db->get();
                      $user=$query->row();
                     // $rowcount=$query->num_rows();
                       $rowcount=$query->num_rows();
                      //if there are no rows i.e the un and pwd comb for user rows is not there
                      if($rowcount==0){
                          //just use the session variable in the admin login page to display the error
                          $this->session->set_flashdata("error","Login Failed:Check the Username and password and tryagain.");
                         //redirect("welcome/Login","refresh");
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
                          redirect("user/profile");
                          
                      }
                      
                      else{
                         $this->session->set_flashdata("error","No such account in the database");
                        redirect("Welcome/Login","refresh");
                         
                      }
                      }   
                      
                  }
           //echo "login page";
                  //load the user login page from views
          $this->load->view('UserLogin');
           
	}
        
        public function Logout(){
            unset($_SESSION);
            session_destroy();
          //  redirect("welcome/Login","refresh");
            redirect("welcome/welcomeView","refresh");
        }

        //to check the username duplicate entry
        public function isUsernameExists($uName){
            
           $this->load->model('dbModel');
           $result=$this->dbModel->userExists($uName);
           //print_r($result);
           if($result==1){
               //echo "username already exists";
                $this->form_validation->set_message('isUsernameExists', 'UserName already exists');
                return FALSE; 
           }
           
        }

        //load the user Registration view page
        public function stuRegister(){
           
            if(isset($_POST['register'])){
                //validations
                 $this->load->helper('security'); 
                $this->form_validation->set_rules('fName', 'First Name', 'trim|required|alpha');
                 $this->form_validation->set_rules('uName', 'User Name', 'trim|callback_isUsernameExists');
                 $this->form_validation->set_rules('mail', 'Email Field', 'trim|required|valid_email');
                 $this->form_validation->set_rules('pwd', 'Password', 'required|min_length[3]');
                 $this->form_validation->set_rules('conpwd','Confirm Password', 'required|matches[pwd]');
               $this->form_validation->set_rules('lName','Last Name','trim|alpha');
                //$this->form_validation->set_rules('phone', 'Phone Number', 'numeric|regex_match[^(?!(\d)\1{9})(?!0123456789|1234567890|0987654321|9876543210)\d{10}$]');
                $this->form_validation->set_rules('address', 'Address', 'trim');
                //form validation
                if($this->form_validation->run()==true){
                    echo "form validated";
                    //Take the input from user and assign to the columns
                    //using the hashing md5 to give security to password
                    //'passwordhash'=> md5($_POST['pwd']) using md5
                    //password_hash($_POST['pwd'],PASSWORD_BCRYPT)
                    //but bycrypt is more secure than md5
                    $data=array(
                        'firstname'=>filter_input(INPUT_POST, 'fName'),
                        'username'=>$_POST['uName'],
                        'email'=>$_POST['mail'],
                        'passwordhash'=> md5($_POST['pwd']),
                        'role'=>$_POST['role'],
                        'gender'=>$_POST['gender'],
                        'lastname'=>$_POST['lName'],
                        'phone'=>$_POST['phone'],
                        'address'=>$_POST['address']
                         );
                   
            $this->load->model('dbModel'); //model names in small
             //add user to data base through model
            if($this->dbModel->userRegModel($data))
            {
                //$this->session->set_flashdata("success","Your account has been registered.Click on Welcome and Login.");
               // echo "Data inserted";
                
                 $this->session->set_flashdata("success","Your account has been registered.Click on Welcome and Login.");
                 redirect("Welcome/stuRegister");
                //stuRegister
                
            }else{
                echo "Failed to register";
            }    
                }
            }
             $this->load->view('Registration');
        }
        
       Public function aboutMe(){
       $this->load->view('bootstrapTemplate/view_header');
            $this->load->view('bootstrapTemplate/view_menu');
       $this->load->view('aboutMeView');
   }

    Public function contactUs(){
       $this->load->view('bootstrapTemplate/view_header');
            $this->load->view('bootstrapTemplate/view_menu');
       
       $this->load->view('contactUsView');
   }
   public function forceLogout(){
       $this->welcomeView();
   } 
        
   public function resetPwd(){
       if(isset($_POST['email']) & !empty($_POST['email'])){
           $this->load->library('form_validation');
           $this->form_validation->set_rules('email', 'Email Address', 'trim|required|min_length[6]|max_length[50]|valid_email|xss_clean');
           if($this->form_validation->run()==FALSE){
              $this->load->view('resetPwdView',array('error'=>'Please supply a valid email address'));  
           }else{
               //true
              $email=trim($this->input->post('email'));
              $this->load->model('dbModel');
              $result= $this->dbModel->email_exists($email);
              
              if($result){
                  $this->send_reset_password_email($email,$result);
                  $this->load->view('pwdSent',array('email'=>$email));
              } else {
                  $this->load->view('resetPwdView',array('error'=>'Email address not registered'));
              }
           }
       } else {
           $this->load->view('resetPwdView');    
       }
   }
   
   public function reset_password_email($email,$email_code){
       if(isset($email,$email_code)){
           $email=trim($email);
           $email_hash= md5($email.$email_code);
           $verified= $this->dbModel->verify_reset_password_codde($email,$email_code);
           
           if($verified){
               $this->load->view('view_update_passowrd',array('email_hash'=>$email_hash,'email_code'=>$email_code,'email'=>$email));
           }else{
             $this->load->view('resetPwdView',array('error'=>'There was a problem with your link','email'=>$email));   
           }
       }
   }
   
   public function send_reset_password_email($email,$username){
       $this->load->library('email');
       $email_code= md5($this->config->item('salt').$username);
       $this->email->set_mailtype('html');
       $this->email->from($this->config->item('bot_email','Forum'));
       $this->email->to($email);
       $this->email->subject('resset pwd');
       $message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <head><body>';
       $message.='<p>Dear'.$username.',</p>';
       $message.='</body></html>';
       $this->email->message($message);
       $this->email->send();
       
   }
   
   public function userRegister(){
           
            if(isset($_POST['register'])){
                //validations
                 $this->load->helper('security'); 
                $this->form_validation->set_rules('fName', 'FirstName', 'trim|required|alpha|min_length[2]');
                 $this->form_validation->set_rules('uName', 'UserName', 'trim|callback_isUsernameExists');
                 $this->form_validation->set_rules('mail', 'Email Field', 'trim|required|valid_email');
                 $this->form_validation->set_rules('pwd', 'Password', 'required|min_length[3]');
                 $this->form_validation->set_rules('conpwd','confirm', 'required|matches[pwd]');
               $this->form_validation->set_rules('lName','Last Name','trim|alpha|min_length[2]');
                //$this->form_validation->set_rules('phone', 'Phone Number', 'numeric|regex_match[^(?!(\d)\1{9})(?!0123456789|1234567890|0987654321|9876543210)\d{10}$]');
                $this->form_validation->set_rules('address', 'Address', 'trim');
                //form validation
                if($this->form_validation->run()==true){
                    echo "form validated";
                    //Take the input from user and assign to the columns
                    //using the hashing md5 to give security to password
                    //'passwordhash'=> md5($_POST['pwd']) using md5
                    //password_hash($_POST['pwd'],PASSWORD_BCRYPT)
                    //but bycrypt is more secure than md5
                    $data=array(
                        'firstname'=>filter_input(INPUT_POST, 'fName'),
                        'username'=>$_POST['uName'],
                        'email'=>$_POST['mail'],
                        'passwordhash'=> md5($_POST['pwd']),
                        'role'=>$_POST['role'],
                        'gender'=>$_POST['gender'],
                        'lastname'=>$_POST['lName'],
                        'phone'=>$_POST['phone'],
                        'address'=>$_POST['address']
                         );
                   
            $this->load->model('dbModel'); //model names in small
             //add user to data base through model
            if($this->dbModel->userRegModel($data))
            {
                //$this->session->set_flashdata("success","Your account has been registered.Click on Welcome and Login.");
               // echo "Data inserted";
                
                 $this->session->set_flashdata("success","User has been added successfully!!");
                 redirect("Welcome/userRegister");
                //stuRegister
                
            }else{
                echo "Failed to register";
            }    
                }
            }
             $this->load->view('Admin/userRegistration');
        }

       
}
