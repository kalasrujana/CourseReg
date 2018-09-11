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
class coursesListCon extends My_Controller {
    
    //put your code here
    //to display students list
        function index(){
        $this->my_page_builder('Student/coursesListView');
    }
    
    function fetch(){
       
        $this->load->model('coursesSearchModel');
        echo $this->coursesSearchModel->fetch1_data();
    }
    //
    
    //delete 
    
}
