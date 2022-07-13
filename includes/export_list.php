<?php
	$db_handle = pg_connect("host=localhost dbname=pg_catalog user=postgres password=Marhavuli8");
date_default_timezone_set('Africa/Johannesburg');
$today = date('Y-m-d H:i:s', time());
date_default_timezone_set('Africa/Johannesburg');
$today = date('Y-m-d H:i:s', time());
    
// Fetch records from database 



	$query =pg_query($db_handle,"SELECT doc_id,title as name,registry_number,status_date,status,(CAST(MAX(geolocation)As date) - CAST(MIN('$today') As date)) As days,geolocation FROM public.doc 
  where status ='awaiting_feedback' and (geolocation::DATE - '$today')<=10 
  group by doc_id");
 
 
    $delimiter = ","; 
    $filename = "members-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ID', 'Title', 'Reg Number', 'Status', 'Geolocation', 'Days'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = pg_fetch_assoc($query)){ 
       
        $lineData = array($row['doc_id'], $row['name'], $row['registry_number'],$row['status'], $row['geolocation'],$row['days']); 
        fputcsv($f, $lineData, $delimiter); 
		
		
		
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 

//exit; 	
	
	
	
	

    // Fetch Record from Database

   /* $output = "";
    $table = "public.doc"; // Enter Your Table Name 
    $sql = pg_query($db_handle,"select * from $table");
    $columns_total = pg_num_fields($sql);

    // Get The Field Name
   
    for ($i = 0; $i < $columns_total; $i++) {
    $heading = pg_field_name($sql, $i);
    $output .= '"'.$heading.'",';
    }
    $output .="\n";

    // Get Records from the table

    while ($row = pg_fetch_array($db_handle,$sql)) {
    for ($i = 0; $i < $columns_total; $i++) {
    $output .='"'.$row["$i"].'",';
    }
    $output .="\n";
    }

    // Download the file

    $filename = time().'csv'; //For unique file name
    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename='.$filename);

    echo $output;*/
    exit;

    ?>