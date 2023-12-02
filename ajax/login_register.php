<?php 
    require('../admin/inc/db_config.php');
    require('../admin/inc/essentials.php');
    require("../inc/sendgrid/sendgrid-php.php");
   
    function send_mail($uemail, $ten, $token)
{
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("SENDGRID_EMAIL", "SENDGRID_NAME");
    $email->setSubject("Account verification link");

    $email->addTo($uemail, $ten);

    $email->addContent(
        "text/html",
        "
        click the link to confirm your email: <br>
        <a href='" . SITE_URL . "email_confirm.php?email_confirmation&email=$uemail&token=$token" . "'>
        CLICK ME
        </a>
        "
    );

    $sendgrid = new \SendGrid(SENDGRID_API_KEY);

    try {
        $sendgrid->send($email);
        return 1;
    } catch (\Exception $e) {
        // Log the complete exception information
        error_log('Mail failed with error: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
        return 0;
    }
}



    if(isset($_POST['register'])) 
    {
      $data = filteration($_POST);

        //match password and confirm password field
      if($data['matkhau'] != $data['xacnhanmk']){
        echo 'pass_mismatch';
        exit;
      }
      //check user exists or not
      $u_exist= select("SELECT * FROM user_cred WHERE email=? OR sdt=? LIMIT 1",[$data['email'],$data['sdt']],"ss");

      if(mysqli_num_rows($u_exist)!=0){
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'sdt_already';
        exit;
      }
  
      //upload user image to server
      $img = uploadUserImage($_FILES['anh']);
      
      if($img == 'inv_img'){
        echo 'inv_img'; 
        exit;
      }
      else if ($img == 'upd_failed'){
        echo 'upd_failed'; 
        exit;
      }



      // send confirmation link to user's email
      $token = bin2hex(random_bytes(16));
      if(!send_mail($data['email'],$data['ten'],$token)){
        echo 'mail_failed';
        exit;

      }

      $enc_pass = password_hash($data['matkhau'],PASSWORD_BCRYPT);

      $query="INSERT INTO user_cred( ten, email, diachi, sdt, mapin, ngaysinh, anh, matkhau, token) 
      VALUES (?,?,?,?,?,?,?,?,?)";

      $values= [$data['ten'],$data['email'],$data['diachi'],$data['sdt'],$data['mapin'],$data['ngaysinh'],$img,$enc_pass,$token];

      if(insert($query,$values,'ssssissss')){
        echo 1;

      }
      else{
        echo 'ins_failed';
      }



    }
?>