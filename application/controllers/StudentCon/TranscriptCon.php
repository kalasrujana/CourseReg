<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TranscriptCon
 *
 * @author kalas
 */
class TranscriptCon extends CI_Controller {
    //put your code here
    public function fetch(){
        $uname=$_SESSION['username'];
      
         $this->load->model('Student/transcriptModel');
         
         $uid= $this->transcriptModel->getUserID($uname);
        $query= $this->transcriptModel->getEnrollCourses($uid);
          $data['Courses'] = null;
          if($query){
           $data['Courses'] =  $query;
          }
        $this->load->view('Student/transcriptView',$data);
    }
}
