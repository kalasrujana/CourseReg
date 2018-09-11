<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StudentSearchCon
 *
 * @author kalas
 */
class GradeCon extends My_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
    }
    //put your code here
    //to display students list
        function index(){
        $this->my_page_builder('Student/gradeBook');
    }
    
    function fetch(){
        $facID= $this->input->post('facID');
        $yr= $this->input->post('yr');
        $this->load->model('Student/gradeModel');
        echo $this->gradeModel->fetch_data($facID,$yr);
    }
    
    
    //drop courses
     function dropCoursesView(){
        $this->my_page_builder('Student/dropCourses');
    }
    
    //display courses that are not graded for the loggedin user
    function fetch_drop(){
        $facID= $this->input->post('facID');
        $this->load->model('Student/gradeModel');
        echo $this->gradeModel->fetch_data_drop($facID);
    }
    
    //delete course from datatable
    public function deleteStudent(){
        //course_id is the variable from ajax data
         $this->load->model('Student/gradeModel');
        $this->gradeModel->delete_single_user($_POST["course_id"]);
        echo 'Course Dropped';
    }
   
}
