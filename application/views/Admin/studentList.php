<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Student List</title>
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
         
      </style>
   </head>
   <?php if(isset($_SESSION['username']))
        {
       ?>
   <body background="<?php echo base_url('images/bg.jpg'); ?>">
      
      <div class="sidenav" id="mydiv">
      <nav>
           <a href="<?php echo base_url('Admins/profile'); ?>">Home Page</a>
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
          <h1 style="color:white">Edit Students List</h1>
      <table id="example" class="display" cellspacing="0" width="100%">
      <thead>
      <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>User Name</th>
      <th>Gender</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Action</th>
      </tr>
      </thead>
      <tbody id="showdata">
      </tbody>
      <tfoot>
      
      </tfoot>
      </table>
      </div>
      <!--  must for delete functionality,i have already written below in usermodal so i commented this
         <div><input type="hidden" name="user_id" id="user_id"/></div>-->
      <!--update dialog box-->
      <div id="userModal" class="modal fade">
      <div class="modal-dialog">
      <form method="POST" id="user_form">
      <input type="hidden" name="txtId" value="0"/>
      <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Update Student Details</h4>
      </div>
      <div class="modal-body">
      <label>First Name</label>
      <input type="text" name="first_name" id="first_Name" class="form-control" pattern="^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$" title="Please enter only characters"/><br>
      <label>Last Name</label>
      <input type="text" name="last_name" id="last_Name" class="form-control" pattern="^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$" title="Please enter only characters"/><br>
      <label>Email</label>
      <input type="text" name="mail" id="mail" class="form-control" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@ex.com"/><br>
      <label>Phone</label>
      <input type="text" name="phone" id="phone" class="form-control" maxlength="10" pattern="^(?!(\d)\1{9})(?!0123456789|1234567890|0987654321|9876543210)\d{10}$" title="enter 10 digit phone number"/><br>
      <label>Address</label>
      <input type="text" name="address" id="address" class="form-control"/><br>
      <input type="hidden" name="user_name" id="user_name" class="form-control"/><br>
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
             $('#example').DataTable({
                 "processing": true,
                 "serverSide": true,
                 "lengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                 "pageLength":5,
                 "ajax":{
                     "url":"<?php echo site_url()?>/StudentSearchCon/fetch",
                     "type": "POST"
                 },
                 "columnDefs":[{
                     "targets":[-1],
                     "orderable":false,
                 }]
             });
             
           //delete student from the datatable
           $(document).on('click','.delete',function(){
             var user_id=$(this).attr("id"); //getting the id from the id in del button ofsubdata[] in studentSearcchModel
             if(confirm("Are you sure you want to delete this student?"))
             {
                 table=$('#example').DataTable();
                 //if click on ok in the confirm box
                 $.ajax({
                      url:"<?php echo site_url()?>/StudentSearchCon/deleteStudent",
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
           
           
           //update
          
           
           
           
           
           
           
           
           
           
           // when click on update button in datatable to display the values in the popup form
           $(document).on('click','.update',function(){
           var useridd=$(this).attr("id");
           //alert(user_id);
           //in data userd is the name of input in the studentsearchmodel/fetch_single_user
           //userd is used as input ie., this will have the useridd which is used while quering 
            $.ajax({
                      url:"<?php echo site_url()?>/StudentSearchCon/fetch_single_user",
                      method:"GET",
                      data:{userd:useridd},
                      datatype:"json",
                      success:function(data){
                          //to popup the update page
                          //var result=json.parse(data);
                       // alert(data);
                         //alert(result.userid);
                         var json = JSON.parse(data);
                         //alert(json.username);
                         $('#userModal').modal('show');
                          $('#userModal').find('.modal-title').text("Edit Student Data");
                          $('#user_id').val(json.userid);
                          $('input[name=txtId]').val(json.userid);
                          $('#user_name').val(json.username);
                          $('#first_Name').val(json.firstname);
                          $('#last_Name').val(json.lastname);
                          $('#mail').val(json.email);
                          $('#phone').val(json.phone);
                          $('#address').val(json.address);
                          $('#action').val('Update');
                      }
                  });
           
           });
          
         //  update
         $(document).on('submit', '#user_form', function(event){  
                event.preventDefault();  
                var firstName = $('#first_Name').val();  
               var userName = $('#user_name').val();  
                var mail=$('#mail').val();
                     
                if(firstName != '' && userName != '' && mail !='')  
                {  
                     $.ajax({  
                          url:"<?php echo site_url()?>/StudentSearchCon/user_action",  
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
                     alert("First Name and Email Fields are Required");  
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