<?php
session_start();
require_once 'config/config.php';
//require_once BASE_PATH . '/includes/auth_validate.php';



date_default_timezone_set('Africa/Johannesburg');
$today = date('Y-m-d H:i:s', time());


// Per page limit for pagination.
$pagelimit = 15;

// Get current page.
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
	$page = 1;
}



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


	 <!--<div id="export-section">
        <a href="export_singlelist.php"><button class="btn btn-sm btn-primary">Export to CSV <i class="glyphicon glyphicon-export"></i></button></a>
    </div>-->

	<?php 
	
	$registry_number= $_GET['registry_number'];
   $_SESSION['registry_number'] =$_GET['registry_number'];
$_SESSION["registry_number"]=$registry_number;
	
	$query = "SELECT doc_id,title as name,registry_number,status_date,status,(CAST(MAX(geolocation)As date) - CAST(MIN('$today') As date)) As days,geolocation FROM public.doc 
  where registry_number ='$registry_number'
  group by doc_id";
    
   
   
   
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
       
	
	pg_close($db_handle);
   
?>  
    <!-- //Table -->

    <!-- Pagination -->
   
	 <div class="text-center">
    <!--<?php echo paginationLinks($page, $total_pages, 'listdetails.php'); ?>-->
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
