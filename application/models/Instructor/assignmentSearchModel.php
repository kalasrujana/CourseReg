<?php


class assignmentSearchModel extends My_Model
{
    //create view courseslis as
//SELECT user.firstname as facultyName,courses.course_ID,courses.faculty_ID from user,courses WHERE user.userid=courses.faculty_ID
    function __construct(){
        parent::__construct();
        $this->my_table='assignments';
        $this->my_column_order=array('assignmentname','numpoints','courseid');
        $this->my_column_search=array('assignmentname','courseid');
        $this->my_order=array('assignmentname'=>'asc');
    }//end

    function fetch_data($username){
        $data=array();
        $list=$this->assignments_result_builder($username);
        foreach($list as $row){
            $subdata=array();
            //$subdata[]=$row->userid;
            $subdata[]=$row->assignmentname;
            $subdata[]=$row->numpoints;
            $subdata[]=$row->courseid;
            
            //$subdata[]=$row->role;
            //$subdata[]=$row->phone;
            //$subdata[]=$row->address;
            //$subdata[]=$row->status;
            
            
            $data[]=$subdata;
        }
        return $this->assignment_json_builder($data);
    }//end
    //
    
    //delete student from data table
    public function delete_single_user($user_id){
        $this->db->where("course_ID",$user_id);
        $this->db->delete("courses");
        //delete from user where userid='$user_id'
        
    }
    
    //get the values in the popup window
    public function fetch_single_user(){
        //user_id is the name of the hidden field in html
        $user_id= $this->input->get('coursed');
       $this->db->where("course_ID",$user_id); 
       $query=$this->db->get('courseslist');
       if($query->num_rows()>0){
       return $query->row();
       }else{
           return $user_id;
       }
    }

    //update student
    function update_crud($user_id, $data)  
      {  
       // echo "hello";
           $this->db->where("course_ID", $user_id);  
           $this->db->update("courseslist", $data);  
      }    
      
      
      
    
}