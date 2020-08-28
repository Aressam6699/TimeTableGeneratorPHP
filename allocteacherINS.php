<?php
$connect=mysqli_connect("localhost","root","aressam1999");
mysqli_select_db($connect,"instmgtsys");
$tid=$_POST['teacher'];
function fill_unit_select_box($connect)
{ 
 $output = '';
 

    $query="SELECT * FROM subject";

//  subject NOT IN (comma seperated values)


 $result=mysqli_query($connect,$query);
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["subjectid"].'">'.$row["subjectname"].'&nbsp'.$row["subtype"].'</option>';
 }
 return $output;
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Allocate subject</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
 <body>
  <br />
  <div class="container">
   <br/>
   <h4 align="center">Subjects : </h4>
   <br />
   <form action="#" method="post" id="insert_form">
    <div class="table-repsonsive">
     <span id="error"></span>
     <table class="table table-bordered">
     <tbody id="item_table">
      <tr>
       <th>Add subject</th>
       <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
      </tr>
  </tbody>
     </table>
     <div align="center">
        <input type="hidden" name="hid" value="<?=$tid?>">
      <input type="submit" name="submit" class="btn btn-info" value="Assign" />
     </div>
    </div>
   </form>
  </div>
 </body>

</html>

<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += "<tr>";
  html += '<td><select name="subject[]" class="form-control item_unit"><option value="">-sel-</option><?php echo fill_unit_select_box($connect); ?></select></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';

  $('#item_table').append(html);
 });
 
  $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });
 
 $('#insert_form').on('submit', function(event){

  var error = '';
  $('.subject').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select Subject at "+count+" Row</p>";
    return false;
   }
   count = count + 1;

  });
  var form_data = $(this).serialize();
  if(error == '')
  {
   $.ajax({
    url:"allocteacherINS2.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
      // alert(data);
     if(data == 'ok')
     {
      $('#item_table').find("tr:gt(0)").remove();
      $('#error').html('<div class="alert alert-success">Subject added</div>');
     }
     window.location.replace("allocteacher.php");
    }
   });

  }
  else
  {
   $('#error').html('<div class="alert alert-danger">'+error+'</div>');
  }
return false;
 });

 
});
</script>