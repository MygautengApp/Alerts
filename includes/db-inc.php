<?php 
	$db_handle = pg_connect("host=localhost dbname=pg_catalog user=postgres password=Marhavuli8");
date_default_timezone_set('Africa/Johannesburg');
$today = date('Y-m-d H:i:s', time());
if ($db_handle) {

echo 'Connection attempt succeeded.';

} else {

echo 'Connection attempt failed.';

}

$query = "SELECT * FROM public.doc 
  where type='event_house_resolution' and status ='awaiting_feedback' ";

$rs = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");
  //$data =array();
while ($row = pg_fetch_assoc($rs)) {
 
 echo $row['type']."".$row['status'] ."".$row['status_date'];
    
    echo "\n";



}


//echo $data;
pg_close($db_handle);

?>