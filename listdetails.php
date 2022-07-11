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
	
	$registry_number= $_GET['registry_number'];
   $_SESSION['registry_number'] =$_GET['registry_number'];

	
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
    <?php echo paginationLinks($page, $total_pages, 'listdetails.php'); ?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
