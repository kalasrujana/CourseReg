<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of instructorModel
 *
 * @author kalas
 */
class instructorModel extends CI_Model {
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
    
    //get all courses for dropdown in add assignment.php and instructor in instructorcon
    public function getAllCourses($username){
       // $username=faculty;
        //to avoid sql injection use ?
        $sql="SELECT course_ID,course_Name FROM courseslist WHERE facultyName=?";
        $query=$this->db->query($sql, $username);
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            echo "no data";
        }
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
    
    public function addAssignment($assignmentname,$courseid,$numpoints,$userName){
        $userID= $this->getUserID($userName);
        echo $userID;
        $sql="insert into assignments(assignmentname,courseid,numpoints,userid) values('$assignmentname','$courseid',$numpoints,$userID)";
        $query= $this->db->query($sql);
        $afftectedRows = $this->db->affected_rows();
        
        if ($afftectedRows == 1) {
        //if(($query->num_rows())){
            return true;
        } else {
            return false;
        }
    }
    
}
