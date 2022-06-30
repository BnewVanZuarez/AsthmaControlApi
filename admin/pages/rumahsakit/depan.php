<?php 
$error    = (isset($get['error']) ? $get['error'] : 0);
$reason   = (isset($get['reason']) ? $get['reason'] : "");
$data     = Daftar(array());

$rs_id    = (isset($post['rs_id']) ? $post['rs_id'] : "");
$nama     = (isset($post['nama']) ? $post['nama'] : "");
$alamat   = (isset($post['alamat']) ? $post['alamat'] : "");
$longitude= (isset($post['longitude']) ? $post['longitude'] : "");
$latitude = (isset($post['latitude']) ? $post['latitude'] : "");

if (isset($post['simpan']) && $post['simpan'] == 'simpan') {

   if ($reason == "") {
      if ($rs_id != "") {
         if (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $rs_id)) ) {
            $error  = 2;
            $reason = "Id Rumah Sakit Hanya Boleh Karakter: 1) 0 sampai 9 ";
         }
      }
   }

   if ($reason == "") {
      if ($nama == "") {
         $error  = 2;
         $reason = 'Nama Rumah Sakit Tidak Boleh Kosong !';
      }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $nama)) ) {
         $error  = 2;
         $reason = "Nama Rumah Sakit Hanya Boleh Karakter: 1) a sampai z 2) A sampai Z 3) 0 sampai 9 4)! @ #% * () - _ + =,. /? dan spasi";
      }
   }

   if ($reason == "") {
      if ($alamat == "") {
         $error  = 2;
         $reason = 'Alamat Rumah Sakit Tidak Boleh Kosong !';
      }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $alamat)) ) {
         $error  = 2;
         $reason = "Alamat Rumah Sakit Hanya Boleh Karakter: 1) a sampai z 2) A sampai Z 3) 0 sampai 9 4)! @ #% * () - _ + =,. /? dan spasi";
      }
   }

   if ($reason == "") {
      if ($longitude == "") {
         $error  = 2;
         $reason = 'Longitude Tidak Boleh Kosong !';
      }elseif (!stringAllow(array("where" => "/^[0-9\-\.]*$/", "text" => $longitude)) ) {
         $error  = 2;
         $reason = "Longitude Hanya Boleh Karakter: 1) 0 sampai 9 2) - .  ";
      }
   }

   if ($reason == "") {
      if ($latitude == "") {
         $error  = 2;
         $reason = 'Lattude Tidak Boleh Kosong !';
      }elseif (!stringAllow(array("where" => "/^[0-9\-\.]*$/", "text" => $latitude)) ) {
         $error  = 2;
         $reason = "Lattude Hanya Boleh Karakter: 1) 0 sampai 9 2) - .  ";
      }
   }

   if ($reason == "") {
      if ($rs_id != "") {
         $input = Update(
            array(
               'nama' => Escape($nama),
               'alamat' => Escape($alamat),
               'longitude' => Escape($longitude),
               'latitude' => Escape($latitude),
               'id' => Escape($rs_id)
            )
         );
      }else {
         $input = Insert(
            array(
               'nama' => Escape($nama),
               'alamat' => Escape($alamat),
               'longitude' => Escape($longitude),
               'latitude' => Escape($latitude),
            )
         );
      }
      if ($input) {
         $error   = 1;
         $reason  = "Berhasil menyimpan data";
         header("location: ".$admin_base_url."index.php?pages=rumahsakit&sub_page=depan&error=".$error."&reason=".$reason);
      }else{
         $error   = 2;
         $reason  = "Gagal menyimpan data, silahkan coba lagi";
         header("location: ".$admin_base_url."index.php?pages=rumahsakit&sub_page=depan&error=".$error."&reason=".$reason);
      }
   }

}
?>
<?php include("pages/parts/header.php"); ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Rumah Sakit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="" method="post" id="simpan">
               <input type="hidden" name="rs_id" id="rs_id" value="">
               <div class="form-group">
                  <label for="nama">Nama Rumah Sakit</label>
                  <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Rumah Sakit">
               </div>
               <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat">
               </div>
               <div class="form-group">
                  <label for="longitude">Longitude</label>
                  <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Longitude">
               </div>
               <div class="form-group">
                  <label for="latitude">Latitude</label>
                  <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Latitude">
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
            <button type="submit" name="simpan" form="simpan" value="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
         </div>
      </div>
   </div>
</div>
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0"><i class="bi bi-hospital-fill"></i> Rumah Sakit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">Home</li>
                  <li class="breadcrumb-item active">Rumah Sakit</li>
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
                     <h3 class="card-title"><i class="bi bi-hospital-fill"></i> Rumah Sakit</h3>
                     <div class="card-tools">
                        <button type="button" class="btn bg-info btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah</button>
                     </div>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-sm table-bordered">
                        <thead>
                           <tr>
                              <th width="1%">No.</th>
                              <th width="1%" class="text-center"><i class="fas fa-map-marked"></i></th>
                              <th width="1%" class="text-center"><i class="fas fa-pencil-alt"></i></th>
                              <th>Nama Rumah Sakit</th>
                              <th>Alamat</th>
                              <th>Longitude</th>
                              <th>Latitude</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $no = 1; ?>
                           <?php foreach ($data as $row) : ?>
                              <tr>
                                 <td><?=$no?></td>
                                 <td><a target="_blank" href="https://www.google.com/maps/search/<?=$row['latitude']?>,<?=$row['longitude']?>" class="btn btn-sm btn-primary"><i class="fas fa-map-marked"></i></a></td>
                                 <td><a href="#" data-toggle="modal" data-target="#exampleModal" id="<?=$row['id']?>" class="view_data btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a></td>
                                 <td><?=$row['nama']?></td>
                                 <td><?=$row['alamat']?></td>
                                 <td><?=$row['longitude']?></td>
                                 <td><?=$row['latitude']?></td>
                              </tr>
                              <?php $no++; ?>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
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
      window.history.replaceState(null, null, "<?=$admin_base_url?>index.php?pages=rumahsakit");
      setTimeout(function() {
         $('.alert').remove();
      }, 10000);
   <?php } ?>
   $(document).ready(function(){

      $('.view_data').click(function(){
         var id = $(this).attr("id");
         $.ajax({
            url: '<?=$admin_base_url?>index.php?pages=rumahsakit&sub_page=ajax',
            method: 'post',
            dataType: 'json',
            data: {
               id:id,
               aksi:'detail'
            },
            beforeSend: function() {
               $.LoadingOverlay("show");
               $("#alert").html('');
               $("#rs_id").val('');
               $("#nama").val('');
               $("#alamat").val('');
               $("#longitude").val('');
               $("#latitude").val('');
            },
            success:function(data){
               console.log(data);
               if (data.status) {
                  if (data.info != '') {
                     $("#alert").html('<div class="alert alert-danger" role="alert">'+data.info+'</div>');
                  }else{
                     $("#rs_id").val(data.data.id);
                     $("#nama").val(data.data.nama);
                     $("#alamat").val(data.data.alamat);
                     $("#longitude").val(data.data.longitude);
                     $("#latitude").val(data.data.latitude);
                  }
               }
               $.LoadingOverlay("hide");
            },
            error:function(){
               $.LoadingOverlay("hide");
            }
         });
      });
      
   });
</script>
</body>
</html>