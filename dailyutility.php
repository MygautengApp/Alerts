<?php
session_start();
require_once './config/config.php';

//require_once 'includes/auth_validate.php';
date_default_timezone_set('Africa/Johannesburg');
$today = date('Y-m-d H:i:s', time());


//Get DB instance. function is defined in config.php
$db = getDbInstance();

//Get Dashboard information
$numCustomers = $db->getValue ("customers", "count(*)");
$query = "SELECT * FROM public.doc 
  where  type= 'event_house_resolution' and status ='awaiting_feedback' and  DATE_PART('day','$today'::timestamp  - '2022-06-03 14:37:47.881322'::timestamp)>=10 ";
  

   
$rs = pg_query($db_handle, $query) or die("Cannot execute query: $query\n");





  $count=pg_num_rows($rs);



include_once('includes/header.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bell fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $count; ?></div>
                            <div>Resolution</div>
                        </div>
                    </div>
                </div>
                <a href="list.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <?php 
							$query1 = "SELECT registry_number, title as name , (CAST(MAX(geolocation)As date) - CAST(MIN('$today') As date)) As days   FROM public.doc 
  where  type= 'event_house_resolution' and status ='awaiting_feedback' and (geolocation::DATE - '$today')<=10
  group by doc_id";
  

	 $rs = pg_query($db_handle, $query1) or die("Cannot execute query: $query\n");
	  // $final = [];
	
         	 while ($row = pg_fetch_assoc($rs)) {
		  
		       // echo $final[] = $row[0];

				//echo $row['days'];
				
				if( $row['days']>5){
					echo '<div class="col-lg-3 col-md-6 ">';
              echo '<div class="panel panel-green">';
                echo '<div class="panel-heading">';
                    echo '<div class="row">';
                       echo '<div class="col-xs-3">';
                          /*echo '<i class="fa fa-tasks fa-5x"></i>';*/
                       echo '</div>';
                        echo '<div class="col-xs-9 text-right">';
                            echo '<div class="huge">';
                            
                            if(strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE ){

                                echo '<div style="font-size: 16.4px;">'; echo $row['name']; echo '</div>';

                            }else if (strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Internet explorer') !== FALSE ){

                                    echo '<div style="font-size: 16.4px;">'; echo $row['name']; echo '</div>';

                                }else if (strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE ){

                                    echo '<div style="font-size: 20px;">'; echo $row['name']; echo '</div>';
                                }else if (strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Browser') !== FALSE ){

                                    echo '<div style="font-size: 20px;">'; echo $row['name']; echo '</div>';
                                }else if (strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE ){

                                    echo '<div style="font-size: 20px;">'; echo $row['name']; echo '</div>';


                  }else{

                               

                               echo '<div style="font-size: 10.6px;">'; echo $row['name']; echo '</div>'; 

                  }
					
					echo '</div>';
					     
						    echo $row['registry_number'];
						 $registry_number =$row['registry_number'];
						 	$_SESSION["registry_number"]=$registry_number; 
                          //echo '<div>New Tasks!</div>';
                       echo '</div>';
                    echo '</div>';
                echo '</div>';
               echo '<a href="listdetails.php?registry_number='.$registry_number.' ">';
                   echo '<div class="panel-footer">';
                      echo  '<span class="pull-left">View Details</span>';
                       echo '<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>';
                        echo '<div class="clearfix"></div>';
                    echo '</div>';
               echo '</a>';
           echo '</div>';
        echo '</div>';
					
					
				}else if($row['days']>=0 && $row['days']<=5 ){
                
						echo '<div class="col-lg-3 col-md-6">';
              echo '<div class="panel panel-yellow">';
                echo '<div class="panel-heading">';
                    echo '<div class="row">';
                       echo '<div class="col-xs-3">';
                        /*    echo '<i class="fa fa-tasks fa-5x"></i>';*/
                       echo '</div>';
                        echo '<div class="col-xs-9 text-right">';
                            echo '<div class="huge">';

                            if(strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE ){

                                echo '<div style="font-size: 16.4px;">'; echo $row['name']; echo '</div>';

                            }else if (strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Internet explorer') !== FALSE ){

                                echo '<div style="font-size: 16.4px;">'; echo $row['name']; echo '</div>';

                            }else if (strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE ){

                                echo '<div style="font-size: 20px;">'; echo $row['name']; echo '</div>';
                            }else if (strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Browser') !== FALSE ){

                                echo '<div style="font-size: 20px;">'; echo $row['name']; echo '</div>';
                            }else if (strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE ){

                                echo '<div style="font-size: 20px;">'; echo $row['name']; echo '</div>';

                  }else{

                               

                               echo '<div style="font-size: 10.6px;">'; echo $row['name']; echo '</div>'; 

                  }
					

					echo '</div>';
                         echo $row['registry_number'];
						 $registry_number =$row['registry_number'];
						 	$_SESSION["registry_number"]=$registry_number; 
						
                          //echo '<div>New Tasks!</div>';
                       echo '</div>';
                    echo '</div>';
                echo '</div>';
               echo '<a href="listdetails.php?registry_number='.$registry_number.' ">';
                   echo '<div class="panel-footer">';
                      echo  '<span class="pull-left">View Details</span>';
                       echo '<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>';
                        echo '<div class="clearfix"></div>';
                    echo '</div>';
               echo '</a>';
           echo '</div>';
        echo '</div>';					
			 }else if ($row['days']<0)
			 {
					echo '<div class="col-lg-3 col-md-6">';
              echo '<div class="panel panel-red">';
                echo '<div class="panel-heading">';
                    echo '<div class="row">';
                       echo '<div class="col-xs-3">';
                           /* echo '<i class="fa fa-tasks fa-5x"></i>';*/
                       echo '</div>';
                        echo '<div class="col-xs-9 text-right">';
                            echo '<div class="huge">';
					
                            if(strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE ){

                                echo '<div style="font-size: 16.4px;">'; echo $row['name']; echo '</div>';
                            }else if (strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Internet explorer') !== FALSE ){

                                echo '<div style="font-size: 16.4px;">'; echo $row['name']; echo '</div>';

                            }else if (strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE ){

                                echo '<div style="font-size: 20px;">'; echo $row['name']; echo '</div>';
                            }else if (strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Browser') !== FALSE ){

                                echo '<div style="font-size: 20px;">'; echo $row['name']; echo '</div>';
                            }else if (strlen($row['name'])<30 && strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE ){

                                echo '<div style="font-size: 20px;">'; echo $row['name']; echo '</div>';
                                


                  }else{

                               

                               echo '<div style="font-size: 10.6px;">'; echo $row['name']; echo '</div>'; 

                  }
					
					echo '</div>';
                   
                          //echo '<div>New Tasks!</div>';
						  echo $row['registry_number'];
						 $registry_number =$row['registry_number'];
						 	$_SESSION["registry_number"]=$registry_number; 
						  
                       echo '</div>';
                    echo '</div>';
                echo '</div>';
               echo '<a href="listdetails.php?registry_number='.$registry_number.' ">';
                   echo '<div class="panel-footer">';
                      echo  '<span class="pull-left">View Details</span>';
                       echo '<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>';
                        echo '<div class="clearfix"></div>';
                    echo '</div>';
               echo '</a>';
           echo '</div>';
        echo '</div>';
			 }
			 }
							
							?>
		
		   
		
        <div class="col-lg-3 col-md-6">
        
        </div>
        <div class="col-lg-3 col-md-6">
            
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">


            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">

            <!-- /.panel .chat-panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<?php include_once('includes/footer.php'); ?>
