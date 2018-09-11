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
class GradesSearchCon extends My_Controller {
    
    //put your code here
    //to display students list
        function index(){
            
        $this->my_page_builder('Instructor/gradesList');
        
    }
   
            
    function fetch(){
        $facID= $this->input->post('facID');
        $cn= $this->input->post('cn');
        $this->load->model('Instructor/gradesSearchModel');
        echo $this->gradesSearchModel->fetch_data($facID,$cn);
    }
    
    public function fetch_cou(){
        $yr= $this->input->post('yr');
        $facID= $this->input->post('uID');
        $this->load->model('Instructor/gradesSearchModel');
        $courses= $this->gradesSearchModel->fetch_data_cou($facID,$yr);
   
  echo json_encode($courses);
        
    }

    //to get the row for popup
    public function fetch_single_user(){
        
       $this->load->model('Instructor/gradesSearchModel');
        $data=$this->gradesSearchModel->fetch_single_user();
        echo json_encode($data); //the the data will be in json and now write the upadate in success of ajax req in the student list
    }
    
     //update values into db from popup 
    public function user_action(){  
         if($_POST['user_id'])  
           { 
             //course_Name is the column name and cou_name is field name
             $updated_data = array(  
                     'Grade' =>     $this->input->post('grade') 
                     
                );  
                $this->load->model('Instructor/gradesSearchModel');  
                $this->gradesSearchModel->update_crud($this->input->post("user_id"), $updated_data);  
                echo 'Grade Updated'; 
           
           }
      
    }
}
