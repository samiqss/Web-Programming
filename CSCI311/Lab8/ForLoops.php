<!DOCTYPE html>
<!-- Created by Sami Al-Qusus March 5, 2018 -->
<!-- modified March 11, 2018 -->
<!-- ForLoops.php required for Lab8 -->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['iterations'])){
       $iterations = $_POST['iterations'];
    }
}
?>

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
        
        <title>For Loops</title>
    </head>
    <body>
           <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
               <a class="navbar-brand" href="Lab8.php">LAB8</a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
               <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="Lab8.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="ForLoops.php">Loops</a>
                </li>
		<li class="nav-item">
		    <a class="nav-link" href="Nested.php">Nested Loops</a>
		</li>
                <li class="nav-item">
                    <a class="nav-link" href="Shapes">Shapes</a>
                </li>
               </ul>
               </div>
          </nav>
           
           <div class="container">

	    <h2 class="text-center">For Loop</h2>
	    <form class="text-center" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
             <div>
             <label for="iterations" >Iterations</label>
	     <input id="iterations" type="number" placeholder="0" name="iterations"/>
	     <input type="submit" value="submit">
	     </div>
	    </form>
            <ul>
	    <?php
	      if($_SERVER["REQUEST_METHOD"] == "POST")
              {
                for ($x = 0; $x < $iterations; $x++) {
		     echo "<li>Iterations: $x</li>";
	       }
	      }
            ?>	
            </ul>
            <footer style="text-align:center;">
                <small>Copyright &copy;2018 Sami Al-Qusus</small>
            </footer>
           </div>
    </body>
</html>

