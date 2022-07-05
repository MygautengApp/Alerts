<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

// Costumers class
require_once BASE_PATH . '/lib/Costumers/Costumers.php';
$costumers = new Costumers();

date_default_timezone_set('Africa/Johannesburg');
$today = date('Y-m-d H:i:s', time());

// Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');

// Per page limit for pagination.
$pagelimit = 15;

// Get current page.
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
	$page = 1;
}

// If filter types are not selected we show latest added data first
if (!$filter_col) {
	$filter_col = 'id';
}
if (!$order_by) {
	$order_by = 'Desc';
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('id', 'f_name', 'l_name', 'gender', 'phone', 'created_at', 'updated_at');

//Start building query according to input parameters.
// If search string
if ($search_string) {
	$db->where('f_name', '%' . $search_string . '%', 'like');
	$db->orwhere('l_name', '%' . $search_string . '%', 'like');
}

//If order by option selected
if ($order_by) {
	$db->orderBy($filter_col, $order_by);
}

// Set pagination limit
$db->pageLimit = $pagelimit;

// Get result of the query.
$rows = $db->arraybuilder()->paginate('customers', $page, $select);
$total_pages = $db->totalPages;







include BASE_PATH . '/includes/header.php';
?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Alerts Utility</h1>
        </div>
        
    </div>
    <?php include BASE_PATH . '/includes/flash_messages.php';?>

    <!-- Filters -->
   <!-- <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo xss_clean($search_string); ?>">
            <label for="input_order">Order By</label>
            <select name="filter_col" class="form-control">
                <?php
foreach ($costumers->setOrderingValues() as $opt_value => $opt_name):
	($order_by === $opt_value) ? $selected = 'selected' : $selected = '';
	echo ' <option value="' . $opt_value . '" ' . $selected . '>' . $opt_name . '</option>';
endforeach;
?>
            </select>
            <select name="order_by" class="form-control" id="input_order">
                <option value="Asc" <?php
if ($order_by == 'Asc') {
	echo 'selected';
}
?> >Asc</option>
                <option value="Desc" <?php
if ($order_by == 'Desc') {
	echo 'selected';
}
?>>Desc</option>
            </select>
            <input type="submit" value="Go" class="btn btn-primary">
        </form>
    </div>
    <hr>-->
    <!-- //Filters -->


    <!--<div id="export-section">
        <a href="export_customers.php"><button class="btn btn-sm btn-primary">Export to CSV <i class="glyphicon glyphicon-export"></i></button></a>
    </div>-->
	 <div id="export-section">
        <a href="export_list.php"><button class="btn btn-sm btn-primary">Export to CSV <i class="glyphicon glyphicon-export"></i></button></a>
    </div>

	<?php 
	$query = "SELECT * FROM public.doc 
  where  type= 'event_house_resolution' and status ='awaiting_feedback' and  DATE_PART('day','$today'::timestamp  - '2022-06-03 14:37:47.881322'::timestamp)>=10 ";
  

   
$rs = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");





  $count=pg_num_rows($rs);
  
  
  if($count==0){
	  
	
	  
	              echo '<script>

  alert("No alerts.");

</script>';
	   
	

  }else{
	  
	
	              echo '<script>

  alert( "Alerts from ten days before Feedback time expires.");

</script>';


// echo "the number of rows".$count;

/*- Read the user (including email Address, Telephone)
	If ParliamentID = NA/NCOP
    		then (Read Role (Procedural Officer, Senior Procedural Officer, ***)
		Display email
*/
	 	  
/*$query = "SELECT usr.salutation, usr.first_name, usr.last_name,usr.email,add.phone,gmr.role_id FROM public.group_membership_role gmr
left join user_group_membership ugm on gmr.membership_id = ugm.membership_id
left join public.user usr on usr.user_id = ugm.user_id
left join address add on address_id =usr.user_id
where gmr.role_id in ('bungeni.NATable.ProceduralOfficer','bungeni.NATable.SeniorProceduralOfficer','bungeni.NCOPTable.ProceduralOfficer','bungeni.NCOPTable.SeniorProceduralOfficer') and ugm.active_p=true";
  
 $results = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");
 
 	  while ($row = pg_fetch_assoc($results)) {
 
 echo $row['email']."test2...".$row['phone']."test3...".$row['first_name']."test4...".$row['last_name']."test5...".$row['salutation'];
    
    echo "\n";

}*/
                   

       
		

 //echo $row['title'];
// echo $row['doc_type'];
    
    //echo "\n";

 // }

//sending of email
                                            
/*$query1 ="update public.doc set geolocation='2022-07-02 14:37:47.881322'
	where doc_id ='5654'";
  $result = pg_query($db_handle, $query1) or die("Cannot execute query: $query\n");
  
  if($result)
  {
	  echo "successfully updated";
	  
  }else{
	  
	  echo "not updated";
  }*/

/*$query1 ="Select geolocation from public.doc where doc_id ='5615'";

$result = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");
  echo $result;*/
 
    $to ='<'.'thamsanqagumede30@gmail.com'.'>';
$subject = 'Info Alerts';
$message = "Good day ".'Thamsanga'."\r\n ".' '.$count.' '. "Resolution are within 10 days the feedback deadline" ."\r\n "."Regards,"."\r\n "."ISSUED BY THE PARLIAMENT OF THE REPUBLIC OF SOUTH AFRICA";

$headers = 'From: '."Parliament". '<'.'rodwellshibambu@gmail.com'.'>' . PHP_EOL .
    'Reply-To: '.'Thamsanga'. '<'.'thamsanqagumede30@gmail.com'.'>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion();
    $retval= mail($to, $subject,$message,$headers);
 
  // $retval = mail("To:".''.$email,"Account Password","You need to change password to your own:".''.$password1,"From: gautengapp@gauteng.gov.za");

 




       /*  $query="select u.salutation, u.first_name, u.last_name, u.email, gmr.role_id  from group_membership_role gmr 
            left join user_group_membership ugm on gmr.membership_id = ugm.membership_id 
            left join public.user u on u.user_id = ugm.user_id 
            where gmr.role_id in ('bungeni.NATable.ProceduralOfficer','bungeni.NATable.SeniorProceduralOfficer') and ugm.active_p=true";
			
			
			$results = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");
 
 	  while ($row = pg_fetch_assoc($results)) {
 
 echo $row['email']."".$row['role_id'];
    
    echo "\n";

}*/

  


//echo $data;


	
	
	
	
	$query = "SELECT doc_id,title as name,registry_number,status_date,status,(CAST(MAX(geolocation)As date) - CAST(MIN('$today') As date)) As days,geolocation FROM public.doc 
  where status ='awaiting_feedback' and DATE_PART('day','$today'::timestamp  - '2022-06-03 14:37:47.881322'::timestamp)>=10
  group by doc_id";
    echo $count.' '. "Resolution are within 10 days the feedback deadline";
   
   
   
   // <!-- Table -->
  echo  '<table class="table table-striped table-bordered table-condensed">';
       echo " <thead>";
           echo "<tr>";
               echo '<th width="5%">ID</th>';
                echo '<th width="45%">Title</th>';
               echo '<th width="20%">RegNumber</th>';
                echo '<th width="20%">Deadline</th>';
               echo '<th width="10%">Status</th>';
				echo '<th width="10%">Days to Dealine</th>';
				
           echo "</tr>";
       echo "</thead>";
       echo "<tbody>";
	
   
$rs = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");

	
	
	
         	 while ($row = pg_fetch_assoc($rs)) {
		  
		 
// Display Results of Search

			 echo "<tr>";
                echo "<td>" .$row['doc_id']. "</td>";
               echo "<td>" .xss_clean($row['name']). "</td>";
                echo "<td>" .xss_clean($row['registry_number']). "</td>";
                echo "<td>" .xss_clean($row['geolocation']). "</td>";
			   echo "<td>" .xss_clean($row['status']). "</td>";
				echo "<td>" .xss_clean($row['days']) . "</td>";
                
					echo "</tr>";

                                       
                                } 
                                echo "</tbody>";                            
                            echo "</table>";
       
	}
	pg_close($db_handle);
   
?>  
    <!-- //Table -->

    <!-- Pagination -->
   
	 <div class="text-center">
    <?php echo paginationLinks($page, $total_pages, 'list.php'); ?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
