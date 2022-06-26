<?php 
$error    = (isset($get['error']) ? $get['error'] : 0);
$reason   = (isset($get['reason']) ? $get['reason'] : "");
?>
<?php include("pages/parts/header.php"); ?>
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0"><i class="fas fa-home"></i> Home</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active">Home</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <?php if ($error == "2") { ?>
                  <div class="alert alert-danger alert-dismissible" id="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                     <h5><i class="icon fas fa-ban"></i> Error!</h5>
                     <?=$reason?>
                  </div>
               <?php }elseif($error == "1"){ ?>
                  <div class="alert alert-success alert-dismissible" id="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                     <h5><i class="icon fas fa-check-circle"></i> Sukses!</h5>
                     <?=$reason?>
                  </div>
               <?php } ?>
            </div>
            <div class="col-12">
               <div class="jumbotron">
                  <h1 class="display-4">Selamat datang!</h1>
                  <p class="lead">Klik menu disamping kiri untuk memulai menggunakan aplikasi</p>
                  <hr class="my-4">
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<?php include("pages/parts/footer.php"); ?>
<script type="text/javascript">
   <?php if($error != 0){ ?>
      window.history.replaceState(null, null, "<?=$admin_base_url?>index.php?pages=home");
      setTimeout(function() {
         $('.alert').remove();
      }, 10000);
   <?php } ?>
</script>
</body>
</html>