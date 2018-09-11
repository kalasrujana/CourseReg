<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of transcriptModel
 *
 * @author kalas
 */
class transcriptModel extends CI_Model {
    //put your code here
    public function getEnrollCourses($uid){
  $this->db->select("registration.year,registration.sem,courseid,course_Name,Grade");
  $this->db->from('registration');
  $this->db->join('courses','registration.courseid=courses.course_ID');
  $this->db->where(array('userid'=>$uid));
  $this->db->order_by('year','asc');
  // $sql="select courseid,year,sem,Grade from registration where userid=?";
      //  $query1=$this->db->query($sql,$uid);
  $query = $this->db->get();
  return $query->result();
 }
 
 public function getUserID($username){
       $query= $this->db->where(['username'=>$username])
                        ->get('user');
        if($query->num_rows()>0){
          return $query->row('userid');
           
        }else{
            echo "no dataa";
        }
    }
    
}
