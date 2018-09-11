<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of studentModel2
 *
 * @author kalas
 */
class studentModel2 extends CI_Model{
    //put your code here
    
    public function getAllCourses($sem){
       $sql="SELECT course_ID FROM courses where semester=?";
        $query=$this->db->query($sql, $sem);  
    
    return $query->result_array();
    
    }
}
