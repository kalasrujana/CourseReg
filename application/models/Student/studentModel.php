<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of studentModel
 *
 * @author kalas
 */
class studentModel extends CI_Model {
    //put your code here
     public function userUpdateModel($firstname,$email,$lastname,$phone,$address,$username){
        $this->load->database();
         $data=array(
            'firstname'=>$firstname,
             'email'=>$email,
             'lastname'=>$lastname,
             'phone'=>$phone,
             'address'=>$address
        );
        return $this->db->where('username',$username)
        ->update('user',$data);
    }
    
    public function getAllCourses(){
       // $username=faculty;
        //to avoid sql injection use ?
        $sql="SELECT course_ID,course_Name FROM courseslist WHERE facultyName=?";
        $query=$this->db->query($sql);
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            echo "no data";
        }
    }
 
 function fetch_semi($yr,$semValue,$uid)
 {
 // $this->db->where('semester', $country_id);

  //$query = $this->db->get('courses');
  //$output=$query->result_array();
 // return $output;
  
   //  $sql="SELECT course_ID from courses WHERE course_ID NOT IN(SELECT courseid from registration WHERE userid=?) AND semester=?";
      $sql="SELECT course_Name,course_ID from courses WHERE course_ID NOT IN(SELECT courseid from registration WHERE userid=?) AND semester=? And year=?";
   
    
     $query=$this->db->query($sql,array($uid,$semValue,$yr));
  if($query->num_rows()>0){
            return $query->result_array();
        } 
       
  
 
  
 }
 
 public function retrieveFaculty($courseID){
     $sql="select faculty_ID from courses where course_ID=?";
     $query= $this->db->query($sql,$courseID);
     return $query->row();
 }

  public function insertCourseData($data){
        $this->load->database();
        $count= $this->db->insert('registration', $data);
        if($count>0){
            return true;
        } else {
            return false;
        }
    }
 
}
