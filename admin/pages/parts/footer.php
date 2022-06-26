		<!-- Main Footer -->
		<footer class="main-footer text-sm">
			<!-- To the right -->
			<div class="float-right d-none d-sm-inline">V.<?=$global_versi?></div>
			<!-- Default to the left -->
			<strong>Copyright &copy; <?=date("Y")?> <a href="<?=$admin_base_url?>">AsthmaControl</a>.</strong> All rights reserved.
		</footer>

	</div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function() {
         $('.summernote').summernote({
            placeholder: 'ketik disini...',
            height: 500,
            toolbar: [
               // [groupName, [list of button]]
               ['misc', ['undo', 'redo', 'fullscreen', 'codeview']],
					['style', ['bold', 'italic', 'underline', 'clear']],
					['fontsize', ['fontsize']],
					['fontname', ['fontname']],
					['para', ['style', 'ul', 'ol', 'paragraph']],
					['height', ['height']],
					// ['insert', ['link']]
					['insert', ['link', 'picture', 'table', 'hr']]
				],
            callbacks: {
               onImageUpload : function(files, editor, welEditable) {
                  for(var i = files.length - 1; i >= 0; i--) {
                     sendFile(files[i], this);
                  }
               }
            }
			});
		});
      function sendFile(file, el) {
         var form_data = new FormData();
         form_data.append('file', file);
         $.ajax({
            data: form_data,
            type: "POST",
            url: '<?=$admin_base_url;?>libs/uploader.php',
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
               $(el).summernote('editor.insertImage', url);
            }
         });
      }
      $(document).ready(function () {
         bsCustomFileInput.init()
      })
   </script>