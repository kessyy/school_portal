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
include 'config/database.php';
$action = isset($_GET['action']) ? $_GET['action'] : "";
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
// using prepared statements
$query = "SELECT id, course, instructions FROM work ORDER BY id ASC";
$stmt = $con->prepare($query);
$stmt->execute();
 
$num = $stmt->rowCount();

echo "<a href='create.php' class='btn btn-primary'>Add new assignment</a>";
if($num>0){
    //database table
    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Course Unit</th>";
        echo "<th>Instructions</th>";
        echo "<th>Take Action</th>";
    echo "</tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    extract($row);
    echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$course}</td>";
        echo "<td>{$instructions}</td>";
        echo "<td>";

            echo "<a href='single_assinment.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";
            echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";
            echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
        echo "</td>";
    echo "</tr>";
}
echo "</table>";
}
else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}
?>
    </div>
<script type='text/javascript'>
function delete_user( id ){
     var answer = confirm('Confirm delete action');
    if (answer){
        window.location = 'delete.php?id=' + id;
    } 
}  
</script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</body>
</html>