<?php 
$error    = (isset($get['error']) ? $get['error'] : 0);
$reason   = (isset($get['reason']) ? $get['reason'] : "");

$url_paging = isset($get['paging']) ? $get['paging'] : '';
$paging     = (int) (empty($url_paging) ? 1 : $url_paging);
$startpoint = ($paging * $global_limit) - $global_limit;
$data       = Daftar(array('startpoint' => $startpoint));
$data_rows  = DaftarNumRows(array());
$paging     = pagination($data_rows, $global_limit, $paging, $admin_base_url . 'index.php?pages=rencana&sub_page=depan&');

?>
<?php include("pages/parts/header.php"); ?>
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0"><i class="bi bi-file-earmark-ruled-fill"></i> Rencana Aksi Asma</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">Home</li>
                  <li class="breadcrumb-item active">Rencana Aksi Asma</li>
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
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title"><i class="bi bi-file-earmark-ruled-fill"></i> Rencana Aksi Asma</h3>
                  </div>
                  <div class="card-body table-responsive p-0">
                     <table class="table table-hover table-striped">
                        <thead class="table-dark">
                           <tr>
                              <th width="1%">No.</th>
                              <!-- <th width="1%" class="text-center"><i class="bi bi-pencil"></i></th> -->
                              <th>Nama Lengkap</th>
                              <th>Nama Dokter</th>
                              <th>No. Telp Dokter</th>
                              <th>Kontak Darurat</th>
                              <th>No. Telp Kontak Darurat</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if (count($data) > 0): ?>
                              <?php $no = 1; ?>
                              <?php foreach ($data as $row) : ?>
                                 <tr style="vertical-align: middle;">
                                    <td><?=$no?></td>
                                    <!-- <td><a href="<?//=$admin_base_url?>index.php?pages=rencana&sub_page=edit&id=<?//=$row['id']?>" class="btn bg-warning btn-sm"><i class="bi bi-pencil"></i></a></td> -->
                                    <td><?=$row['nama_lengkap']?></td>
                                    <td><?=$row['nama_dokter']?></td>
                                    <td><?=$row['telp_dokter']?></td>
                                    <td><?=$row['kontak_darurat']?></td>
                                    <td><?=$row['telp_darurat']?></td>
                                 </tr>
                                 <?php $no++; ?>
                              <?php endforeach; ?>
                           <?php else: ?>
                              <tr>
                                 <td colspan="7" class="text-center mailbox-subject">Tidak Ada Data !</td>
                              </tr>
                           <?php endif; ?>
                        </tbody>
                     </table>
                  </div>
                  <div class="card-footer">
                     <?=$paging?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<?php include("pages/parts/footer.php"); ?>
<script type="text/javascript">
   <?php if($error != 0){ ?>
      window.history.replaceState(null, null, "<?=$admin_base_url?>index.php?pages=rencana");
      setTimeout(function() {
         $('.alert').remove();
      }, 10000);
   <?php } ?>
</script>
</body>
</html>