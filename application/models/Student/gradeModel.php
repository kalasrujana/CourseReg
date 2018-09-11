<?php


class gradeModel extends My_Model
{
    //create view courseslis as
//SELECT user.firstname as facultyName,courses.course_ID,courses.faculty_ID from user,courses WHERE user.userid=courses.faculty_ID
    function __construct(){
        parent::__construct();
        $this->my_table='registration';
        $this->my_column_order=array('csg_id','courseid','userid','sem','Grade','facultyID','year');
        $this->my_column_search=array('courseid','Grade','sem');
        $this->my_order=array('csg_id'=>'asc');
    }//end

    //retreive data to display the grades in the gradebook for student
    function fetch_data($userID,$yr){
        $data=array();
        $list=$this->gradeBook_result_builder($userID,$yr);
        foreach($list as $row){
            $subdata=array();
            
            $subdata[]=$row->courseid;
            $subdata[]=$row->year;
            $subdata[]=$row->sem;
            $subdata[]=$row->Grade;
            $data[]=$subdata;
        }
        return $this->gradeBook_json_builder($data,$userID,$yr);
    }//end
  
    //retrive the data to display the courses to drop that are not graded
     function fetch_data_drop($userID){
        $data=array();
        $list=$this->dropCourses_result_builder($userID);
        foreach($list as $row){
            $subdata=array();
            
            $subdata[]=$row->courseid;
            $subdata[]=$row->year;
            $subdata[]=$row->sem;
           // $subdata[]=$row->Grade;
            $subdata[]='<a href="#" class="btn btn-danger btn-xs delete" name="delete" id="'.$row->courseid.'">Drop Course</a>';
            $data[]=$subdata;
        }
        return $this->dropCourses_json_builder($data,$userID);
    }//end
   
     //drop course from data table
    public function delete_single_user($course_id){
        $this->db->where("courseid",$course_id);
        $this->db->delete("registration");
        //delete from user where userid='$user_id'
        
    }
      
}