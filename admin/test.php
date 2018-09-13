<!DOCTYPE HTML>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="editor.js"></script>
		<?php if (empty($_POST["page"])) { ?>
		<script>
			$(document).ready(function() {
                $("#txtEditor").Editor();
               
                
            });
		</script>
		<?php } ?>   
		 
		<script>
            $(document).ready(function() {
                $("#send").submit(function() {
                    $("#testo").html($("#txtEditor").Editor("getText"));
					$.ajax
		({
			type: "POST",
			url: 'test2.php',
			data:{message: $("#txtEditor").Editor("getText"), file: 'testsc.txt'},
			success: function(data){
				alert(data);
			},

		   
			error:function(){
			  alert("es ist ein Fehler aufgetreten");
		   }
	})
                })
                });

            $("#placeHolder").Editor("getText");
            $("#txtEditor").Editor("setText", "Hello");
        </script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link href="editor.css" type="text/css" rel="stylesheet"/>
		<title>LineControl | v1.1.0</title>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<h2 class="demo-text">LineControl Demo</h2>
				<div class="container">
					<div class="row">
						<div class="col-lg-12 nopadding">
                            <form method="post" id="send">
                            <textarea id="txtEditor"></textarea> 
                            <input type="submit" value="speichern"/>
        </form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid footer">
			<p class="pull-right">&copy; Suyati Technologies <script>document.write(new Date().getFullYear())</script>. All rights reserved.</p>
        </div>
        <div id="placeHolder">wurst</div>
		<div id="testo"></div>
	</body>
</html>

<?php 

if (!empty($_POST["page"]) && $_POST["page"] == "do")
{
echo $_POST["teststring"]; 
}?>

<?php var_dump($_POST["message"]); ?>