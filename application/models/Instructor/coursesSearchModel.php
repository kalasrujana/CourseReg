<?php


class coursesSearchModel extends My_Model
{
    //create view courseslis as
//SELECT user.firstname as facultyName,courses.course_ID,courses.faculty_ID from user,courses WHERE user.userid=courses.faculty_ID
    function __construct(){
        parent::__construct();
        $this->my_table='courselist';
        $this->my_column_order=array('course_ID','course_Name','year','semester','credit_Hours','department','faculty_ID','facultyName',);
        $this->my_column_search=array('course_ID','course_Name','year','semester','credit_Hours','department','faculty_ID','facultyName');
        $this->my_order=array('course_ID'=>'asc');
    }//end

    public function fetch_data($facultyID){
        $data=array();
        $list=$this->courses1_result_builder($facultyID);
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
           
            $data[]=$subdata;
        }
        return $this->courses1_json_builder($data,$facultyID);
    }//end
    
  
}