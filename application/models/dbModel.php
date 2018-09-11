<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbModel
 *
 * @author kalas
 */
class dbModel extends CI_Model{
    //put your code here
    //insert user data i.e for registration.php page and welcome->sturegister
     public function userRegModel($data){
        $this->load->database();
        $count= $this->db->insert('user', $data);
        if($count>0){
            return true;
        } else {
            return false;
        }
    }
    
    public function userExists($uName){
        $sql="select username from user where username=?";
        $query=$this->db->query($sql,$uName);
        if($query->num_rows()>0){
            return TRUE;
        }
    }
    
    public function courseExists($cid){
        $sql="select course_ID from courses where course_ID=?";
        $query=$this->db->query($sql,$cid);
        if($query->num_rows()>0){
            return TRUE;
        }
    }
    
    public function email_exists($email){
        $sql="select username,firstname,email from user where email='{$email}' Limit 1"; 
        $result=$this->db->query($sql);
        $row=$result->row();
        return ($result->num_rows()==1 && $row->email)?$row->username:false;
    }
    

}
