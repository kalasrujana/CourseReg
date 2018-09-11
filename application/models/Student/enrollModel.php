<?php


class enrollModel extends My_Model
{
    //create view courseslis as
//SELECT user.firstname as facultyName,courses.course_ID,courses.faculty_ID from user,courses WHERE user.userid=courses.faculty_ID
    function __construct(){
        parent::__construct();
        $this->my_table='courseslist';
        $this->my_column_order=array('course_ID','course_Name','semester','credit_Hours','department','faculty_ID','facultyName',);
        $this->my_column_search=array('course_ID','course_Name','semester','credit_Hours','department','faculty_ID','facultyName');
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
            $subdata[]=$row->semester;
            $subdata[]=$row->credit_Hours;
            $subdata[]=$row->department;
            $subdata[]=$row->faculty_ID;
            $subdata[]=$row->facultyName;
           $subdata[]='<a href="#" class="btn btn-primary btn-xs update" name="update" id="'.$row->course_ID.'">Edit</a>
                        <a href="#" class="btn btn-danger btn-xs delete" name="delete" id="'.$row->course_ID.'">Delete</a>';
            $data[]=$subdata;
        }
        return $this->courses_json_builder($data);
    }//end
    
}