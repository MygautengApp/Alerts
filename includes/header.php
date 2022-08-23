<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>

            
.navbar{
    background-color:#275937;
                
            } 
            .navbar  a{
                color:#fff;
                
            } 
        .navbar  a:hover{
             color:#fff;
            }
               
                
        </style>
        
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Daily Alerts</title>

        <!-- Bootstrap Core CSS -->
        <link  rel="stylesheet" href="assets/css/bootstrap.min.css"/>
       

        <!-- MetisMenu CSS -->
        <link href="assets/js/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="assets/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>

    </head>

    <body>
    
        <div id="wrapper">
       
        
            <!-- Navigation -->
           
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                 
                    <div class="navbar-header">
    
                    
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                   

                        <a class="navbar-brand" href="">Daily Alerts</a>
                    </div>
                    <!-- /.navbar-header -->

                    <ul class="nav navbar-top-links navbar-right">
                                           </ul>
                    <!-- /.navbar-top-links -->

                    <div class="navbar sidebar" role="navigation" >
                        <div class= "sidebar-nav navbar-collapse" >
                            <ul class="nav"   id="side-menu">
                                <li>
                        
                                    <a href="dailyutility.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                                </li>

                              <!--  <li <?php echo (CURRENT_PAGE == "list.php" ) ? 'class="active"' : ''; ?>>-->
                                    <a href="#"><i class="fa fa-bell fa-fw"></i> Alerts Utility<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            
											 <a href="list.php"><i class="fa fa-list fa-fw"></i>List all</a>
                                        </li>
                                    <!--<li>
                                        <a href="add_customer.php"><i class="fa fa-plus fa-fw"></i>Add New</a>
                                    </li>-->
                                    </ul>
                                </li>
                                <!--<li>
                                    <a href="admin_users.php"><i class="fa fa-users fa-fw"></i> Users</a>
                                </li>-->
                            </ul>
                        </div>
                        <!-- /.sidebar-collapse -->
                    </div>
                    <!-- /.navbar-static-side -->
                </nav>
           
            <!-- The End of the Header -->