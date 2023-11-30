<?php



error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/Autoloader.php';
Autoloader::register();
require_once __DIR__ . '/config/localConnect.php';
require_once __DIR__ . '/src/Models/Connection.php';
require_once __DIR__ . '/src/Models/TableManager.php';


use EventsCalendar\Models\Connection;

try {
    $conn = Connection::getDBConnection();

} catch (\PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    

    <script src="src/scripts/main-scripts.js"></script>
    <link rel="stylesheet" href="src/styles/styles.css">
</head>
<body>
<div class="container">
<h1>Events planner</h1>

<div class="row">
   <?php include 'src/views/events-table-output.php'; ?> 
</div>

<h3 class="mt-5">You can add new events here</h3>
<div class="row mt-5">
<div class="col-md-6">
<?php include 'src/views/form-events.php'; ?>
</div>
<div class="col-sm-6 form-wrapper mt-5">
<div class="border border-info p-3 rounded-3">
<p>If you don't already have a table for records, you can create one right now</p>

<button id="checkTableButton" class="btn btn-info">Create Table</button>
</div>
</div>

</div>










</div>
<script>

    var BASE_URL = '<?php echo BASE_URL; ?>';
    document.getElementById('checkTableButton').addEventListener('click', function() {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log('Server Response:', xhr.responseText);
                alert(xhr.responseText);
            } else {
                console.error('Error during AJAX request. Status: ' + xhr.status + ', Response: ' + xhr.responseText);
            }
        }
    };

    
    console.log('BASE_URL:', BASE_URL);

    var controllerPath = 'src/Controllers/CheckTableExistController.php';
    var fullUrl = BASE_URL + '/' + controllerPath;

    xhr.open('GET', fullUrl, true);
    xhr.send();
});

</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>


