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
class EnrollCon extends My_Controller {
    
    //put your code here
    //to display students list
        function index(){
        $this->my_page_builder('Student/enrollCourses');
    }
    
    function fetch(){
        $this->load->model('Student/enrollModel');
        echo $this->enrollModel->fetch_data();
    }
    //
   
}
