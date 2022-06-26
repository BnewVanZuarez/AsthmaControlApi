<?php
$error    = (isset($get['error']) ? $get['error'] : 0);
$reason   = (isset($get['reason']) ? $get['reason'] : "");

$email    = (isset($post['email']) ? $post['email'] : "");
$password = (isset($post['password']) ? $post['password'] : "");

if (isset($post['masuk']) && $post['masuk'] == 'masuk') {

	if ($reason == "") {
		if ($email == "") {
			$error  = 2;
			$reason = "Email Tidak Boleh Kosong";
		}elseif (!stringAllow(array("where" => "/^[a-z0-9\@\.\-\_]*$/", "text" => $email)) ) {
			$error  = 2;
			$reason = "Email hanya boleh karakter : " . "\n" . "1) a sampai z" . "\n" . "2) 0 sampai 9" . "\n" . "4) @ . - _";
		}
	}

	if ($reason == "") {
		if ($password == "") {
			$error  = 2;
			$reason = "Password Tidak Boleh Kosong";
		}
	}

	if ($reason == "") {
		$cek_login = Login(array('email' => $email));
		if (count($cek_login) > 0) {
               
         if ($cek_login['status'] == "1") {

            if (password_verify($password, $cek_login['password'])) {
               $hash = md5(rand(100000, 9999999));
               $upd_hash = UpdateHash(array('email' => Escape($cek_login['email']), 'hash' => Escape($hash)));
               if ($upd_hash) {
                  $_SESSION = array(
                     'auth' => array(
                        'email' => $email,
                        'hash' => $hash
                     )
                  );
                  header("location: ".$admin_base_url."index.php?pages=home");
                  
               }else{
                  $error  = 2;
                  $reason = "Terjadi kesalahan, silahkan hubungi Admin !";
               }
            }else{
               $error  = 2;
               $reason = "Password yang anda masukkan salah atau tidak cocok, silahkan coba lagi !";
            }

         }else {
            $error  = 2;
            $reason = "Akun anda tidak aktif atau tidak diizinkan untuk login, silahkan hubungi admin untuk informasi lebih lanjut !";
         }

      }else {
			$error  = 2;
			$reason = "Email yang anda masukkan salah atau tidak cocok, silahkan coba lagi !";
      }
	}

}
?>
<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="AsthmaControl">
	<meta name="author" content="Ibnu Raffi - ellastistunasmandiri@gmail.com">
	<title>Dashboard | AsthmaControl</title>
	<link rel="shortcut icon" href="<?=$admin_base_url?>assets/img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=$admin_base_url?>assets/img/favicon.ico" type="image/x-icon">
	<meta property="og:title" content="AsthmaControl">
	<meta property="og:site_name" content="AsthmaControl">
	<meta property="og:url" content="<?=$admin_base_url?>">
	<meta property="og:description" content="AsthmaControl">
	<meta property="og:type" content="website">
	<meta property="og:image" content="https://cdn.statically.io/og/AsthmaControl.png">
   <link rel="stylesheet" href="https://fontbit.io/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <script src="https://kit.fontawesome.com/ac3e39d20d.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
   <div class="login-box">
      <div class="card card-outline card-primary">
         <div class="card-header text-center">
            <a href="<?=$admin_base_url?>" class="h1">
               <b>Asthma</b>Control
            </a>
         </div>
         <div class="card-body">
            <?php if ($error == "2") { ?>
               <div class="alert alert-danger alert-dismissible" id="alert">
                  <h5><i class="icon fas fa-ban"></i> Error!</h5>
                  <?=$reason?>
               </div>
            <?php }elseif ($error == "1") { ?>
               <div class="alert alert-success alert-dismissible" id="alert">
                  <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                  <?=$reason?>
               </div>
            <?php } ?>
            <p class="login-box-msg">Silahkan masuk untuk memulai sesi anda</p>
            <form action="" method="post" id="masuk">
               <div class="input-group mb-3">
                  <input type="email" name="email" id="email" value="<?=$email?>" class="form-control" placeholder="Email">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                     </div>
                  </div>
               </div>
               <div class="input-group mb-3">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-8"></div>
                  <div class="col-4">
                     <button type="submit" name="masuk" value="masuk" form="masuk" class="btn btn-primary btn-block">Masuk</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
	<script type="text/javascript">
		<?php if($error != 0){ ?>
			window.history.replaceState(null, null, "<?=$admin_base_url?>index.php?pages=auth");
			setTimeout(function() {
				$('.alert').remove();
			}, 10000);
		<?php } ?>
	</script>
</body>
</html>