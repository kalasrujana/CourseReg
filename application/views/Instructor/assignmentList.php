<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Assignments List</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css"/>
   </head>
   <body>
      <?php if(isset($_SESSION['success'])){ ?>
      <div class="form_error"><?php echo $_SESSION['success']; ?></div>
      <?php
         } ?>
      <div style="width: 20%;float: left">
         Welcome,<?php echo $_SESSION['username']; ?>
      </div>
      <div class="container">
         <h1>Assignments List</h1>
         <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th>Assignment Name</th>
                  <th>Number of Points</th>
                  <th>Course ID</th>
               </tr>
            </thead>
            <tbody id="showdata">
            </tbody>
            <tfoot>
               <tr>
                  <th>Assignment Name</th>
                  <th>Number of Points</th>
                  <th>Course ID</th>
               </tr>
            </tfoot>
         </table>
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
                     <label>Faculty ID</label>
                     <input type="text" name="fac_ID" id="fac_ID" class="form-control"/><br>
                     <label>Course ID</label>
                     <input type="text" name="cou_ID" id="cou_ID" class="form-control"/><br>
                     <label>Course Name</label>
                     <input type="text" name="cou_name" id="cou_name" class="form-control"/><br>
                     <label>Semester</label>
                     <input type="text" name="sem" id="sem" class="form-control"/><br>
                     <label>Credit Hours</label>
                     <input type="text" name="crehrs" id="crehrs" class="form-control"/><br>
                     <label>Department</label>
                     <input type="text" name="dept" id="dept" class="form-control"/><br>
                  </div>
                  <div class="modal-footer">
                     <label>Know the faculty id before editing or put  the faculty id(foreign key) drop down</label>
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
             $('#example').DataTable({
                 "processing": true,
                 "serverSide": true,
                 "ajax":{
                     "url":"<?php echo site_url()?>/InstructorCon/AssignmentSearchCon/fetch",
                     "type": "POST"
                 },
                 "columnDefs":[{
                     "targets":[-1],
                     "orderable":false,
                 }]
             });
             
           
           //delete course from the datatable
           $(document).on('click','.delete',function(){
             var user_id=$(this).attr("id"); //getting the id from the id in del button ofsubdata[] in studentSearcchModel
             if(confirm("Are you sure you want to delete this faculty?"))
             {
                 alert(user_id);
                 table=$('#example').DataTable();
                 //if click on ok in the confirm box
                 $.ajax({
                      url:"<?php echo site_url()?>/CoursesSearchCon/deleteStudent",
                      method:"POST",
                      data:{user_id:user_id},
                      success:function(data){
                          alert(data);
                          $('#example').DataTable().ajax.reload();
                      }
                 });
             }else{
                 //no action when clicked on cancel in the confirm box
                 return false;
             }
           });
         
         
         
         });
      </script>
   </body>
</html>