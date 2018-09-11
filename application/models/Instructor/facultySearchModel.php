<?php


class facultySearchModel extends My_Model
{
    //display of student list in data table
    function __construct(){
        parent::__construct();
        $this->my_table='user';
        $this->my_column_order=array('userid', 'firstname', 'lastname', 'username', 'passwordhash', 'gender', 'email', 'role', 'phone', 'address', 'status');
        $this->my_column_search=array('firstname','lastname','username','gender','email','phone');
        $this->my_order=array('firstname'=>'asc');
    }//end

    function fetch_data(){
        $data=array();
        $list=$this->faculty_result_builder();
        foreach($list as $row){
            $subdata=array();
            //$subdata[]=$row->userid;
            $subdata[]=$row->firstname;
            $subdata[]=$row->lastname;
            $subdata[]=$row->username;
            //$subdata[]=$row->usertype;
            //$subdata[]=$row->passwordhash;
            $subdata[]=$row->gender;
            $subdata[]=$row->email;
            //$subdata[]=$row->role;
            $subdata[]=$row->phone;
            $subdata[]=$row->address;
            //$subdata[]=$row->status;
            //$subdata[]='<a href="#" class="btn btn-primary btn-xs update" name="update" id="'.$row->userid.'">Edit</a>';
           
            $data[]=$subdata;
        }
        return $this->faculty_json_builder($data);
    }//end
   
   
}