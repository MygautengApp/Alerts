<?php
require_once './config/config.php';
require_once 'includes/auth_validate.php';

    

    // Fetch Record from Database

    $output = "";
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

    echo $output;
    exit;

    ?>