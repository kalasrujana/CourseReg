<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 
 *
 * @author kalas
 */
class Student1 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Student/studentModel1');
    }
    public function getStates()
    {
        $this->load->model('Student/sudentModel1');
        $states     = array();
        $country_id = $this->input->post('semester');
        echo $country_id;
        if ($country_id) {
            //$con['conditions'] = array('semester'=>$country_id);
            $states = $this->sudentModel1->getStateRows($country_id);
        }
        echo json_encode($states);
    }
    public function stu_Profile_Display()
    {
        if (isset($_POST['updateProfile'])) {
            //validations
            $this->form_validation->set_rules('fName', 'FirstName', 'required');
            $this->form_validation->set_rules('mail', 'Email Field', 'required|valid_email');
            //form validation
            if ($this->form_validation->run() == true) {
                //Take the input from user and assign to the columns
                $firstname = $_POST['fName'];
                $email     = $_POST['mail'];
                $lastname  = $_POST['lName'];
                $phone     = $_POST['phone'];
                $address   = $_POST['address'];
                $userName  = $_SESSION['username'];
                $this->load->model('Student/studentModel'); //model names in small
                //update user details to data base through model
                if ($this->studentModel->userUpdateModel($firstname, $email, $lastname, $phone, $address, $userName)) {
                    $this->session->set_flashdata("success", "Data Updated");
                } else {
                    echo "Failed to Update data";
                }
            }
        }
        $this->load->view('Student/studentProfile');
    }
    public function index()
    {
        $this->load->view('Student/studentTermSelection1');
    }
    public function fetch_sem()
    {
        if ($this->input->post('semester')) {
            $semValue = $this->input->post('semester');
            $this->load->model('Student/studentModel');
            $this->studentModel->fetch_semister($semValue);
        }
    }
}