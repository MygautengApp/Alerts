<?php 

	$db_handle = pg_connect("host=localhost dbname=pg_catalog user=postgres password=Marhavuli8");

date_default_timezone_set('Africa/Johannesburg');
$today = date('Y-m-d H:i:s', time());
if ($db_handle) {

//echo 'Connection attempt succeeded.';

} else {

echo 'Connection attempt failed.';

}
//2022-06-02 12:38:00.041116

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
                   

				   
$query = "SELECT d.doc_id,g.group_id,ugm.group_id,d.title as name,d.registry_number,g.short_name,d.status_date,d.status,(CAST(MAX(geolocation)As date) - CAST(MIN('$today') As date)) As days,geolocation FROM public.doc d
  left join public.group g on d.doc_id =g.group_id
  left join public.user_group_membership ugm on g.group_id =d.doc_id
  
  where d.status ='awaiting_feedback' and DATE_PART('day','$today'::timestamp  - '2022-06-03 14:37:47.881322'::timestamp)>=10 and ugm.active_p=true
  group by d.doc_id,g.group_id,ugm.group_id";
    echo $count.' '. "Resolution are within 10 days the feedback deadline";
	 echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Title</th>";
                                        echo "<th>RegNumber</th>";
										echo "<th>Short Name</th>";
										echo "<th>Recipient</th>";
										echo "<th>Deadline </th>";
                                        echo "<th>Status</th>";
                                       // echo "<th>Status </th>";
                                        echo "<th>Days to Dealine</th>";
										 
                                       
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
   
$rs = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");

//$data =pg_fetch_result($rs,0,'Deadline1');
	
 
 	 while ($row = pg_fetch_assoc($rs)) {
		  
		 
// Display Results of Search

                                        echo "<tr>";
                                       echo "<td>" . $row['doc_id'] . "</td>";
										  echo "<td>" . $row['name']. "</td>";
                                        echo "<td>" . $row['registry_number'] . "</td>";
										echo "<td>" . $row['short_name'] . "</td>";
										
										 echo "<td>" . $row['group_id'] . "</td>";
										
                                      echo "<td>" . $row['geolocation'] . "</td>";
                                        echo "<td>" . $row['status']. "</td>";
										//echo "<td>" . $row['geolocation']. "</td>";
										echo "<td>" . $row['days']. "</td>";
										//echo "<td>" . $row['']. "</td>";
										//echo "<td>" . $status . "</td>";
									//	echo "<td>" . '<a href="read.php?idnumber='.$_SESSION["idnumber"].'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>'."</td>";
                                    
                                    echo "</tr>";
                                } 
                                echo "</tbody>";                            
                            echo "</table>";
       
	   

	   
	   
		

 //echo $row['title'];
// echo $row['doc_type'];
    
    //echo "\n";

 // }

//sending of email
                                            

  
/*                                              
$query2 ="update public.doc set geolocation='2022-08-11 14:37:47.881322'
	where doc_id ='5615'";
  $result2 = pg_query($db_handle, $query2) or die("Cannot execute query: $query\n");
  
  if($result2)
  {
	  echo "successfully updated";
	  
  }else{
	  
	  echo "not updated";
  }
  
                                            
$query3 ="update public.doc set geolocation='2022-08-09 14:37:47.881322'
	where doc_id ='5650'";
  $result3 = pg_query($db_handle, $query3) or die("Cannot execute query: $query\n");
  
  if($result3)
  {
	  echo "successfully updated";
	  
  }else{
	  
	  echo "not updated";
  }
  
                                              
$query4 ="update public.doc set geolocation='2022-08-07 14:37:47.881322'
	where doc_id ='5651'";
  $result4 = pg_query($db_handle, $query4) or die("Cannot execute query: $query\n");
  
  if($result4)
  {
	  echo "successfully updated";
	  
  }else{
	  
	  echo "not updated";
  }
*/
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

  }


//echo $data;
pg_close($db_handle);

?>