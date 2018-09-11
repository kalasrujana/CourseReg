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
class FacultySearchCon extends My_Controller {
    
    //put your code here
    //to display students list
        function index(){
        $this->my_page_builder('Admin/facultyList');
    }
    
    function fetch(){
        $this->load->model('facultySearchModel');
        echo $this->facultySearchModel->fetch_data();
    }
    //
    
    //delete 
    public function deleteStudent(){
        $this->load->model('facultySearchModel');
        $this->facultySearchModel->delete_single_user($_POST["user_id"]);
        echo 'Faculty Deleted';
    }
    
    //update-to fetch and display values to popup box
    public function fetch_single_user(){
        
        $this->load->model('facultySearchModel');
        $data=$this->facultySearchModel->fetch_single_user();
        
        echo json_encode($data); //the the data will be in json and now write the upadate in success of ajax req in the student list
    }
     //update values into db from popup 
    public function user_action(){  
         if($_POST['user_id'])  
           { 
             //echo "hi";//firstname is the column name and first_name is field name
             $updated_data = array(  
                     'firstname' =>     $this->input->post('first_name'),  
                     'username'  =>     $this->input->post('user_name'),
                    'lastname'  => $this->input->post('last_name'),
                     'email'  => $this->input->post('mail'),
                     'phone'  => $this->input->post('phone'),
                     'address'  => $this->input->post('address')
                );  
                $this->load->model('facultySearchModel');  
                $this->facultySearchModel->update_crud($this->input->post("user_id"), $updated_data);  
                echo 'Faculty Data Updated'; 
           
           }
      
    }
}
