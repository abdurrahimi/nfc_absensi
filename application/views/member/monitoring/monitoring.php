<div class="main-content">
	<script type="text/javascript"
      src="http://maps.google.com/maps/api/js?key=AIzaSyBC5priQXYTmVvZ5SGpOCGMCQkGJ2ik0x4&sensor=false&libraries=drawing">
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
			/*<?php
			//$area = explode(",",$dataDetail['latlong_a']);
			?>*/
			
			$(document).ready(function(){
			
			  var drawingManager;
			  var selectedShape;
			  var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
			  var selectedColor;
			  var colorButtons = {};
			  var runner_listing = "";
			  var map = "";
			  var markers = Array();
			  var markers_post = Array();
			  var infowindows = Array();
			  var markers_id = [];
			  var new_Maps = "";
			var contactLatitude = '-6.2297264' ;
			var contactLongitude = '106.6894312';
			function gambarMap() {
				var mapCanvas = document.getElementById('map');
				var myLatLng = {
					lat: contactLatitude,
					lng: contactLongitude
				};
				var mapOptions = {
					center: new google.maps.LatLng(contactLatitude, contactLongitude),
					zoom: 10,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				map = new google.maps.Map(mapCanvas, mapOptions);
				console.log("INSTALL MAP");
				console.log(map);
				// new_Maps=map;
				//addMarker(myLatLng, map);
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
			
			
			
			google.maps.event.addDomListener(window, 'load', gambarMap);
			
			// window.setInterval(function(){
			  // /// call your function here
			  // gambarMap();
			// }, 3000);
			 //get ajax marker 
			 function get_ajax_runner(myparam){
				 var tgl = $("#txtTgl").val();
				 var nik = $("#txtNik").val();
				 var uriTujuan = "<?php echo base_url('admin/monitoring/get_data_json'); ?>";
				 $.ajax({
					url: uriTujuan,
					data: {iTgl:tgl,
						   iNik:nik},
					type: "post",
					dataType: "json",
					timeout: 10000,
					success: function (response) {
						runner_listing = response;
						console.log(response);
						gambar_marker_pelari();
						
					}
				});
			 }
			 
			 
			 function add_marker(opts, place) {
				  console.log(opts); 
				  
				  var marker = new google.maps.Marker(opts);
				  marker.place_id = place.id;
				  markers[place.id] = marker;
				  markers_id.push(marker.place_id);
				  var infowindow = new google.maps.InfoWindow({
					content: place.details
				  });

				  infowindows[place.id] = infowindow;

				  google.maps.event.addListener(marker, 'click', function() {
					infowindows[marker.place_id].open(map,marker);
				  });
				  console.log("INI MAP ");
				  console.log(markers);

			 }
			 
			 function add_marker_post(opts, place) {
				  console.log(opts); 
				  
				  var marker = new google.maps.Marker(opts);
				  marker.place_id = place.id;
				  markers_post[place.id] = marker;
				  var infowindow = new google.maps.InfoWindow({
					content: place.details
				  });

				  infowindows[place.id] = infowindow;

				  google.maps.event.addListener(marker, 'click', function() {
					infowindows[marker.place_id].open(map,marker);
				  });

			 }
			 
			
			 function clearOverlays() {
				 console.log("OVERLAYS KIKI "+markers);
			     for (index = 0; index < markers_id.length; ++index) {
					console.log(markers_id[index]);
					markers[markers_id[index]].setMap(null);
				 }
				 markers.length = 0;
				 markers_id = [];
				  // for (var i = 0; i < markers.length; i++ ) {
					// markers[i].setMap(null);
				  // }
				  // markers.length = 0;
			}
			 
			
			 function gambar_marker_pelari(){
				$.each(runner_listing, function(i, item) {	
					// var titik_koor = runner_listing[i].TitikKoordinat;
					// var titik_split = titik_koor.split(",");
					console.log("KIKI LAT "+runner_listing[i].long1);
					add_marker({position: new google.maps.LatLng(runner_listing[i].lat,runner_listing[i].long1),title:runner_listing[i].nama_lengkap,map:map},{id:runner_listing[i].id_user,details:runner_listing[i].nama_lengkap,map:map});
				});
					
			 }
			 
			  
			 
			 $(window).load(function(){
				$(".fa-angle-double-left").click();
			 });
			 //TIMER 
			 var 
				tanggal_event = '<?php echo $detail_event['tgl_event'] ?>',
				start = document.getElementById('btnStartTrack'),
				stop = document.getElementById('btnPauseTrack'),
				clear = document.getElementById('btnResetTrack'),
				seconds = 00, minutes = 00, hours = 00,
				max_seconds = 60, max_minutes = 60 , max_hours = 24,
				t;

			//tambah waktu detik per detik
			function add() {
				seconds++;
				if(max_seconds<seconds && max_minutes<=minutes && max_hours<=hours){ clearTimeout(t);console.log('yeay'); 
				
				}else{ 
				
				
				if (seconds >= 60) {
					seconds = 0;
					minutes++;
					if (minutes >= 60) {
						minutes = 0;
						hours++;
					}
				}
				
				$("#txtCounterTime").html( (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds));
				if(markers.length>0){
					 clearOverlays();
				}
				get_ajax_runner({tanggal:tanggal_event,jam:hours,menit:minutes,detik:seconds});
				timer();
				}
			}
			
			
			function timer() {
				t = setTimeout(add, 1000);
			}
			/*timer();*/


			/* Start button */
			
				$("#btnStartTrack").click(function(){
					timer();
				});

				/* Stop button */
				$("#btnPauseTrack").click(function(){
						clearTimeout(t);
				});
				$("#btnResetTrack").click(function(){
						$("#txtCounterTime").html("00:00:00");
						/*seconds = <?php echo $detail_event['detik_start'] ?>;
						minutes = <?php echo $detail_event['menit_start'] ?>;
						hours = <?php echo $detail_event['jam_start'] ?>;*/
						clearOverlays();
				});
				
			
			
			});
			
            </script>
 
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>
                
                <li class="active">Monitoring</li>
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
           
			<div class="row">
				<div class="col-xs-12" style="">
				
                <div class="col-xs-6 nopadding" style="border:solid 1px #2c6aa0;height:200px;">
				<h3>Monitoring Marketing - Real Time</h3>
				<table class="table" style="margin-bottom:10px; margin-top:5px;">
					<tr>
						<td>Pilih Waktu</td>
						<td>:</td>
						<td>
						<div class="form-group">
                            <div class="col-sm-9">
								<select name="txtFilter" id="txtFilter" class="col-xs-10 col-sm-7">
									<option value="all">Realtime</option>
									<option value="custom">Per Tanggal</option>
								</select>
                            </div>
                        </div>
						</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>:</td>
						<td>
						<div class="form-group">
							<div class="col-sm-9">
                                <input style="height:30px;" type="date" id="txtTgl" name="txtTgl" value="<?php echo date('Y-m-d') ?>" class="col-xs-10 col-sm-7">
                            </div>
                        </div>
						</td>
					</tr>
					<tr>
						<td>siswa</td>
						<td>:</td>
						<td>
						<div class="form-group">
                            <div class="col-sm-9">
                               <select class="col-xs-10 col-sm-7" id="txtNik" name="txtNik">
									<option value="%">----Semua----</option>
									<?php foreach($this->m_siswa->getAllsiswa() as $value){?>
									<option value="<?php echo $value['nik'];?>"><?php echo $value['nik'].' - '.$value['nama_lengkap'];?></option>
									<?php } ?>
								</select>
							</div>
                        </div>
						</td> 
					</tr>
				</table>
				</div>
				<div class="col-xs-6 nopadding" style="border:solid 1px #2c6aa0;height:200px;">
					<div class="col-xs-6 nopadding"><h3>Action</h3></div>
					<div class="col-xs-6 nopadding"><h3>Waktu</h3></div>
					<div class="col-xs-6 nopadding"><button class="btn btn-info" type="button" id="btnStartTrack" >
								<i class="ace-icon fa fa-play"></i>
								Start
					</button>
					<button class="btn btn-danger" type="button" id="btnPauseTrack" >
								<i class="ace-icon fa fa-pause"></i>
								Pause
					</button>
					<button class="btn btn-warning" type="button" id="btnResetTrack" >
								<i class="ace-icon fa fa-repeat"></i>
								Reset
					</button></div>
					<div class="col-xs-6 nopadding"><span style="font-size:16pt;font-weight:bold;" id="txtCounterTime">00:00:00</span></div>
					<div class="col-xs-12 nopadding">
					<br>
						<span style="float:left;font-size:12pt;font-style:italic;">Legenda : </span>
						<img src="http://maps.google.com/mapfiles/ms/icons/red-dot.png" style="float:left;" /><span style="float:left;font-size:12pt;">siswa Marketing</span>
						
					</div>
					
					
					
					
				
				</div>
				
				</div>
				</div>
				
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