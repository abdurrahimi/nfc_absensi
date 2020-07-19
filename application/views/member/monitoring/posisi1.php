<div class="main-content">
	<script type="text/javascript"
      src="http://maps.google.com/maps/api/js?sensor=false&libraries=drawing">
	</script>
	<style type="text/css">
      #map {
        padding: 0;
        margin: 0;
        height: 435px;
        width: 100%;
      }

      #panel {
        width: 150px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        float: right;
        margin: 10px;
      }

      #color-palette {
        clear: both;
      }

      .color-button {
        width: 14px;
        height: 14px;
        font-size: 0;
        margin: 2px;
        float: left;
        cursor: pointer;
      }

      #delete-button {
        margin-top: 5px;
      }
    </style>
	
    <div class="main-content-inner">
        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">
			
            <script type="text/javascript">
			<?php
			$area = explode(",",$dataDetail['latlong_a']);
			?>
			var contactLatitude = <?php echo $area[0];?> ;
			var contactLongitude = <?php echo $area[1];?>;
			function gambarMap() {
				var mapCanvas = document.getElementById('map');
				var myLatLng = {
					lat: contactLatitude,
					lng: contactLongitude
				};
				var mapOptions = {
					center: new google.maps.LatLng(contactLatitude, contactLongitude),
					zoom: 13,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				var map = new google.maps.Map(mapCanvas, mapOptions);
				addMarker(myLatLng, map);
				// google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
				//google.maps.event.addListener(map, 'click', clearSelection);
				// google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
				
				var a = new google.maps.LatLng(<?php echo $dataDetail['latlong_a'] ?>);
				var b = new google.maps.LatLng(<?php echo $dataDetail['latlong_b'] ?>);
				var c = new google.maps.LatLng(<?php echo $dataDetail['latlong_c'] ?>);
				var d = new google.maps.LatLng(<?php echo $dataDetail['latlong_d'] ?>);
				
				var lines = [a,b,c,d,a];
				polyline = new google.maps.Polyline({
					path: lines,
					strokeColor:"#0000FF",
					strokeOpacity:0.8,
					strokeWeight:2,	
					map: map
				});
				
				//console.log('gmaps loaded');
				var polyOptions = {
				  strokeWeight: 0,
				  fillOpacity: 0.45
				}; 
				
		 
				
						
			}
			
			function addMarker(location, map) {
				/*var marker = new google.maps.Marker({
					position: location,
					title: 'Home Center',
					map:map
				});*/
				//clearMarkers();
				<?php
				$data['listData'] = $this->m_monitoring->getAllMonitoring();
				foreach($data['listData'] as $value){
				?>
					var latLng = new google.maps.LatLng(<?php echo $value['lat'] ?>, <?php echo $value['long'] ?>);
					var marker = new google.maps.Marker({
						position: latLng,
						title: '<?php echo $value['nama_lengkap'] ?>',
						map: map
					});
				<?php } ?>

			}
			
			google.maps.event.addDomListener(window, 'load', gambarMap);
			
			// window.setInterval(function(){
			  // /// call your function here
			  // gambarMap();
			// }, 3000);
            </script>
 
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>

                <li>
                    <a href="<?php echo base_url('admin/area/daftar') ?>">Area</a>
                </li>
                
                
                <li class="active">Edit Area</li>
            </ul><!-- /.breadcrumb -->

            <!-- #section:basics/content.searchbox -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->

            <!-- /section:basics/content.searchbox -->
        </div>

        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content">
            <!-- #section:settings.box -->
            <div class="ace-settings-container" id="ace-settings-container">
                <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                    <i class="ace-icon fa fa-cog bigger-130"></i>
                </div>

                <div class="ace-settings-box clearfix" id="ace-settings-box">
                    <div class="pull-left width-50">
                        <!-- #section:settings.skins -->
                        <div class="ace-settings-item">
                            <div class="pull-left">
                                <select id="skin-colorpicker" class="hide">
                                    <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                </select>
                            </div>
                            <span>&nbsp; Choose Skin</span>
                        </div>

                        <!-- /section:settings.skins -->

                        <!-- #section:settings.navbar -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                            <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                        </div>

                        <!-- /section:settings.navbar -->

                        <!-- #section:settings.sidebar -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                            <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                        </div>

                        <!-- /section:settings.sidebar -->

                        <!-- #section:settings.breadcrumbs -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                            <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                        </div>

                        <!-- /section:settings.breadcrumbs -->

                        <!-- #section:settings.rtl -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                            <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                        </div>

                        <!-- /section:settings.rtl -->

                        <!-- #section:settings.container -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                            <label class="lbl" for="ace-settings-add-container">
                                Inside
                                <b>.container</b>
                            </label>
                        </div>

                        <!-- /section:settings.container -->
                    </div><!-- /.pull-left -->

                    <div class="pull-left width-50">
                        <!-- #section:basics/sidebar.options -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
                            <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
                            <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
                            <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                        </div>

                        <!-- /section:basics/sidebar.options -->
                    </div><!-- /.pull-left -->
                </div><!-- /.ace-settings-box -->
            </div><!-- /.ace-settings-container -->

            <!-- /section:settings.box -->
            <div class="page-header">
                <h1>
                    Monitoring Marketing - Real Time
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/area/doEdit/'.$this->uri->segment(4); ?>" role="form"> 
                       <?php 
                       $dataOld = $this->session->flashdata('oldPost'); 
                       echo $this->session->flashdata('msgbox');?>
                        <!-- #section:elements.form -->
						<div class="form-group">
							<div class="col-xs-12">
								<div class="clearfix">
									<?php echo $this->session->flashdata('msgbox') ?>
								 </div>
								</div>
							<div class="col-xs-12">
								<div id="panel">
								 
								</div>
								<div id="map"></div>
							</div>
                        </div>
                    </form>


                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->