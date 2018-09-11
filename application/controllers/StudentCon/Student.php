<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 *
 * @author kalas
 */
class Student extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
         $this->load->model('Student/studentModel');
         $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
    }

        public function stu_Profile_Display(){
        if(isset($_POST['updateProfile'])){
                //validations
               
                 $this->form_validation->set_rules('fName', 'First Name', 'trim|required|alpha');
                $this->form_validation->set_rules('lName', 'Last Name', 'trim|required|alpha');
                 $this->form_validation->set_rules('mail', 'Email Field', 'trim|required|valid_email');
                //form validation
                if($this->form_validation->run()==true){
                    //Take the input from user and assign to the columns
                        $firstname=$_POST['fName'];
                        $email=$_POST['mail'];
                        $lastname=$_POST['lName'];
                        $phone=$_POST['phone'];
                        $address=$_POST['address'];
                        $userName=$_SESSION['username'];
            $this->load->model('Student/studentModel'); //model names in small
             //update user details to data base through model
            if($this->studentModel->userUpdateModel($firstname,$email,$lastname,$phone,$address,$userName))
            {
                //echo "Data Updated";
                $this->session->set_flashdata("success","Data Updated");
                redirect('StudentCon/Student/stu_Profile_Display');
            }else{
                echo "Failed to Update data";
            }    
                }
            }
        $this->load->view('Student/studentProfile');
    }
    
    public function index()
 {

  $this->load->view('Student/studentTermSelection');
 }

 
 
 public function fetch_sem1()
 {
  //if($this->input->post('semester'))
  //{
     $yr=$this->input->post('yr');
      $semValue= $this->input->post('semester');
      $uid= $this->input->post('uID');
     //echo $yr;;
       $this->load->model('Student/studentModel');
       $courses= $this->studentModel->fetch_semi($yr,$semValue,$uid);
  //}
  echo json_encode($courses);
 }
 
 public function enrollCourse(){
     
     if($this->input->post('enroll')){
         $sem=$this->input->post('semester');
         $courseid=$this->input->post('cou');
         $yr= $this->input->post('yr');
         $uID=$this->input->post('uID');
         $this->load->model('Student/studentModel');
         $facID= $this->studentModel->retrieveFaculty($courseid);
         
         //echo $sem;
         //echo $courseid;    
         //echo $uID;
         //echo $facID;
         $data=array(
                    'facultyID'=>$facID->faculty_ID,
                    'courseid'=>$_POST['cou'],
                    'userid'=>$_POST['uID'],
                    'sem'=>$_POST['semester'],
                    'year'=>$_POST['yr']
                    );
                   $this->load->model('Student/studentModel');
                     //add user to data base through model
                    if($this->studentModel->insertCourseData($data))
                    {
                        $this->session->set_flashdata("success","You have added course successfully.");
                        //echo "Data inserted";
                        redirect("StudentCon/student");

                    }else{
                        echo "Failed to insert Faculty data";
                    }
         
     }
     
 }
 
    
   
    
    
}
