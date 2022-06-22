<?php 
		require 'includes/snippet.php';
	//require 'includes/db-inc.php';
	include "includes/header.php";
$db_handle = pg_connect("host=localhost dbname=pg_catalog user=postgres password=Marhavuli8");
	
$query = "SELECT * FROM public.doc 
where type= 'event_house_resolution and status ='awaiting_feedback'";

$rs = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");
  //$data =array();
while ($row = pg_fetch_assoc($rs)) {
 
 echo $row['status'] ." " ."FirstName: " .$row['registry_number']." "."LastName:"." ".$row['title']." ".$row['status_date']." ".$row['type'];
    
    echo "\n";



}

/*select Status, Registry, Title,body, feedback_date
from doc  
where type = 'event_house_resolution'
-	and status = 'awaiting_feedback'
-	and Feedback Date – Current Date >= 10 Days [Alerts from ten days before Feedback time expires]*/


	
		
	

 ?>

<!--
<div class="container">
    <?php include "includes/nav.php"; ?>
	<div class="container  col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0  " style="margin-top: 30px">
		<div class="jumbotron login col-lg-10 col-md-11 col-sm-12 col-xs-12">
			<?php if(isset($error)) { ?>
		<div class="alert alert-success alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  <strong>Record Added Successfully!</strong>
			</div>
			<?php } ?>
			<p class="page-header" style="text-align: center">ADD ADMIN</p>

			<div class="container">
				<form class="form-horizontal" role="form" method="post" action="adduser.php" enctype="multipart/form-data">
				<div class="form-group">
						<label for="Name" class="col-sm-2 control-label">Full Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" placeholder="Enter Full Name" id="name" required>
						</div>		
					</div>
					<div class="form-group">
						<label for="Username" class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="username" placeholder="Enter Username" id="username" required>
						</div>		
					</div>
					<div class="form-group">
						<label for="Password" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password1" placeholder="Enter Password" id="password" required>
						</div>		
					</div>
					<div class="form-group">
						<label for="Password" class="col-sm-2 control-label">Confirm Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password2" placeholder="Enter Password" id="password" required>
						</div>		
					</div>
          <div class="form-group">
            <label for="Password" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" name="email" placeholder="Enter email" id="email" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">IMAGE</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="postimg" placeholder="Enter image" id="password" style="padding: 0" required>
            </div>
          </div>
					
					<div class="form-group ">
						<div class="col-sm-offset-2 col-sm-10 ">
							<button type="submit" class="btn btn-info col-lg-4 " name="submit">
								Submit
							</button>
							
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
</div>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript">
 	window.onload = function () {
		var input = document.getElementById('name').focus();
	}
 </script>
</body>
</html>-->