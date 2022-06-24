<?php 
	$db_handle = pg_connect("host=localhost dbname=pg_catalog user=postgres password=Marhavuli8");
date_default_timezone_set('Africa/Johannesburg');
$today = date('Y-m-d H:i:s', time());
if ($db_handle) {

echo 'Connection attempt succeeded.';

} else {

echo 'Connection attempt failed.';

}
//2022-06-02 12:38:00.041116

$query = "SELECT * FROM public.doc 
  where  type= 'event_house_resolution' and status ='awaiting_feedback' and DATE_PART('day','$today'::timestamp  - '2022-06-03 14:37:47.881322'::timestamp)>=10 ";
  

   
$rs = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");





  $count=pg_num_rows($rs);
  
  if($count==0){
	  
	
	  
	              echo '<script>

  alert("No alerts.");

</script>';
	   
	

  }else{
	  
	
	              echo '<script>

  alert("Alerts from ten days before Feedback time expires.");

</script>';

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


/*$query = "SELECT count(*) as _count,DATE_PART('day','$today'::timestamp  - '2022-06-03 14:37:47.881322'::timestamp) as dealine FROM public.doc 
  where  type= 'event_house_resolution' and status ='awaiting_feedback' ";*/
  

   
//$rs = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");

	//$results = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");
 
 	  while ($row = pg_fetch_assoc($rs)) {
 
 echo $row['email'];
    
    echo "\n";

}

//sending of email



if($query){
  
 
    $to ='<'.$row['email'].'>';
$subject = 'Info Alerts';
$message = "Good day ".$row['first_name']."\r\n "."Are left 3 days. Your login details are as follows:" ."\r\n "."Regards,"."\r\n "."ISSUED BY THE PARLIAMENT OF THE REPUBLIC OF SOUTH AFRICA";

$headers = 'From: '."Parliament". '<'.'rodwellshibambu@gmail.com'.'>' . PHP_EOL .
    'Reply-To: '.$row['first_name']. '<'.$row['email'].'>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion();
    $retval= mail($to, $subject,$message,$headers);
 
  // $retval = mail("To:".''.$email,"Account Password","You need to change password to your own:".''.$password1,"From: gautengapp@gauteng.gov.za");
  }
  else {
 
  
  }
 




       /*  $query="select u.salutation, u.first_name, u.last_name, u.email, gmr.role_id  from group_membership_role gmr 
            left join user_group_membership ugm on gmr.membership_id = ugm.membership_id 
            left join public.user u on u.user_id = ugm.user_id 
            where gmr.role_id in ('bungeni.NATable.ProceduralOfficer','bungeni.NATable.SeniorProceduralOfficer') and ugm.active_p=true";
			
			
			$results = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");
 
 	  while ($row = pg_fetch_assoc($results)) {
 
 echo $row['email']."".$row['role_id'];
    
    echo "\n";

}*/

  }


//echo $data;
pg_close($db_handle);

?>