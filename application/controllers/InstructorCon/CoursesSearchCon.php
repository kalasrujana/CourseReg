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
        $this->my_page_builder('Instructor/coursesList');
    }
    
    function fetch(){
        $facID= $this->input->post('facID');
        
        $this->load->model('Instructor/coursesSearchModel');
        echo $this->coursesSearchModel->fetch_data($facID);
    }
    //
   
}
