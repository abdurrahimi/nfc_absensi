<div id="sidebar" class="sidebar                  responsive">
	<script type="text/javascript">
		try {
			ace.settings.check('sidebar', 'fixed')
		} catch (e) {}
	</script>

	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large"></div>
		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini"></div>
	</div>
	<?php
	$cur1 = $this->uri->segment(2);
	?>
	<ul class="nav nav-list">
		<li class="<?php echo ($cur1 == "dashboard") ? "active" : ""; ?>" style="height: 100%;">
			<a href="<?php echo base_url('admin/dashboard') ?>">
				<i class="menu-icon fa fa-home"></i>
				<span class="menu-text"> Home </span>
			</a>
			<b class="arrow"></b>
		</li>
		<li class="<?php echo ($cur1 == "setting") ? "active" : ""; ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-cogs"></i>
				<span class="menu-text">
					Data Master
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="">
					<a href="<?php echo base_url('admin/area/daftar') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Area
					</a>
					<b class="arrow"></b>
				</li>
			</ul>
		</li>
		<li class="<?php echo ($cur1 == "setting") ? "active" : ""; ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-user"></i>
				<span class="menu-text">
					Rule Absensi
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="">
					<a href="<?php echo base_url('admin/rule/add') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Tambah Data
					</a>
					<b class="arrow"></b>
				</li>
				<li class="">
					<a href="<?php echo base_url('admin/rule/daftar') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Daftar Data
					</a>
					<b class="arrow"></b>
				</li>
			</ul>
		</li>
		<li class="<?php echo ($cur1 == "setting") ? "active" : ""; ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-users"></i>
				<span class="menu-text">
					Data siswa
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="">
					<a href="<?php echo base_url('admin/siswa/add') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Tambah Data
					</a>
					<b class="arrow"></b>
				</li>
				<li class="">
					<a href="<?php echo base_url('admin/siswa/daftar') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Daftar Data
					</a>
					<b class="arrow"></b>
				</li>
			</ul>
		</li>
		<!-- <li class="<?php echo ($cur1 == "setting") ? "active" : ""; ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text">
					Laporan
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="">
					<a href="<?php echo base_url('admin/report/wizard/harian') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Absensi Harian
					</a>
					<b class="arrow"></b>
				</li>	
				<li class="">
					<a href="<?php echo base_url('admin/report/wizard/bulanan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Absensi Bulanan
					</a>
					<b class="arrow"></b>
				</li>			
			</ul>
        </li> -->



		<!-- #section:basics/sidebar.layout.minimize -->
		<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
			<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
		</div>

		<!-- /section:basics/sidebar.layout.minimize -->
		<script type="text/javascript">
			try {
				ace.settings.check('sidebar', 'collapsed')
			} catch (e) {}
		</script>
</div>