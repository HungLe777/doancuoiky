<?php


define('SITE_URL','http://127.0.0.1/doancuoiky/');
define('ABOUT_IMG_PATH',SITE_URL.'images/about/');
define('CAROUSEL_IMG_PATH',SITE_URL.'images/carousel/');
define('FACILITIES_IMG_PATH',SITE_URL.'images/facilities/');
define('ROOMS_IMG_PATH',SITE_URL.'images/rooms/');
define('USERS_IMG_PATH',SITE_URL.'images/users/');


//backend upload process needs this data


define('UPLOAD_IMAGE_PATH', 'C:/xampp/htdocs'.'/doancuoiky/images/');
define('ABOUT_FOLDER','about/');
define('CAROUSEL_FOLDER','carousel/');
define('FACILITIES_FOLDER','facilities/');
define('ROOMS_FOLDER','rooms/');
define('USERS_FOLDER','users/');

//sendgrid api key
define('SENDGRID_API_KEY',"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    ");
define('SENDGRID_EMAIL',"congchinh0e@gmail.com");
define('SENDGRID_NAME',"hungle");


function adminLogin()
{
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../admin/index.php");
        exit();
    }
    // session_regenerate_id(true);
}




function redirect($url){
    echo"<script>
        window.location.href='$url';
        </script>";
        exit;
}

function alert($type,$msg) {
   
   $bs_class =($type =="success") ? "alert-success" : "alert-danger";
    
   echo <<<alert
        <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">$msg</strong>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    alert;
}

function uploadImage($image, $folder)
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    } else if (($image['size'] / (1024 * 1024)) > 2) {
        return 'inv_size';
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . rand(11111, 99999) . ".$ext";
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

        // C:/xampp/htdocs/doancuoiky/images/about/$rname
        if (!move_uploaded_file($image['tmp_name'], $img_path)) {
            return 'upd_failed';
        } else {
            return $rname;
        }
    }
}



function deleteImage($image, $folder)
{
    $imagePath = UPLOAD_IMAGE_PATH . $folder . $image;

    if (file_exists($imagePath)) {
        if (unlink($imagePath)) {
            return true;
        } else {
            return false;
        }
    } else {
        // File does not exist
        return false;
    }
}


function uploadSVGImage($image,$folder)
{
    $valid_mime = ['image/svg+xml'];
    $img_mime = $image['type'];
    
    if(!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    }
    else if(($image['size']/(1024*1024)) >1){
        return 'inv_size';
    }
    else{
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);    
        $rname = 'IMG_'.random_int(11111,99999).".$ext";
        $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
        if (!move_uploaded_file($image['tmp_name'], $img_path)) {
            return 'upd_failed';
        } else {
            return $rname;
        }
    }
}

function uploadUserImage($image)
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    } 
    else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111,99999) . ".jpeg";
        
        $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER. $rname;

        if($ext == 'png' || $ext == 'PNG'){
            $img = imagecreatefrompng($image['tmp_name']);  
        }
        else if($ext == 'webp' || $ext == 'WEBP'){
            $img = imagecreatefromwebp($image['tmp_name']);  
        }
        else{
            $img = imagecreatefromjpeg($image['tmp_name']);  
        }

        if (imagejpeg($img,$img_path,75)) {
            return $rname;
        } else {
            return 'upd_failed';
        }
    }
}

?>