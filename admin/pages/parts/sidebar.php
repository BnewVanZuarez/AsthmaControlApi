<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-dark-primary">
	<!-- Brand Logo -->
	<a href="<?=$admin_base_url?>index.php?pages=home" class="brand-link text-sm">
		<img src="https://blobcdn.com/blob.svg" alt="Asthma Control" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">Asthma Control</span>
	</a>
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
            <img src="https://blobcdn.com/blob.svg" class="img-circle elevation-2" alt="<?=$login['nama_lengkap']?>">
			</div>
			<div class="info">
				<a href="<?=$admin_base_url?>index.php?pages=profile" class="d-block"><?=$login['nama_lengkap']?> </a>
			</div>
		</div>
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-header">DASHBOARD</li>
            <li class="nav-item">
               <a href="<?=$admin_base_url?>index.php?pages=home" class="nav-link <?=$get['pages'] == "home" ? 'active' : ''?>">
                  <i class="nav-icon bi bi-house-fill"></i>
                  <p>Home</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="<?=$admin_base_url?>index.php?pages=tanyajawab" class="nav-link <?=$get['pages'] == "tanyajawab" ? 'active' : ''?>">
                  <i class="nav-icon bi bi-chat-left-dots-fill"></i>
                  <p>Tanya Jawab</p>
               </a>
            </li>
            <li class="nav-header">Edukasi</li>
            <li class="nav-item">
               <a href="<?=$admin_base_url?>index.php?pages=edukasi" class="nav-link <?=$get['pages'] == "edukasi" ? 'active' : ''?>">
                  <i class="nav-icon bi bi-journal-richtext"></i>
                  <p>Edukasi</p>
               </a>
            </li> 
            <li class="nav-header">Rencana Aksi Asma</li>
            <li class="nav-item">
               <a href="<?=$admin_base_url?>index.php?pages=rencana" class="nav-link <?=$get['pages'] == "rencana" ? 'active' : ''?>">
                  <i class="nav-icon bi bi-file-earmark-ruled-fill"></i>
                  <p>Renacana Aksi Asma</p>
               </a>
            </li> 
            <li class="nav-header">Rumah Sakit</li>
            <li class="nav-item">
               <a href="<?=$admin_base_url?>index.php?pages=rumahsakit" class="nav-link <?=$get['pages'] == "rumahsakit" ? 'active' : ''?>">
                  <i class="nav-icon bi bi-hospital-fill"></i>
                  <p>Rumah Sakit</p>
               </a>
            </li> 
            <li class="nav-header">Users</li>
            <li class="nav-item">
               <a href="<?=$admin_base_url?>index.php?pages=users" class="nav-link <?=$get['pages'] == "users" ? 'active' : ''?>">
                  <i class="nav-icon bi bi-people-fill"></i>
                  <p>User</p>
               </a>
            </li>
            <li class="nav-header">Setting</li>
				<li class="nav-item">
					<a href="<?=$admin_base_url?>index.php?pages=logout" class="nav-link">
						<i class="nav-icon bi bi-door-open-fill"></i> <p>Keluar</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>