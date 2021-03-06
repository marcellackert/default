<!DOCTYPE html >
<html>
  <head>
    <title>Send form inputs with jQuery</title>
    <meta charset="UTF-8" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  </head>
  <body>
 
    <form id="myForm" action="jtest.php">
 
      <label for="color">Color</label>
 
      <br/>
      <input id="color" type="text" name="colorName" value="red" />
 
      <br/>      
      <label for="code">Code</label>
 
      <br/>
      <input id="code" type="text" name="colorCode" value="#FF0000" />
 
      <br/>      
      <input id="mySubmitButton" type="submit" value="Submit" />
 
    </form>
 
    <script>
      jQuery(document).ready(function($) {
 
        $('#mySubmitButton').on('click', function() {
 
          var object = {};
          // Put form inputs into an array
          var array = $('#myForm').serializeArray();
          // Make an object out of the array
          $.each(array, function(index, item) {
            object[item.name] = item.value;
          });
 
          $.ajax({
            dataType: 'json',
            contentType: 'application/json; charset=UTF-8',
            data: JSON.stringify(object),
            type: 'POST',
            url: 'receiver.php'
          }).done(function(data, textStatus, jqXHR) {
            console.log('Data sent.');
          }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log('There was an error.');
          });
 
          return false;
 
        });
 
      });
    </script>
  </body>
</html>