<?php 
require('inc/db_config.php');
require('inc/essentials.php');

session_start();

    if (!isset($_SESSION['user_id'])) {
      header("Location: ../admin/index.php");
      exit();
  }

    if(isset($_GET['xem'])) 
        {
        $frm_data = filteration($_GET);

        if($frm_data['xem']=='all'){
            $q = "UPDATE user_queries SET xem=?";
            $values = [1]; 
            if(update($q,$values,'i')){
                alert('success','marked all as read');
            }
            else{
                alert('error','Operation failded');
            }
        }
        else{
            $q = "UPDATE user_queries SET xem=? WHERE id=?";
            $values = [1,$frm_data['xem']]; 
            if(update($q,$values,'ii')){
                alert('success','marked as read');
            }
            else{
                alert('error','Operation failded');
            }
        }
        }

    if(isset($_GET['del'])) 
    {
    $frm_data = filteration($_GET);

    if($frm_data['del']=='all'){
        $q = "DELETE FROM user_queries" ;
        if(mysqli_query($con,$q)){
            alert('success','all data delete');
        }
        else{
            alert('error','Operation failded');
        }
    }
    else{
        $q = "DELETE FROM user_queries  WHERE id=?";
        $values = [$frm_data['del']]; 
        if(delete($q,$values,'i')){
            alert('success','data delete');
        }
        else{
            alert('error','Operation failded');
        }
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User Queries</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php') ?>


  
<div class="container-fluid" id="main-content">
    <div class="row">
        <div class= "col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">USER QUERIES</h3>
        <!-- CAROUSEL section -->
        <div class="card border-0 shadow-sm mb-4 ">
                <div class="card-body">
                    
                    <div class="text-end mb-4">
                        <a href="?xem=all" class='btn btn-dark rounded-pill shadow-none btn-sm'>
                        <i class="bi bi-check-all"></i> Mark all read

                        </a>
                        <a href="?del=all" class='btn btn-danger rounded-pill shadow-none btn-sm'>
                        <i class="bi bi-trash"></i> Delete all
                        </a>

                    </div>

                    <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                    <table class="table table-hover border">
                        <thead class="sticky-top">
                            <tr class="bg-dark text-light">
                            <th scope="col">#</th>
                            <th scope="col">Ten</th>
                            <th scope="col">Email</th>
                            <th scope="col" width="20%">subject</th>
                            <th scope="col" width="30%">TinNhan</th>
                            <th scope="col">Ngay</th>
                            <th scope="col">Acttion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $q = "SELECT * FROM user_queries ORDER BY 'id' DESC";
                            $data = mysqli_query($con,$q); 
                            $i=1;
                            while ($row = mysqli_fetch_assoc($data)) {
                                $xem='';
                                if($row['xem']!=1){
                                    $xem = "<a href='?xem=$row[id]' class='btn btn-sm rounded-pill btn-primary'>Mark as read</a> ";
                                }
                                $xem.= "<a href='?del=$row[id]' class='btn btn-sm rounded-pill btn-danger mt-2'>delete</a>";

                                echo<<<query
                                <tr>
                                <td>$i</td>
                                <td>$row[Ten]</td>
                                <td>$row[email]</td>
                                <td>$row[subject]</td>
                                <td>$row[TinNhan]</td>
                                <td>$row[Ngay]</td> 
                                <td>$xem</td> 
                                </tr>
                                query;
                                $i++; 
                            }
                            ?>                     
                        </tbody>
                        </table>
                    </div>                  
                        
                </div>
        </div>


        
      
        </div>
    </div>
</div>

<?php require('inc/scripts.php'); ?>


</body>
</html>