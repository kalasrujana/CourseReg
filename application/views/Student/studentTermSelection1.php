<html>
<head>
    <title>Enroll</title>
    
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <style>
 .box
 {
  width:100%;
  max-width: 650px;
  margin:0 auto;
 }
 </style>
</head>
<body>
 <div class="container box">
  <br />
  <br />
  <h3 align="center">Select the Semester and Course</h3>
  <br />
  <div class="form-group">
   <select name="semester" id="semester" class="form-control input-lg">
    <option value="">Select Semester</option>
    <option value="Fall">Fall</option>
                <option value="Summer-2">Summer-2</option>
                <option value="Summer-1">Summer-1</option>
                <option value="Spring">Spring</option>
   </select>
  </div>
  <br />
  <div class="form-group">
   <select name="cou" id="cou" class="form-control input-lg">
    <option value="">Select course</option>
   </select>
  </div>
  <br />
  
 </div>
</body>
</html>
<script>
$(document).ready(function(){
 $('#semester').change(function(){
  var semester = $('#semester').val();
  alert(semester);
  if(semester != '')
  {
      $.ajax({
                 url:"<?php echo site_url()?>/StudentCon/Student1/getStates",
                 method:"POST",
                 data:{semester:semester},
                 success:function(data){
                     alert(data);
                     
                     $('#cou').html('<option value="">Select course</option>'); 
                    var dataObj = jQuery.parseJSON(data);
                    if(dataObj){
                        $(dataObj).each(function(){
                            var option = $('<option />');
                            option.attr('value', this.course_ID).text(this.course_ID);           
                            $('#cou').append(option);
                        });
                    }else{
                        $('#cou').html('<option value="">State not available</option>');
                    }
                    
        
                 
    
    }
            });
      
      
      
  
  }
  else
  {
   alert("hi");
  
  }
 });
 
});
</script>
