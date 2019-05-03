<!DOCTYPE html>
<!-- Created by Sami Al-Qusus March 17, 2018 -->
<!-- modified April 15, 2018 -->
<!-- front.php for CSCI370 Project-->

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <!-- popper library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
                
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	
        <title> ZAMZAM Restaurant </title>
    </head>
    <body>
      <header>
	  <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
	       <a class="navbar-brand" href="index.php">All Orders</a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
               <ul class="navbar-nav ml-auto  mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="create.php">Create New Order &nbsp;</a>
                </li>
	       </ul>
                <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
                  <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search by order id">
                  <button class="btn btn-outline-success my-2 my-sm-0"  type="submit">Search</button>
                </form>
               </div>
          </nav>
      </header><br><br><br>
           <div class="container">
