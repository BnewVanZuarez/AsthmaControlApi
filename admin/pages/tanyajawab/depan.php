<?php
$error    = (isset($get['error']) ? $get['error'] : 0);
$reason   = (isset($get['reason']) ? $get['reason'] : "");
$chats_id = (isset($get['chats_id']) ? $get['chats_id'] : "");

$url_paging = isset($get['paging']) ? $get['paging'] : '';
$paging     = (int) (empty($url_paging) ? 1 : $url_paging);
$startpoint = ($paging * $global_limit) - $global_limit;
$data       = Daftar(array('startpoint' => $startpoint));
$data_rows  = DaftarNumRows(array());
$paging     = pagination($data_rows, $global_limit, $paging, $admin_base_url . 'index.php?pages=tanyajawab&sub_page=depan&chats_id='.$chats_id.'&');

$detail     = array(
   'id' => "",
   'users_id' => "Forum",
   'nama' => "",
   'admin_id' => "",
   'no_tiket' => "Chats",
   'perihal' => "",
   'status' => "",
   'tanggal_input' => "",
);
$reply = array();
if ($chats_id != "") {
   $detail = Detail(array('id' => Escape($chats_id)));
   $reply = DaftarReply(array('tj_id' => Escape($chats_id)));
}

$reply_txt = (isset($post['reply']) ? $post['reply'] : "");

if (isset($post['balas']) && $post['balas'] == 'balas') {

	if ($reason == '') {
		if ($reply_txt == '') {
			$error  = 2;
			$reason = "Pesan Tidak Boleh Kosong";
		}elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $reply_txt)) ) {
			$error  = 2;
			$reason = "Pesan hanya boleh karakter : " . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9" . "\n" . "4) ! @ # % * ( ) - _ + = , . / ? dan spasi";
		}
	}

	if ($reason == '') {
      $insert = InsertReply(
         array(
            'tj_id' => Escape($chats_id),
            'pesan' => Escape($reply_txt),
            'tipe' => Escape("2"),
            'read' => Escape("2"),
            'tanggal_input' => date("Y-m-d H:i:s"),
         )
      );
      if ($insert) {
			$error  = 1;
			$reason = "Berhasil mengirim pesan";
			header("location: ".$admin_base_url."index.php?pages=tanyajawab&chats_id=".$chats_id."&error=".$error."&reason=".$reason);
      }else {
			$error  = 2;
			$reason = "Gagal mengirim pesan";
			header("location: ".$admin_base_url."index.php?pages=tanyajawab&chats_id=".$chats_id."&error=".$error."&reason=".$reason);
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
               <h1 class="m-0"><i class="fas fa-envelope"></i> Chats</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">Home</li>
                  <li class="breadcrumb-item active">Chats</li>
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
            <div class="col-12 col-sm-12 col-md-6">
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title"><i class="fas fa-envelope"></i> Chats</h3>
                  </div>
                  <div class="card-body p-0">
                     <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                           <tbody>
                              <?php if (empty($data)) { ?>
                                 <tr>
                                    <td colspan="3" class="text-center">Tidak ada data</td>
                                 </tr>
                              <?php }else{ ?>
                                 <?php $no = 1; ?>
                                 <?php foreach ($data as $row) { ?>
                                    <tr>
                                       <td class="mailbox-name"><a href="<?=$admin_base_url?>index.php?pages=tanyajawab&chats_id=<?=$row['id']?>"><?=$row['nama_lengkap']?></a></td>
                                       <td class="mailbox-subject"><b>#<?=$row['no_tiket']?></b> - <?=Excerpt(array('text' => $row['perihal']))?></td>
                                       <td class="mailbox-date"><?=$row['tanggal_input']?></td>
                                    </tr>
                                    <?php $no++; ?>
                                 <?php } ?>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6">
               <div class="card direct-chat direct-chat-primary">
                  <div class="card-header">
                     <h3 class="card-title"><?=$detail['no_tiket']." - ".$detail['perihal']?></h3>
                  </div>
                  <div class="card-body">
                     <div class="direct-chat-messages" style="height: 500px;" id="pesan">
                        <?php foreach ($reply as $row) { ?>
                           <div class="direct-chat-msg <?=$row['tipe'] == "2" ? 'right' : ''?>">
                              <div class="direct-chat-infos clearfix">
                                 <span class="direct-chat-name float-left"><?=$row['tipe'] == "1" ? $detail['nama_lengkap'] : $login['nama_lengkap']?></span>
                                 <span class="direct-chat-timestamp float-right"><?=$row['tanggal_input']?></span>
                              </div>
                              <img class="direct-chat-img" src="<?=$global_base_url?>assets/img/user_male.png" alt="message user image">
                              <div class="direct-chat-text"><?=$row['pesan']?></div>
                           </div>
                        <?php } ?>
                     </div>
                  </div>
                  <div class="card-footer">
                     <form action="" method="post" id="balas">
                        <input type="hidden" name="chats_id" value="<?=$chats_id?>">
                        <div class="input-group">
                           <input type="text" name="reply" placeholder="Ketik Pesan ..." class="form-control">
                           <span class="input-group-append">
                              <button type="submit" name="balas" value="balas" form="balas" class="btn btn-primary">Kirim</button>
                           </span>
                        </div>
                     </form>
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
      window.history.replaceState(null, null, "<?=$admin_base_url?>index.php?pages=tanyajawab&chats_id=<?=$chats_id?>");
      setTimeout(function() {
         $('.alert').remove();
      }, 10000);
   <?php } ?>
   var objDiv = document.getElementById("pesan");
   objDiv.scrollTop = objDiv.scrollHeight;
</script>
</body>
</html>