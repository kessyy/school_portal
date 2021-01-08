<!DOCTYPE HTML>
<html>
<head>
    <title>School Portal</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">     

</head>
<body>
    <div class="container-fluid">
  
        <header class="page-header">
            <h1>Assignments</h1>
        </header>

<?php
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
//include database connection
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
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Course unit</td>
        <td><?php echo htmlspecialchars($course, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>instructions</td>
        <td><?php echo htmlspecialchars($instructions, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='home.php' class='btn btn-primary'>Back</a>
        </td>
    </tr>
</table>

    </div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 
</body>
</html>