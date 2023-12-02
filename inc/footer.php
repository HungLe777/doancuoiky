<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r['site_title'] ?></h3>
            <p>
            <?php echo $settings_r['site_about'] ?>

            </p>
        </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Links</h5> 
                <a href="index.php" class="d-line-block mb-2 text-dark text-decoration-none">Trang chủ</a> <br> 
                <a href="rooms.php" class="d-line-block mb-2 text-dark text-decoration-none">Phòng</a> <br> 
                <a href="facilities.php" class="d-line-block mb-2 text-dark text-decoration-none">Cơ sở</a> <br> 
                <a href="contact.php" class="d-line-block mb-2 text-dark text-decoration-none">Liên hệ</a> <br> 
                <a href="about.php" class="d-line-block mb-2 text-dark text-decoration-none">Giới thiệu</a> <br> 
            </div>
            <div class="col-lg-4 p-4">
            <h5 class="mb-3">Follow us</h5>
            <?php 
            if($contact_r['tw']!='')
            {
                echo<<<data
                    <a href="$contact_r[tw]>" class="d-inline-block text-dark text-decoration-none mb-2">
                    <i class="bi bi-twitter me-1"></i> Twitter   
                    </a><br>
                data;
            }
            ?>
            
            <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark text-decoration-none mb-2">
                <i class="bi bi-facebook me-1"></i> Facebook   
                </a><br>
            <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark text-decoration-none">
                <i class="bi bi-instagram me-1"></i> Instagram  
                </a><br>    
            </div>
        </div>
</div>

    <h6 class="text-center bg-dark text-white p-3 m-0">Lê Trang Hưng - 08_ĐH_THMT</h6>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>

    function alert(type,msg,position='body')
    {
        let bs_class =(type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
            <strong class="me-3">${msg}</strong>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        `;

        if(position=='body'){
            document.body.append(element);
            element.classList.add('custom-alert');
        }
        else{
            document.getElementById(position).appendChild(element);
        }
        
        setTimeout(remAlert, 3000);
    }

    function remAlert()
    {
        document.getElementsByClassName('alert')[0].remove();
    }

    function setActive()
    {
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');

        for(i=0; i<a_tags.length; i++)
        {
            let file =a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if(document.location.href.indexOf(file_name) >= 0){
                a_tags[i].classList.add('active');
            }
        }

    }

    let register_form =document.getElementById('register-form');

    register_form.addEventListener('submit',function(e){
    e.preventDefault();
    
    let data = new FormData();

    data.append('ten',register_form.elements['ten'].value);
    data.append('email',register_form.elements['email'].value);
    data.append('sdt',register_form.elements['sdt'].value);
    data.append('diachi',register_form.elements['diachi'].value);
    data.append('mapin',register_form.elements['mapin'].value);
    data.append('ngaysinh',register_form.elements['ngaysinh'].value);
    data.append('matkhau',register_form.elements['matkhau'].value);
    data.append('xacnhanmk',register_form.elements['xacnhanmk'].value);
    data.append('anh',register_form.elements['anh'].files[0]);
    data.append('register','');
    
    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload =function(){
        if(this.responseText == 'pass_mismatch'){
            alert('error',"password mismatch ");
        } 
        else if(this.responseText == 'email_already'){
            alert('error',"Email is already registed ");
        } 
        else if(this.responseText == 'sdt_already'){
            alert('error',"sdt is already registed ");
        } 
        else if(this.responseText == 'inv_img'){
            alert('error',"image uoload registed ");
        } 
        else if(this.responseText == 'upd_failed'){
            alert('error',"image uoload failed ");
        } 
        else if(this.responseText == 'mail_failed'){
            alert('error',"cannot send confirmation email! server down ");
        } 
        else if(this.responseText == 'ins_failed'){
            alert('error',"registration faild! server down");
        } 
        else{
            alert('success',"registration successful. confirmation link send to email");
            register_form.reset();
        }
       
    }
    xhr.send(data);
    });




    
    setActive();
    </script>