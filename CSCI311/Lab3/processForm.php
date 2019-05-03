<?php
    $name;
    $age;
    $funness;
    $email;
    $err;
    if(isset($_POST)){
        $name=$_POST['name'];
        $age=$_POST['age'];
        $funness=$_POST['fun'];
        $email=$_POST['email'];
        if(trim($name)==='' || trim($age)==='' || trim($funness)==='' ||
           trim($email)===''){
            $err = "Sorry, all values must be filled in";
        }
    }
    ?>
<!DOCTYPE html>
<!-- put your comments here-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta charset="utf-8"/>
<title>Result</title>
<link rel="stylesheet" type="text/css" href="sharedStyles.css">
<!-- other head stuff -->
</head>
<body>
<?php
    if(isset($err)){
        echo "<p>".$err."</p>\n";
        echo "<a href='Lab3.html'>Back</a>\n";
    }else{
        ?>
<h1>Your submitted values:</h1>
<p>Name: <?php echo $name;?></p>
<p>Age: <?php echo $age;?></p>
<p>email: <?php echo $email;?></p>
<p>Funness: <?php echo $funness;?></p>
<?php
    }
    ?>

</body>
</html>