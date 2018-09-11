<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Instructor
 *
 * @author kalas
 */
class Instructor extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
    }
    
    public function fac_Profile_Display(){
        if(isset($_POST['updateProfile'])){
                //validations
                $this->form_validation->set_rules('fName', 'First Name', 'trim|required|alpha');
                $this->form_validation->set_rules('lName', 'Last Name', 'trim|required|alpha');
                 $this->form_validation->set_rules('mail', 'Email Field', 'trim|required|valid_email');
                 //$this->form_validation->set_rules('phone', 'Phone Number', 'numeric|regex_match[^(?!(\d)\1{9})(?!0123456789|1234567890|0987654321|9876543210)\d{10}$]');
                //form validation
                if($this->form_validation->run()==true){
                    //Take the input from user and assign to the columns
                        $firstname=$_POST['fName'];
                        $email=$_POST['mail'];
                        $lastname=$_POST['lName'];
                        $phone=$_POST['phone'];
                        $address=$_POST['address'];
                        $userName=$_SESSION['username'];
            $this->load->model('Instructor/instructorModel'); //model names in small
             //update user details to data base through model
            if($this->instructorModel->userUpdateModel($firstname,$email,$lastname,$phone,$address,$userName))
            {
                $this->session->set_flashdata("success","Data Updated");
            }else{
                echo "Failed to Update data";
            }    
                }
            }
        $this->load->view('Instructor/facultyProfile');
    }
    
    //add new assignment
    public function add_Assignment(){
        $this->load->model('Instructor/instructorModel');
        $userName=$_SESSION['username'];
        $data['groups'] = $this->instructorModel->getAllCourses($userName);
        if(isset($_POST['addass'])){
            //validations
            $this->form_validation->set_rules('assName', 'assignment_name', 'required');
            $this->form_validation->set_rules('pts', 'points', 'required|numeric');
            if($this->form_validation->run()==true){
                    //take the input from user in an array
                    //$data=array(
                    $assignmentname=$_POST['assName'];
                    $numpoints=$_POST['pts'];
                    $courseid=$_POST['couID'];
                   // );
                    $this->load->model('Instructor/instructorModel');
                     //add user to data base through model
                    if($this->instructorModel->addAssignment($assignmentname,$courseid,$numpoints,$userName))
                    {
                        $this->session->set_flashdata("success","You have added course successfully.");
                       echo "Data inserted";
                       redirect("InstructorCon/Instructor/add_Assignment","refresh");

                    }else{
                        echo "Failed to insert Faculty data";
                    }
                }
                
            
        }
        
        
       $this->load->view('Instructor/addAssignment',$data); 
    }
}
