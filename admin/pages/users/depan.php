<?php 
$error    = (isset($get['error']) ? $get['error'] : 0);
$reason   = (isset($get['reason']) ? $get['reason'] : "");
$data     = Daftar(array());

$users_id = (isset($post['users_id']) ? $post['users_id'] : "");
$nrp      = (isset($post['nrp']) ? $post['nrp'] : "");
$email    = (isset($post['email']) ? $post['email'] : "");
$password = (isset($post['password']) ? $post['password'] : "");
$nama_lengkap = (isset($post['nama_lengkap']) ? $post['nama_lengkap'] : "");
$no_telp = (isset($post['no_telp']) ? $post['no_telp'] : "");
$level   = (isset($post['level']) ? $post['level'] : "");
$status  = (isset($post['status']) ? $post['status'] : "");

if (isset($post['simpan']) && $post['simpan'] == 'simpan') {

   if ($reason == "") {
      if ($users_id != "") {
         if (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $users_id)) ) {
            $error  = 2;
            $reason = "Id User Hanya Boleh Karakter: 1) 0 sampai 9 ";
         }
      }
   }

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
      if ($nama_lengkap == "") {
         $error  = 2;
         $reason = 'Nama Lengkap Tidak Boleh Kosong !';
      }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $nama_lengkap)) ) {
         $error  = 2;
         $reason = "Nama Lengkap Hanya Boleh Karakter: 1) a sampai z 2) A sampai Z 3) 0 sampai 9 4)! @ #% * () - _ + =,. /? dan spasi";
      }
   }

   if ($reason == "") {
      if ($no_telp == "") {
         $error  = 2;
         $reason = 'No. Telp Tidak Boleh Kosong !';
      }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $no_telp)) ) {
         $error  = 2;
         $reason = "No. Telp Hanya Boleh Karakter: 1) 0 sampai 9 ";
      }
   }

   if ($reason == "") {
      if ($level == "") {
         $error  = 2;
         $reason = 'Level Tidak Boleh Kosong !';
      }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $level)) ) {
         $error  = 2;
         $reason = "Level Hanya Boleh Karakter: 1) 0 sampai 9 ";
      }
   }

   if ($reason == "") {
      if ($status == "") {
         $error  = 2;
         $reason = 'Status Tidak Boleh Kosong !';
      }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $status)) ) {
         $error  = 2;
         $reason = "Status Hanya Boleh Karakter: 1) 0 sampai 9 ";
      }
   }

   if ($reason == "") {
      if ($users_id != "") {
         $input = Update(
            array(
               'email' => Escape($email),
               'password' => password_hash($password, PASSWORD_DEFAULT),
               'nama_lengkap' => Escape($nama_lengkap),
               'no_telp' => Escape($no_telp),
               'level' => Escape($level),
               'status' => Escape($status),
               'id' => Escape($users_id)
            )
         );
      }else {
         $input = Insert(
            array(
               'email' => Escape($email),
               'password' => password_hash($password, PASSWORD_DEFAULT),
               'nama_lengkap' => Escape($nama_lengkap),
               'no_telp' => Escape($no_telp),
               'level' => Escape($level),
               'status' => Escape($status),
               'tanggal_input' => date("Y-m-d H:i:s")
            )
         );
      }
      if ($input) {
         $error   = 1;
         $reason  = "Berhasil menyimpan data";
         header("location: ".$admin_base_url."index.php?pages=users&sub_page=depan&error=".$error."&reason=".$reason);
      }else{
         $error   = 2;
         $reason  = "Gagal menyimpan data, silahkan coba lagi";
         header("location: ".$admin_base_url."index.php?pages=users&sub_page=depan&error=".$error."&reason=".$reason);
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
            <h5 class="modal-title" id="exampleModalLabel">Users</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="" method="post" id="simpan">
               <input type="hidden" name="users_id" id="users_id" value="">
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email">
               </div>
               <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password">
               </div>
               <div class="form-group">
                  <label for="nama_lengkap">Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Lengkap">
               </div>
               <div class="form-group">
                  <label for="no_telp">No. Telp</label>
                  <input type="number" name="no_telp" id="no_telp" class="form-control" placeholder="No. Telp">
               </div>
               <div class="form-group">
                  <label for="level">Level</label>
                  <select name="level" id="level" class="custom-select">
                     <option value="3">Pasien</option>
                     <option value="2">Admin</option>
                     <option value="1">Super Admin</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="custom-select">
                     <option value="1">Aktif</option>
                     <option value="2">Non-Aktif</option>
                  </select>
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
               <h1 class="m-0"><i class="bi bi-people-fill"></i> Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">Home</li>
                  <li class="breadcrumb-item active">Users</li>
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
                     <h3 class="card-title"><i class="bi bi-people-fill"></i> Users</h3>
                     <div class="card-tools">
                        <button type="button" class="btn bg-info btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah</button>
                     </div>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-sm table-bordered">
                        <thead>
                           <tr>
                              <th width="1%">No.</th>
                              <th width="1%" class="text-center"><i class="fas fa-pencil-alt"></i></th>
                              <th width="1%">Email</th>
                              <th>Nama Lengkap</th>
                              <th>No. Telp</th>
                              <th>Level</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $no = 1; ?>
                           <?php foreach ($data as $row) : ?>
                              <tr>
                                 <td><?=$no?></td>
                                 <td><a href="#" data-toggle="modal" data-target="#exampleModal" id="<?=$row['id']?>" class="view_data btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a></td>
                                 <td><?=$row['email']?></td>
                                 <td><?=$row['nama_lengkap']?></td>
                                 <td><?=$row['no_telp']?></td>
                                 <td><?=($row['level'] == 1 ? 'Super Admin' : ($row['level'] == 2 ? 'Admin' : ($row['level'] == 3 ? 'Pasien' : '')))?></td>
                                 <td><?=($row['status'] == 1 ? 'Aktif' : ($row['status'] == 2 ? 'Non-Aktif' : ''))?></td>
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
      window.history.replaceState(null, null, "<?=$admin_base_url?>index.php?pages=users");
      setTimeout(function() {
         $('.alert').remove();
      }, 10000);
   <?php } ?>
   $(document).ready(function(){

      $('.view_data').click(function(){
         var id = $(this).attr("id");
         $.ajax({
            url: '<?=$admin_base_url?>index.php?pages=users&sub_page=ajax',
            method: 'post',
            dataType: 'json',
            data: {
               id:id,
               aksi:'detail'
            },
            beforeSend: function() {
               $.LoadingOverlay("show");
               $("#alert").html('');
               $("#users_id").val('');
               $("#email").val('');
               $("#password").val('');
               $("#nama_lengkap").val('');
               $("#no_telp").val('');
               $("#level").val('');
               $("#status").val('');
            },
            success:function(data){
               console.log(data);
               if (data.status) {
                  if (data.info != '') {
                     $("#alert").html('<div class="alert alert-danger" role="alert">'+data.info+'</div>');
                  }else{
                     $("#users_id").val(data.data.id);
                     $("#email").val(data.data.email);
                     $("#nama_lengkap").val(data.data.nama_lengkap);
                     $("#no_telp").val(data.data.no_telp);
                     $("#level").val(data.data.level);
                     $("#status").val(data.data.status);
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