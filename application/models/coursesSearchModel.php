<?php


class coursesSearchModel extends My_Model
{
    //create view courseslis as
//SELECT user.firstname as facultyName,courses.course_ID,courses.faculty_ID from user,courses WHERE user.userid=courses.faculty_ID
    function __construct(){
        parent::__construct();
        $this->my_table='courselist';
        $this->my_column_order=array('course_ID','course_Name','year','semester','credit_Hours','department','faculty_ID','facultyName');
        $this->my_column_search=array('course_ID','course_Name','year','semester','credit_Hours','department','faculty_ID','facultyName');
        $this->my_order=array('course_ID'=>'asc');
    }//end

    function fetch_data(){
        $data=array();
        $list=$this->courses_result_builder();
        foreach($list as $row){
            $subdata=array();
            //$subdata[]=$row->userid;
            $subdata[]=$row->course_ID;
            $subdata[]=$row->course_Name;
            $subdata[]=$row->year;
            $subdata[]=$row->semester;
            $subdata[]=$row->credit_Hours;
            $subdata[]=$row->department;
            $subdata[]=$row->faculty_ID;
            $subdata[]=$row->facultyName;
            //$subdata[]=$row->role;
            //$subdata[]=$row->phone;
            //$subdata[]=$row->address;
            //$subdata[]=$row->status;
            
            $subdata[]='<a href="#" class="btn btn-primary btn-xs update" name="update" id="'.$row->course_ID.'">Edit</a>
                        <a href="#" class="btn btn-danger btn-xs delete" name="delete" id="'.$row->course_ID.'">Delete</a>';
            $data[]=$subdata;
        }
        
        return $this->courses_json_builder($data);
    }//end
    //
    
    //delete student from data table
    public function delete_single_user($user_id){
        $this->db->where("course_ID",$user_id);
        
        $this->db->delete("courses");
        
        return $this->db->affected_rows();
        
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
      
    function fetch1_data(){
        $data=array();
        $list=$this->courses_result_builder();
        foreach($list as $row){
            $subdata=array();
            //$subdata[]=$row->userid;
            $subdata[]=$row->course_ID;
            $subdata[]=$row->course_Name;
            $subdata[]=$row->year;
            $subdata[]=$row->semester;
            $subdata[]=$row->credit_Hours;
            $subdata[]=$row->department;
            $subdata[]=$row->faculty_ID;
            $subdata[]=$row->facultyName;
            //$subdata[]=$row->role;
            //$subdata[]=$row->phone;
            //$subdata[]=$row->address;
            //$subdata[]=$row->status;
            
           
            $data[]=$subdata;
        }
        
        return $this->courses_json_builder($data);
    }//end
    //   
      
    
}