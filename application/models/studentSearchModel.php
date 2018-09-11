<?php

/**
SELECT `id`, `name`, `salary`, `age` FROM `tbperson` WHERE 1
 */
class studentSearchModel extends My_Model
{
    //display of student list in data table
    function __construct(){
        parent::__construct();
        $this->my_table='user';
        $this->my_column_order=array('userid', 'firstname', 'lastname', 'username', 'passwordhash', 'gender', 'email', 'role', 'phone', 'address');
        $this->my_column_search=array('firstname','lastname','username','gender','email','phone');
        $this->my_order=array('firstname'=>'asc');
    }//end

    function fetch_data(){
        $data=array();
        $list=$this->m_result_builder();
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
            
            $subdata[]='<a href="#" class="btn btn-primary btn-xs update" name="update" id="'.$row->userid.'">Edit</a>
                        <a href="#" class="btn btn-danger btn-xs delete" name="delete" id="'.$row->userid.'">Delete</a>';
            $data[]=$subdata;
        }
        return $this->my_json_builder($data);
    }//end
    //
    
    //delete student from data table
    public function delete_single_user($user_id){
        $this->db->where("userid",$user_id);
        $this->db->delete("user");
        //delete from user where userid='$user_id'
        
    }
    
    //get the values in the popup window
    public function fetch_single_user(){
        //user_id is the name of the hidden field in html
        $user_id= $this->input->get('userd');
       $this->db->where("userid",$user_id); 
       $query=$this->db->get('user');
       if($query->num_rows()>0){
       return $query->row();
       }else{
           return $user_id;
       }
    }

    //update student
    function update_crud($user_id, $data)  
      {  
           $this->db->where("userid", $user_id);  
           $this->db->update("user", $data);  
      }    
      
      
      
    
}