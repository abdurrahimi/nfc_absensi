<!DOCTYPE html>
<html lang="en">
	
                <?php  $this->load->view('member/include/head') ?>
	<body class="no-skin" id="body-saya">
                
		<!-- #section:basics/navbar.layout -->
		<?php  $this->load->view('member/include/topnavbar',$userLogin) ?>
                
		<!-- /section:basics/navbar.layout -->
                
		<div class="main-container" id="main-container" >
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<?php $this->load->view('member/include/sidebar_menu') ?>
			<!-- /section:basics/sidebar -->
			<?php $this->load->view($v_content) ?>
			
                        
                        <?php $this->load->view('member/include/footer') ?>
		</div><!-- /.main-container -->

		<?php include 'include/scripts.php' ?>
	</body>
</html>
