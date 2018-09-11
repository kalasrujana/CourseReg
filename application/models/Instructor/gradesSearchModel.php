<?php


class gradesSearchModel extends My_Model
{
    //create view courseslis as
//SELECT user.firstname as facultyName,courses.course_ID,courses.faculty_ID from user,courses WHERE user.userid=courses.faculty_ID
    function __construct(){
        parent::__construct();
        $this->my_table='studentEnrollList';
        $this->my_column_order=array('csg_id','courseid','userid','sem','Grade','facultyID','year','username');
        $this->my_column_search=array('courseid','userid','Grade','username');
        $this->my_order=array('csg_id'=>'asc');
    }//end

    function fetch_data($facID,$cn){
        $data=array();
        $list=$this->grades1_result_builder($facID,$cn);
        foreach($list as $row){
            $subdata=array();
            //$subdata[]=$row->userid;
            $subdata[]=$row->csg_id;
            $subdata[]=$row->courseid;
            $subdata[]=$row->year;
            $subdata[]=$row->sem;
            $subdata[]=$row->userid;
            $subdata[]=$row->username;
            $subdata[]=$row->Grade;
            
            $subdata[]='<a href="#" class="btn btn-primary btn-xs update" name="update" id="'.$row->csg_id.'">Update Student Grade</a>';
                       
           
            $data[]=$subdata;
        }
        return $this->grades1_json_builder($data,$facID,$cn);
    }//end
  
    
    //get the values in the popup window
    public function fetch_single_user(){
        //user_id is the name of the hidden field in html
        $user_id= $this->input->get('coursed');
      //  echo $user_id;
       $this->db->where("csg_id",$user_id); 
       $query=$this->db->get('studentEnrollList');
       if($query->num_rows()>0){
       return $query->row();
       }else{
           return $user_id;
       }
    }
    //update
    function update_crud($user_id, $data)  
      {  
       // echo "hello";
           $this->db->where("csg_id", $user_id);  
           $this->db->update("registration", $data);  
      }    
   
      public function fetch_data_cou($facID,$yr){
           $sql="SELECT course_Name,course_ID,year from courses WHERE faculty_ID=? And year=?";
   
    
     $query=$this->db->query($sql,array($facID,$yr));
  if($query->num_rows()>0){
            return $query->result_array();
        } 
       
      }
}