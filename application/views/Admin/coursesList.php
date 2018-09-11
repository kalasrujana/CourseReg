<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Courses List</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
      <style type="text/css">
         span { width:50%; display:inline-block; }
         span.align-right { text-align:right;padding-left: 1050px }
         span a { font-size:16px; }
      </style>
   </head>
   <?php if(isset($_SESSION['username']))
        {
       ?>
   <body background="<?php echo base_url('images/bg.jpg'); ?>">
      
      <div class="sidenav" id="mydiv">
      <nav>
      <a  href="<?php echo base_url('Admins/profile'); ?>">Home Page</a><br/>
      <a href="<?php echo base_url(); ?>index.php/adminCon/addCourse">Add Course</a><br>
      <a href="<?php echo base_url(); ?>index.php/welcome/userRegister">Add Users<br/>(Student/Faculty/Admin)</a><br>
      <a href="<?php echo base_url(); ?>index.php/StudentSearchCon">Students List<br/>(Search/Update/Delete)</a><br>
      <a href="<?php echo base_url(); ?>index.php/FacultySearchCon">Faculty List<br/>(Search/Update/Delete)</a><br>
      <a href="<?php echo base_url(); ?>index.php/AdminsSearchCon">Administrators List<br/>(Search/Update/Delete)</a><br>
      <a href="<?php echo base_url(); ?>index.php/CoursesSearchCon">Courses List<br/>(Search/Update/Delete)</a><br>  
       <a href="<?php echo base_url(); ?>index.php/adminCon/logout">Logout</a>
      </nav>
      </div>
      </div>
      
      <div class="content">
      <span style="margin-left:1150px;color: yellow;margin-top: 20px">  Welcome, <?php echo $_SESSION['username']; ?></span> 
      
      <div class="container">
          <h1 style="color:white">Edit Courses List</h1>
      <table id="example" class="display" cellspacing="0" width="100%">
      <thead>
      <tr>
      <th>Course ID</th>
      <th>Course Name</th>
      <th>Year</th>
      <th>Semester</th>
      <th>Credit Hours</th>
      <th>Department</th>
      <th>Faculty ID</th>
      <th>Faculty Name</th>
      <th>Action</th>
      </tr>
      </thead>
      <tbody id="showdata">
      </tbody>
      <tfoot>
      
      </tfoot>
      </table>
          <p>  Note: Courses can be deleted only after removal of the corresponding registered students.</p>
      </div>
      
      
      <!-- must for delete functionality,i have already written below in usermodal so i commented this
         <div><input type="hidden" name="user_id" id="user_id"/></div>
           
         <!--update dialog box-->
      <div id="userModal" class="modal fade">
      <div class="modal-dialog">
      <form method="POST" id="user_form">
      <input type="hidden" name="txtId" value="0"/>
      <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Update Faculty Details</h4>
      </div>
      <div class="modal-body">
      
     
      <label>Course Name</label>
      <input type="text" name="cou_name" id="cou_name" class="form-control" pattern="^[a-zA-Z0-9\. ]*$" title="Enter Course Name without special characters"/><br>
      <label>Credit Hours</label>
      <input type="number" min="3" max="3" name="crehrs" id="crehrs" class="form-control"/><br>
       
      <label>Department</label>
      <input type="text" name="dept" id="dept" class="form-control" maxlength="3" minlength="2" title="Type CS or CIS"/><br>
       <input type="hidden" name="fac_ID" id="fac_ID" class="form-control"/>
     
      <input type="hidden" name="cou_ID" id="cou_ID" class="form-control"/>
       <input type="hidden" name="sem" id="sem" class="form-control"/>
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
         <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
      <script>
         //search and data load functionality into datatable
         $(document).ready(function(){
             $('#example').DataTable({
                 "lengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                 "pageLength":5,
                 "processing": true,
                 
                 "serverSide": true,
                 
                 "ajax":{
                     "url":"<?php echo site_url()?>/CoursesSearchCon/fetch",
                     "type": "POST",
                     
                 },
                 "columnDefs":[{
                     "targets":[-1],
                     "orderable":false,
                 }]
             });
             
           //update diaplay
           
           // when click on update button in datatable to display the values in the popup form
           $(document).on('click','.update',function(){
           var courseidd=$(this).attr("id");
           //alert(user_id);
           //in data userd is the name of input in the studentsearchmodel/fetch_single_user
           //userd is used as input ie., this will have the useridd which is used while quering 
           //coursed is just a variable name which will be used to store the data and this is passed to model 
            $.ajax({
                      url:"<?php echo site_url()?>/CoursesSearchCon/fetch_single_user",
                      method:"GET",
                      data:{coursed:courseidd},
                      datatype:"json",
                      success:function(data){
                          //to popup the update page
                          //var result=json.parse(data);
                        // alert(data);
                         //alert(result.userid);
                         var json = JSON.parse(data);
                         //alert(json.username);
                         $('#userModal').modal('show');
                          $('#userModal').find('.modal-title').text("Edit Course Data");
                          $('#user_id').val(json.course_ID);
                          $('input[name=txtId]').val(json.course_ID);
                          $('#cou_name').val(json.course_Name);
                          $('#cou_ID').val(json.course_ID);
                           $('#fac_ID').val(json.faculty_ID);
                          $('#crehrs').val(json.credit_Hours);
                          $('#sem').val(json.semester);
                          $('#dept').val(json.department);
                          $('#action').val('Update');
                      }
                  });
           
           });
          
         //  update
         $(document).on('submit', '#user_form', function(event){  
                event.preventDefault();  
              var couName = $('#cou_name').val();  
                var couID = $('#cou_ID').val();  
                var fac_ID=$('#fac_ID').val();
                     
                if(couName != '' && couID !='' && fac_ID!='')  
                {  
                     $.ajax({  
                          url:"<?php echo site_url()?>/CoursesSearchCon/user_action",  
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
                }  
                else  
                {  
                     alert("Course Name is required");  
                }  
           });  
           
           
           //delete course from the datatable
           $(document).on('click','.delete',function(){
             var user_id=$(this).attr("id"); //getting the id from the id in del button ofsubdata[] in studentSearcchModel
             if(confirm("Are you sure you want to delete this Course?"))
             {
                // alert(user_id);
                 table=$('#example').DataTable();
                 //if click on ok in the confirm box
                 $.ajax({
                      url:"<?php echo site_url()?>/CoursesSearchCon/deleteStudent",
                      method:"POST",
                      data:{user_id:user_id},
                      success:function(data){
                          alert(data);
                          $('#example').DataTable().ajax.reload();
                      },
                     
                 });
             }else{
                 //no action when clicked on cancel in the confirm box
                 return false;
             }
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