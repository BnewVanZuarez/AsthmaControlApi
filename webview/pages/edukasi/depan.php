<?php 
$error    = (isset($get['error']) ? $get['error'] : 0);
$reason   = (isset($get['reason']) ? $get['reason'] : "");
$slug     = (isset($get['slug']) ? $get['slug'] : "");

$informasi= Detail(array("slug" => Escape($slug)));
$date     = date_create($informasi['tanggal_input']);
if (count($informasi) < 1) {
   $informasi= array(
      'id' => '',
      'slug' => '',
      'writer' => '',
      'judul' => '',
      'gambar' => '',
      'video' => '',
      'detail' => '',
      'tanggal_input' => '',
   );
}
?>
<?php include("pages/parts/header.php"); ?>
<div class="container mt-3">
   <div class="row">
      <div class="col-lg-12">
         <article>
            <header class="mb-4">
               <h1 class="fw-bolder mb-1"><?=$informasi['judul']?></h1>
               <div class="text-muted fst-italic mb-2"><?=tanggal_indo(date_format($date,"Y-m-d"))?> oleh <?=$informasi['writer']?></div>
            </header>
            <figure class="mb-4 text-center">
               <img class="img img-fluid rounded" src="<?=$global_base_url.$global_upload_file?>/edukasi/<?=$informasi['gambar']?>" alt="<?=$informasi['judul']?>"/>
            </figure>
            <section class="mb-5">
               <?php if ($informasi['video'] != "") : ?>
                  <div class="embed-responsive embed-responsive-4by3">
                     <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$informasi['video']?>?rel=0" width="100%" height="256px" allowfullscreen></iframe>
                  </div>
               <?php endif; ?>
               <?=HtmlDecode(array("text" => $informasi['detail']))?>
            </section>
         </article>
      </div>
   </div>
</div>
<?php include("pages/parts/footer.php"); ?>
</body>
</html>