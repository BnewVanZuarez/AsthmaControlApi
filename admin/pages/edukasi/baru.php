<?php
$error    = (isset($get['error']) ? $get['error'] : 0);
$reason   = (isset($get['reason']) ? $get['reason'] : "");
$id       = (isset($get['id']) ? $get['id'] : "");
$detailedu= array(
   'id'=>'',
   'slug'=>'',
   'writer'=>'',
   'judul'=>'',
   'gambar'=>'',
   'video'=>'',
   'detail'=>'',
);
if ($id != "") {
   $detailedu= Detail(array('id' => Escape($id)));
}

$edukasi_id = (isset($post['edukasi_id']) ? $post['edukasi_id'] : $detailedu['id']);
$judul      = (isset($post['judul']) ? $post['judul'] : $detailedu['judul']);
$video      = (isset($post['video']) ? $post['video'] : $detailedu['video']);
$detail     = (isset($post['detail']) ? $post['detail'] : $detailedu['detail']);

if (isset($post['simpan']) && $post['simpan'] == 'simpan') {

   if ($reason == "") {
      if ($edukasi_id != "") {
         if (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $edukasi_id)) ) {
            $error  = 2;
            $reason = "ID Edukasi Hanya Boleh Karakter:" . "\n" . "1) 0 sampai 9" . "\n";
         }
      }
   }

   if ($reason == "") {
      if ($judul == "") {
         $error  = 2;
         $reason = "Judul Edukasi Tidak Boleh Kosong !";
      }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $judul)) ) {
         $error  = 2;
         $reason = "Judul Edukasi Hanya Boleh Karakter:" . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9" . "\n" . "4)! @ #% * () - _ + =,. /? dan spasi";
      }
   }

   if ($reason == "") {
      if ($video == "") {
         $error  = 2;
         $reason = "Video Tidak Boleh Kosong !";
      }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $video)) ) {
         $error  = 2;
         $reason = "Video Hanya Boleh Karakter:" . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9" . "\n" . "4)! @ #% * () - _ + =,. /? dan spasi";
      }
   }

	if ($reason == "") {
		if ($files['gambar']['name'] != "") {

			$fileSize   = GetImageSize($files['gambar']['tmp_name']);
			$tipefile   = $files['gambar']['type'];
			$file_format= explode('.', $files['gambar']['name']);
			$file_format= strtolower(end($file_format));

			if ($files['gambar']['size'] > 2000000) {
				$error  = 2;
				$reason = "Ukuran Gambar Tidak Tidak Boleh Lebih Dari 2MB";
			}elseif (!in_array($tipefile, array('image/jpeg', 'image/pjpeg', 'image/png'))) {
				$error  = 2;
				$reason = "Gambar Tidak Valid. File Harus Berformat .JPG .JPEG .PNG";
			}
		}elseif ($files['gambar']['name'] == "") {
			$error  = 2;
			$reason = "Gambar Tidak Boleh Kosong";
		}
	}

   if ($reason == "") {
		$gambar = uploadGambar(array(
			'dir' => '../'.$global_upload_file.'edukasi/',
			'tmp_name' => $files['gambar']['tmp_name'],
			'nama' => CreateSlug($judul),
			'format' => $file_format
		));
      if ($edukasi_id != "") {
         $insert = Update(
            array(
               'writer' => Escape($login['nama_lengkap']),
               'slug' => CreateSlug($judul),
               'judul' => Escape($judul),
               'gambar' => Escape($gambar),
               'video' => Escape($video),
               'detail' => Escape($detail),
               'id' => Escape($edukasi_id),
            )
         );
      }else {
         $insert = Insert(
            array(
               'writer' => Escape($login['nama_lengkap']),
               'slug' => CreateSlug($judul),
               'judul' => Escape($judul),
               'gambar' => Escape($gambar),
               'video' => Escape($video),
               'detail' => Escape($detail),
               'tanggal_input' => date("Y-m-d H:i:s"),
            )
         );
      }
      if ($insert) {
         $error   = 1;
         $reason  = "Berhasil menyimpan Edukasi";
         header("location: ".$admin_base_url."index.php?pages=edukasi&sub_page=depan&error=".$error."&reason=".$reason);
      }else{
         $error   = 2;
         $reason  = "Gagal menyimpan data, silahkan coba lagi";
         header("location: ".$admin_base_url."index.php?pages=edukasi&sub_page=depan&error=".$error."&reason=".$reason);
      }
   }

}
?>
<?php include("pages/parts/header.php"); ?>
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0"><i class="bi bi-journal-richtext"></i> Edukasi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">Home</li>
                  <li class="breadcrumb-item">Edukasi</li>
                  <li class="breadcrumb-item active">Baru</li>
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
                     <h3 class="card-title"><i class="bi bi-journal-richtext"></i> Edukasi</h3>
                     <div class="card-tools">
                        <a href="<?=$admin_base_url?>index.php?pages=edukasi&sub_page=depan" class="btn bg-primary btn-sm"><i class="bi bi-backspace"></i> Kembali</a>
                     </div>
                  </div>
                  <div class="card-body">
                     <form action="" method="post" id="simpan" enctype="multipart/form-data">
                        <input type="hidden" name="edukasi_id" id="edukasi_id" value="<?=$edukasi_id?>">
                        <div class="form-group">
                           <label for="judul">Judul</label>
                           <input type="text" name="judul" id="judul" value="<?=$judul?>" class="form-control" placeholder="Judul Edukasi">
                        </div>
                        <div class="form-group">
                           <label for="video">Video Edukasi</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text">https://www.youtube.com/watch?v=</span>
                              </div>
                              <input type="text" name="video" id="video" value="<?=$video?>" class="form-control">
                           </div>
                        </div>
                        <div class="row">
                           <?php if ($detailedu['gambar'] != "") :?>
                              <div class="col">
                                 <img src="<?=$global_base_url.$global_upload_file?>edukasi/<?=$detailedu['gambar']?>" alt="<?=$detailedu['judul']?>" class="img img-fluid img-thumbnail">
                              </div>
                           <?php endif;?>
                           <div class="col">
                              <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3 mb-2">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                 </svg>
                                 <div>
                                    <h6 class="my-2">Unggah gambar pelatihan di sini, atau<a href="#!" class="text-primary"> Pilih</a></h6>
                                    <label style="cursor:pointer;">
                                       <span> 
                                          <input class="form-control stretched-link" type="file" name="gambar" id="gambar" accept="image/*" />
                                       </span>
                                    </label>
                                       <p class="small mb-0 mt-2"><b>Catatan:</b> Hanya JPG, JPEG dan PNG. Dimensi yang kami sarankan adalah 512px * 512px. Gambar yang lebih besar akan dipotong menjadi 4:3 agar sesuai dengan gambar mini/pratinjau kami.</p>
                                 </div>	
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="detail">Detail Edukasi</label>
                           <textarea name="detail" id="detail" class="summernote"><?=$detail?></textarea>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer">
                     <button type="submit" name="simpan" value="simpan" form="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
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
      window.history.replaceState(null, null, "<?=$admin_base_url?>index.php?pages=edukasi");
      setTimeout(function() {
         $('.alert').remove();
      }, 10000);
   <?php } ?>
</script>
</body>
</html>