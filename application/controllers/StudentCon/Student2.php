<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student2
 *
 * @author kalas
 */
class Student2 extends CI_Controller {
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    public function semSelection (){
            
            
            $this->load->view('Student/studentTermSelection2');
            
        }
        
        public function couSel(){
         $sem = $this->input->post('sem'); 
         echo $sem;
         $this->load->model('student/studentModel2');
           
            $data['groups'] = $this->studentModel2->getAllCourses($sem);
         $this->load->view('Student/studentCourseSelection',$data);
        }
}
