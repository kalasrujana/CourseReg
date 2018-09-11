<?php

class My_Model extends CI_Model
{
    public $my_table;
    public $my_column_order = array();
    public $my_column_search = array();
    public $my_order = array();

    public function __construct()
    {
        parent::__construct();
    }

    // Serverside Processing
    private function _get_datatables_query()
    {

        $this->db->from($this->my_table);

        $i = 0;

        foreach ($this->my_column_search as $item)
        {
            if($_POST['search']['value'])
            {

                if($i===0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->my_column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if(isset($_POST['order']))
        {
            $this->db->order_by($this->my_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->my_order))
        {
            $order = $this->my_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }//end _get_datatables_query
    function my_result_builder()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    
    //to get the query with role=3
    //select * from user where role=3
    function m_result_builder(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->select('*');
                      
        $this->db->where(array('role'=>3));
        $query= $this->db->get();
        return $query->result();
    }

    //to get the total no.of records at the end of data table
    private function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->select('*');
                      
        $this->db->where(array('role'=>3));
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     //to get the query with role=2
    //select * from user where role=2
    function faculty_result_builder(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->select('*');
                      
        $this->db->where(array('role'=>2));
        $query= $this->db->get();
        return $query->result();
    }

    //to get the total no.of records at the end of data table for faculty
    private function faculty_count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->select('*');
                      
        $this->db->where(array('role'=>2));
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    //to get the query with role=1
    //select * from user where role=1
    function admin_result_builder(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->select('*');
                      
        $this->db->where(array('role'=>1));
        $query= $this->db->get();
        return $query->result();
    }

    //to get the total no.of records at the end of data table for faculty
    private function admin_count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->select('*');
                      
        $this->db->where(array('role'=>1));
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function count_all()
    {
        $this->db->from($this->my_table);
        return $this->db->count_all_results();
    }//end
    

    //for student search table
    function my_json_builder($data){
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->count_filtered(),
            "data" => $data,
        );
        //output to json format
        return json_encode($output);
    }
    
    //for faculty search table
    function faculty_json_builder($data){
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->faculty_count_filtered(),
            "data" => $data,
        );
        //output to json format
        return json_encode($output);
    }
    
    //for admin search table
    function admin_json_builder($data){
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->admin_count_filtered(),
            "data" => $data,
        );
        //output to json format
        return json_encode($output);
    }
    
    
    
    //to get the query for coursesList view
    
    function courses_result_builder(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->select('*');
                      
       // $this->db->where(array('faculty_ID'=>$facultyID));
        $query= $this->db->get();
        return $query->result();
    }

    //to get the total no.of records at the end of data table 
    private function courses_count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->select('*');
                      
        //$this->db->where(array('faculty_ID'=>$facultyID));
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     function courses_json_builder($data){
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->courses_count_filtered(),
            "data" => $data,
        );
        //output to json format
        return json_encode($output);
    }
    
    
    //assignment search -last lo delete
    function assignments_result_builder($username){
        $userID= $this->getUserID($username);
        //echo $userID;
        $this->_get_datatables_query();
        $this->db->select('*');
                      
        $this->db->where(array('userid'=>$userID));
        $query= $this->db->get();
        return $query->result();
    }
    
    public function getUserID($username){
       $query= $this->db->where(['username'=>$username])
                        ->get('user');
        if($query->num_rows()>0){
          return $query->row('userid');
           
        }else{
            echo "no dataa";
        }
    }
    
     private function assignment_count_filtered($username)
    {
         $userID= $this->getUserID($username);
        $this->_get_datatables_query();
        $this->db->select('*');
                      
        $this->db->where(array('userid'=>$userID));
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     function assignment_json_builder($data){
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->assignment_count_filtered($username),
            "data" => $data,
        );
        //output to json format
        return json_encode($output);
    }
    
    //assignment search end
    
    
    //for grades update
    function grades1_result_builder($facultyID,$cn){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->select('*');
                      
        $this->db->where(array('facultyID'=>$facultyID));
        $this->db->where(array('courseid'=>$cn));
        $query= $this->db->get();
        return $query->result();
    }

    //to get the total no.of records at the end of data table 
    private function grades1_count_filtered($facid,$cn)
    {
        $this->_get_datatables_query();
        $this->db->select('*');
                      
       $this->db->where(array('facultyID'=>$facid));
        $this->db->where(array('courseid'=>$cn));
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     function grades1_json_builder($data,$facid,$cn){
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->grades1_count_filtered($facid,$cn),
            "data" => $data,
        );
        //output to json format
        return json_encode($output);
    }
    
    
    
     //for drop courses that are not graded display in drop courses
    function dropCourses_result_builder($userID){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->select('*');
                      
        $this->db->where(array('userid'=>$userID));
        $this->db->where(array('Grade'=>NULL));
        $query= $this->db->get();
        return $query->result();
    }

    //to get the total no.of records at the end of data table 
    private function dropCourses_count_filtered($userID)
    {
        $this->_get_datatables_query();
        $this->db->select('*');
                      
        $this->db->where(array('userid'=>$userID));
        $this->db->where(array('Grade'=>NULL));
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     function dropCourses_json_builder($data,$userID){
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->dropCourses_count_filtered($userID),
            "data" => $data,
        );
        //output to json format
        return json_encode($output);
    }
    
    
     //for grades display in gradeModel
    function gradeBook_result_builder($userID,$yr){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->select('*');
                      
        $this->db->where(array('userid'=>$userID));
        $this->db->where(array('year'=>$yr));
        $query= $this->db->get();
        return $query->result();
    }

    //to get the total no.of records at the end of data table 
    private function gradeBook_count_filtered($userID,$yr)
    {
        $this->_get_datatables_query();
        $this->db->select('*');
          $this->db->where(array('userid'=>$userID));
        $this->db->where(array('year'=>$yr));
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     function gradeBook_json_builder($data,$userID,$yr){
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->gradeBook_count_filtered($userID,$yr),
            "data" => $data,
        );
        //output to json format
        return json_encode($output);
    }
    
    
    function courses1_result_builder($facultyID){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->select('*');
                      
       $this->db->where(array('faculty_ID'=>$facultyID));
        $query= $this->db->get();
        return $query->result();
    }

    //to get the total no.of records at the end of data table 
    private function courses1_count_filtered($facid)
    {
        $this->_get_datatables_query();
        $this->db->select('*');
                      
        $this->db->where(array('faculty_ID'=>$facid));
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     function courses1_json_builder($data,$facid){
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->courses1_count_filtered($facid),
            "data" => $data,
        );
        //output to json format
        return json_encode($output);
    }
    
    
     function courses2_result_builder($yr){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->select('*');
                      
       $this->db->where(array('year'=>$yr));
        $query= $this->db->get();
        return $query->result();
    }

    //to get the total no.of records at the end of data table 
    private function courses2_count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->select('*');
                      
        //$this->db->where(array('faculty_ID'=>$facultyID));
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     function courses2_json_builder($data){
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->courses2_count_filtered(),
            "data" => $data,
        );
        //output to json format
        return json_encode($output);
    }
    
    
    //end serverside Processing
}