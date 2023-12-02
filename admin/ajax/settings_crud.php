<?php 
     require('../inc/db_config.php');
     require('../inc/essentials.php');
     adminLogin();
   
   

   
   if(isset($_POST['get_general'])) 
   {
        $q = "SELECT * FROM settings WHERE id=?";
        $values = [1]; 
        $res = select($q,$values,"i");
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;      
   }

  if(isset($_POST['upd_general'])) 
   {
    $frm_data = filteration($_POST);
        $q = "UPDATE settings SET site_title=?, site_about=? WHERE id=?";
        $values = [$frm_data['site_title'],$frm_data['site_about'],1]; 
        $res = update($q,$values,'ssi');
        echo $res;
 
   }



  if(isset($_POST['upd_shutdown'])) 
   {
    $frm_data = ($_POST['upd_shutdown']==0) ? 1 : 0;
      $q = "UPDATE settings SET shutdown=? WHERE id=?";
      $values = [$frm_data,1]; 
      $res = update($q,$values,'ii');
      echo $res;
 
   }


  if(isset($_POST['get_contacts'])) 
   {
      $q = "SELECT * FROM contact_details WHERE id=?";
      $values = [1]; 
      $res = select($q,$values,"i");
      $data = mysqli_fetch_assoc($res);
      $json_data = json_encode($data);
      echo $json_data;      
   }

  if(isset($_POST['upd_contacts'])) 
   {
      $frm_data = filteration($_POST);
        $q = "UPDATE contact_details SET DiaChi=?, BanDo=?, sdt1=?, sdt2=?, email=?, fb=?, insta=?, tw=?, iframe=? WHERE id=?";
        $values = [$frm_data['DiaChi'],$frm_data['BanDo'],$frm_data['sdt1'],$frm_data['sdt2'],$frm_data['email'],$frm_data['fb'],$frm_data['insta'],$frm_data['tw'],$frm_data['iframe'],1]; 
        $res = update($q,$values,'sssssssssi');
        echo $res;
   }
   

  if(isset($_POST['add_member'])) 
   {
      $frm_data = filteration($_POST);

      $img_r = uploadImage($_FILES['picture'],ABOUT_FOLDER);
    
      if($img_r == 'inv_img'){
        echo $img_r;
      }
      else if($img_r == 'inv_size'){
        echo $img_r; 
      }
      else if($img_r == 'upd_failed'){
        echo $img_r; 
      }
      else{
        $q = "INSERT INTO `team_details`(`name`, `picture`)  VALUES (?,?)";
        $values = [$frm_data['name'],$img_r];
        $res = insert($q,$values,'ss');
        echo $res;
      }
   }

  if(isset($_POST['get_members'])) 
   {
    $res = selectAll('team_details');
    
    while($row = mysqli_fetch_assoc($res))
      {
        $path = ABOUT_IMG_PATH;
        echo <<< data
          <div class="col-md-2 mb-3">
          <div class="card bg-dark text-white">
               <img src="$path$row[picture]" class="card-img">
              <div class="card-img-overlay text-end">
                  <button type="button" onclick="rem_member($row[id])" class="btn btn-danger btn-sm shadow-none">
                      <i class="bi bi-trash"></i> Delete
                  </button>                                    
              </div>
              <p class="card-text text-center px-3 py-2">$row[name]</p>
              </div>
          </div>
        data;
      } 
   }
    
   if (isset($_POST['rem_member'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_member']];

    // Fetch the team member details
    $pre_q = "SELECT * FROM team_details WHERE id=?";
    $res = select($pre_q, $values, 'i');
    $teamMember = mysqli_fetch_assoc($res);

    // Delete the associated image
    if (deleteImage($teamMember['picture'], ABOUT_FOLDER)) {
        // Delete the team member from the database
        $q = "DELETE FROM team_details WHERE id=?";
        $types = 'i'; // Assuming 'id' is an integer; adjust if necessary

        $res = delete($q, $values, $types);

        if ($res) {
            echo 1; // Success
        } else {
            echo 0; // Database deletion failed
        }
    } else {
        echo 0; // Image deletion failed
    }
}



?>