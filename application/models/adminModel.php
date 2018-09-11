<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminModel
 *
 * @author kalas
 */
class adminModel extends CI_Model {
    //put your code here
    //
    
    //
    //used to get the faculty into dropdown in addcourse.php and adminCon->addCourse
    public function getAllfaculty(){
    $query = $this->db->query('SELECT userid,username FROM user where role=2');
    return $query->result_array();
    }
    
    
    
    //to insert the course data by admin into courses db in admincon->addcourse()
    public function insertCourseData($data){
        $this->load->database();
        $count= $this->db->insert('courses', $data);
        if($count>0){
            return true;
        } else {
            return false;
        }
    }
    //to get the current password of user in admincon->changePassword()
    public function getCurrentPwd($userName){
        $query= $this->db->where(['username'=>$userName])
                        ->get('user');
        if($query->num_rows()>0){
            return $query->row();
        }
    }
    
    //update the old pwd with new pwd in admincon->changePassword()
    public function updatePwd($newPwd,$userName){
        $data=array(
            'passwordhash'=>$newPwd
        );
        return $this->db->where('username',$userName)
        ->update('user',$data);
    }
   
    
    
}
