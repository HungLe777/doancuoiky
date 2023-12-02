<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Merienda:wght@500;600&family=Poppins:ital,wght@0,300;1,300;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="css/common.css">

<?php 
    require('admin/inc/db_config.php');
    require('admin/inc/essentials.php');
    
    $contact_q = "SELECT * FROM contact_details WHERE id=?";
    $settings_q = "SELECT * FROM settings WHERE id=?";

    $values =[1];
    $contact_r = mysqli_fetch_assoc(select($contact_q, $values,'i'));
    $settings_r = mysqli_fetch_assoc(select($settings_q, $values,'i'));

?> 
