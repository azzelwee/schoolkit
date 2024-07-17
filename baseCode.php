<?php

if ( !isset( $_SESSION ) ) {
    session_start();
}

$is_admin = ( isset( $_SESSION[ 'Access' ] ) && $_SESSION[ 'Access' ] == 'administrator' );

include_once( 'connections/connection.php' );
$con = connection();

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Reports</title>
    <link rel='stylesheet' href='css/style.css'>
</head>

<body id="<?php echo $id ?>">

    <?php include 'header.php';
?>

    <div class='right-container'>
        <div class='box-container'>
            <h2>Title Here</h2>
            <div class='gauge-line'></div>






        </div>
    </div>

</body>
<script src="js/main.js"></script>

</html>