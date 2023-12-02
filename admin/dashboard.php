<?php 
   session_start();

   if (!isset($_SESSION['user_id'])) {
       header("Location: ../admin/index.php");
       exit();
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php') ?>


  
<div class="container-fluid" id="main-content">
    <div class="row">
        <div class= "col-lg-10 ms-auto p-4 overflow-hidden">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta error harum sit vel, quasi repellendus nemo, accusamus distinctio, aut obcaecati aliquam dolorum. Praesentium quae a neque quo dolore nemo. Quae architecto laboriosam eius? Architecto reprehenderit dignissimos nam aperiam a quibusdam, numquam corporis, explicabo voluptatem, debitis eveniet possimus adipisci! Expedita sunt rem hic veniam adipisci quisquam cum ratione doloremque recusandae tenetur, consequatur vel nam officiis quo amet illum repellat quam magnam, quidem optio culpa mollitia velit architecto. Voluptate, esse veniam? Animi accusamus, numquam possimus esse ullam optio quis porro nihil quia commodi ut in? Assumenda veritatis voluptatem fugiat eaque alias at quod fuga, doloremque aliquid vel numquam est consequatur, molestiae eum quasi pariatur culpa excepturi explicabo voluptates vitae! Sed consequuntur quibusdam veritatis cumque hic! Quo, esse. Magni ut distinctio autem, tenetur id rerum laboriosam deleniti saepe illum culpa soluta sequi pariatur deserunt aspernatur? Nisi dolorem id ullam, eveniet rerum excepturi perferendis hic, ex quos explicabo doloremque, veritatis atque nam iure! Molestiae enim repellat modi aperiam. Animi qui, nesciunt laboriosam asperiores eos sint consectetur, fugit debitis minus harum aspernatur ut. Fugiat, fuga. Quae nobis quos ab architecto voluptates eius laudantium laboriosam rerum magnam tenetur, earum alias fugit, officiis sint. Quo, reprehenderit temporibus.

        </div>

    </div>
</div>
<?php require('inc/scripts.php'); ?>
</body>
</html>