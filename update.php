<!DOCTYPE HTML>
<html>
<head>
    <title>School portal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">     
     
</head>
<body>
    <div class="container-fluid">  
        <header class="page-header">
            <h1>Edit assigment</h1>
        </header>
<?php

$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
include 'config/database.php';
try {

    $query = "SELECT id, course, instructions FROM work WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
     
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    $course = $row['course'];
    $instructions = $row['instructions'];
}

catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
  <?php
 if($_POST){
      
     try{
         $query = "UPDATE work SET course=:course, instructions=:instructions WHERE id = :id";

         $stmt = $con->prepare($query);
         $course=htmlspecialchars(strip_tags($_POST['course']));
         $instructions=htmlspecialchars(strip_tags($_POST['instructions']));
         $stmt->bindParam(':course', $course);
         $stmt->bindParam(':instructions', $instructions);
         $stmt->bindParam(':id', $id);
         if($stmt->execute()){
             echo "<div class='alert alert-success'>Record was updated.</div>";
         }else{
             echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
         }
          
     }
     catch(PDOException $exception){
         die('ERROR: ' . $exception->getMessage());
     }
 }
 ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Course</td>
            <td><input type='text' name='course' value="<?php echo htmlspecialchars($course, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>instructions</td>
            <td><textarea name='instructions' class='form-control'><?php echo htmlspecialchars($instructions, ENT_QUOTES);  ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='home.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
       
    </div>
     
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</body>
</html>