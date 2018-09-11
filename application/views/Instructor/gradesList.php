<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Update Grade</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css"/>
      <style type="text/css">
         span { width:50%; display:inline-block; }
         span.align-right { text-align:right;padding-left: 1050px }
         span a { font-size:16px; }
         #err{
             display: none;
         }
         #example{
             display: block;
         }
      </style>
   </head>
   <?php if(isset($_SESSION['username']))
        {
       ?>

   <body background="<?php echo base_url('images/bg.jpg'); ?>">
      
      <div class="sidenav">
         <!-- <a href="<?php echo base_url(); ?>index.php/adminCon/changePassword">Change Password</a><br>-->
           <a href="<?php echo base_url('faculty/profile'); ?>">Home Page</a><br/>
         <a href="<?php echo base_url(); ?>index.php/InstructorCon/FacultySearchCon">Faculty List(Search)</a><br>
         <a href="<?php echo base_url(); ?>index.php/InstructorCon/CoursesSearchCon">Courses List(Search)</a><br>
         <a href="<?php echo base_url(); ?>index.php/InstructorCon/Instructor/fac_Profile_Display">Update Profile Details</a><br> 
         <a href="<?php echo base_url(); ?>index.php/InstructorCon/GradesSearchCon">Upload Grades</a><br>
         <a href="<?php echo base_url(); ?>index.php/FacultyCon/logout">Logout</a>
      </div>
            

      <div class="content">
         <span style="margin-left:1150px;color: yellow;margin-top: 20px">  Welcome, <?php echo $_SESSION['username']; ?></span> 
      </div>
        <center>
      <?php
         $userName=$_SESSION['username'];
         // echo "Hello".$userName;
         $query="SELECT * from user where username=" . " '$userName' ";
          $this->db->select('*');
          $this->db->from('user');
          $this->db->where(array('username'=>$userName));
          $query= $this->db->get();
          //use this $user in the value fields to display the values
          $user=$query->row();
          $facID=$user->userid;
          
         ?>
            <div class="container" style="margin-left:300px">
         <h1 style="color:white">Update Grade to the Registered Students</h1>
         
         <label style="color:white;">Year</label>
         <select name="yr" id="yr" required title="Select Year">
      <option value="">Select Year</option>
      <option value="2017">2017</option>
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      </select>
         <label style="color:white;">Course</label>
         <select name="cou" id="cour"  required title="Select Course">
      <option value="">Select course</option>
      </select>
         <label id="err">No Records</label>
         
        
         
         <input type="hidden" value="<?php echo $facID; ?>" id="facID" name="facID"/>
         <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th>Csg ID</th>
                  <th>Course ID</th>
                  <th>Year</th>
                  <th>Sem</th>
                  <th>Student ID</th>
                  <th>Student Name</th>
                  <th>Grade</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody id="showdata">
            </tbody>
            <tfoot>
              
            </tfoot>
         </table>
      </div>
      <div id="userModal" class="modal fade">
         <div class="modal-dialog">
            <form method="POST" id="user_form">
               <input type="hidden" name="txtId" value="0"/>
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Update Grade Details</h4>
                  </div>
                  <div class="modal-body">
                      <label>Student Name</label>
                      <input type="text" name="stu_name" id="stu_Name" class="form-control" disabled="true"/><br>
                     <label>Grade</label>
                     
                      <select  class="form-control" id="grade" name="grade"><br/>
                           <option></option>
                           <option value="A">A</option>
                           <option value="B">B</option>
                           <option value="C">C</option>
                           <option value="D">D</option>
                           <option value="F">F</option>
                        </select>
                  </div>
                  <div class="modal-footer">
                     <input type="hidden" name="user_id" id="user_id"/>
                     <input type="submit" name="action" id="action" value="Add" />
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
      <script>
         //search and data load functionality into datatable
         $(document).ready(function(){
              $('#yr').change(function(){
                  
                  var yr=$('#yr').val();
                 // alert(yr);
                  var facID=$('#facID').val();
                  document.getElementById('cour').removeAttribute("disabled");
                  
                   $.ajax({
                    url:"<?php echo site_url()?>/InstructorCon/GradesSearchCon/fetch_cou",
                    method:"POST",
                    data:{yr:yr,uID:facID},
                    success:function(data){
                       //alert(data);
          $('#cour').html('<option value="">Select Course</option>'); 
                       var dataObj = jQuery.parseJSON(data);
                      // alert(dataObj);
                       if(dataObj){
                           $(dataObj).each(function(){
                               var option = $('<option />');
                               option.attr('value', this.course_ID).text(this.course_Name);           
                               $('#cour').append(option);
                               document.getElementById("err").style.display = "none";
                           });
                       }else{
                         $('#example').empty();
                      //  $('#example').DataTable().clear().draw();
                         
                                // $('#example').DataTable().remove();
                       //$('#example').DataTable().ajax.reload(); 
                           alert('No records available');
                           $('#cour').html('<option value="">courses not available</option>');
                           document.getElementById("err").style.display = "block";
           
            
                           
                       }
                    }
               });
                  
                  
             $('#cour').change(function(){     
             var facID=$('#facID').val();
             var cn=$('#cour').val();
         //  alert(facID);
           //  alert(cn);
             //alert(yr);
           
             $('#example').DataTable({
                 "processing": true,
                 "serverSide": true,
                 "lengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                 "pageLength":5,
                 "bDestroy": true,
                 "ajax":{
                     "url":"<?php echo site_url()?>/InstructorCon/GradesSearchCon/fetch",
                     data:{facID:facID,cn:cn},
                     "type": "POST"
                 },
                 "columnDefs":[{
                     "targets":[-1],
                     "orderable":false,
                 }]
             });
             
             
             });
           });   
         
         //update diaplay
           
           // when click on update button in datatable to display the values in the popup form
           $(document).on('click','.update',function(){
           var courseidd=$(this).attr("id");
           //alert(courseidd);
           //in data userd is the name of input in the studentsearchmodel/fetch_single_user
           //userd is used as input ie., this will have the useridd which is used while quering 
            $.ajax({
                      url:"<?php echo site_url()?>/InstructorCon/GradesSearchCon/fetch_single_user",
                      method:"GET",
                      data:{coursed:courseidd},
                      datatype:"json",
                      success:function(data){
                          //to popup the update page
                          //var result=json.parse(data);
                        // alert(data);
                         //alert(result.userid);
                         var json = JSON.parse(data);
                        // alert(json);
                         //alert(json.username);
                         $('#userModal').modal('show');
                          $('#userModal').find('.modal-title').text("Update Grade");
                          $('#user_id').val(json.csg_id);
                         $('#stu_Name').val(json.username);
                         $('#grade').val(json.Grade);
                          
                          $('#action').val('Update');
                      }
                  });
           
           });
           
           
         //  update
         $(document).on('submit', '#user_form', function(event){  
                event.preventDefault();  
             // var couName = $('#grade').val();  
                
                     
                  
                     $.ajax({  
                          url:"<?php echo site_url()?>/InstructorCon/GradesSearchCon/user_action",  
                          method:'POST',  
                          data:new FormData(this),  
                          contentType:false,  
                          processData:false,  
                          success:function(data)  
                          {  
                               alert(data);  
                               $('#user_form')[0].reset();  
                               $('#userModal').modal('hide');  
                               $('#example').DataTable().ajax.reload(); 
                          }  
                     });  
                  
                
           });  
           
         
         });
      </script>
   </body>
    <?php }
        else{
             redirect("Welcome/welcomeView");
        }
        ?>
</html>