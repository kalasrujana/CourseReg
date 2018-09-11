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
class sudentModel1 extends CI_Model {
    
    function __construct() {
        parent::__construct();
        //$this->couTbl = 'courses';
    }
    
    function getStateRows($sem){
        
          $this->db->select('s.course_ID, s.course_Name');
        $this->db->from($this->couTbl.' as s');
        $this->db->where('semester', $sem);
      
        
        
        
        $query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        //return fetched data
        return $result;
    }
    
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
    
   
        
   function fetch_semister($sem)
 {
  $this->db->where('semester', $sem);
  
  $query = $this->db->get('courses');
  $output = '<option value="">Select course</option>';
  foreach($query->result() as $row)
  {
    
   $output .= '<option value="'.$row['course_ID'].'">'.$row['course_ID'].'</option>';
   //echo '<option value="'.$row['course_ID'].'">'.$row['course_ID'].'</option>';
  }
  return $output;
 }
}
