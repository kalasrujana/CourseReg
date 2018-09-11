<?php

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
class CoursesSearchCon extends My_Controller {
    
    //put your code here
    //to display students list
        function index(){
        $this->my_page_builder('Admin/coursesList');
    }
    
    function fetch(){
        $this->load->model('coursesSearchModel');
        echo $this->coursesSearchModel->fetch_data();
    }
    //
    
    //delete 
    public function deleteStudent(){
        $user_id= $this->input->post('user_id');
        $this->load->model('coursesSearchModel');
      //$resu= $this->coursesSearchModel->delete_single_user($_POST["user_id"]);
      $resu= $this->coursesSearchModel->delete_single_user($user_id);
    //  echo json_encode($data);
      
     if($resu!=1){
         echo "<script type='text/javascript'>alert('course not deleted');</script>";
    //  echo 'Course not Deleted';   
      
     }else
     {
       echo 'Course Deleted';
     }
      
 
    }
    
    //update-to fetch and display values to popup box
    public function fetch_single_user(){
        
        $this->load->model('coursesSearchModel');
        $data=$this->coursesSearchModel->fetch_single_user();
        echo json_encode($data); //the the data will be in json and now write the upadate in success of ajax req in the student list
    }
     //update values into db from popup 
    public function user_action(){  
         if($_POST['user_id'])  
           { 
             //course_Name is the column name and cou_name is field name
             $updated_data = array(  
                     'course_Name' =>     $this->input->post('cou_name'),  
                     'course_ID'  =>     $this->input->post('cou_ID'),
                    'faculty_ID'  => $this->input->post('fac_ID'),
                     'semester'  => $this->input->post('sem'),
                     'credit_Hours'  => $this->input->post('crehrs'),
                     'department'  => $this->input->post('dept')
                );  
                $this->load->model('coursesSearchModel');  
                $this->coursesSearchModel->update_crud($this->input->post("user_id"), $updated_data);  
                echo 'Course Data Updated'; 
           
           }
      
    }
}
