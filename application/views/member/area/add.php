<div class="main-content">
	<script type="text/javascript"
      src="http://maps.google.com/maps/api/js?key=AIzaSyBC5priQXYTmVvZ5SGpOCGMCQkGJ2ik0x4&sensor=false&libraries=drawing">
	</script>
	<style type="text/css">
      #map {
        padding: 0;
        margin: 0;
        height: 435px;
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
			<?php
			//$area = explode(",",$dataDetail['latlong_a']);
			?>
            <script type="text/javascript">
                try {
                    ace.settings.check('breadcrumbs', 'fixed')
                } catch (e) {
                }
				
			//Setting Map
			  var drawingManager;
			  var selectedShape;
			  var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
			  var selectedColor;
			  var colorButtons = {};
			  var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			  var labelIndex = 0;
			  var rectangle;
			  var polyline;
			  
			  function clearSelection() {
				if (selectedShape) {
				  selectedShape.setEditable(false);
				  selectedShape = null;
				}
			  }

			 function setSelection(shape) {
				clearSelection();
				selectedShape = shape;
				shape.setEditable(true);
				selectColor(shape.get('fillColor') || shape.get('strokeColor'));
			  }
			  
			  function deleteSelectedShape() {
				polyline.setMap(null);
				//rectangle.setMap(null);
				$("#txtKoor1").val("");
				$("#txtKoor2").val("");
				$("#txtKoor3").val("");
				$("#txtKoor4").val("");
				if (selectedShape) {
				  selectedShape.setMap(null);
				}
			  }
 
			  function selectColor(color) {
				selectedColor = color;
				for (var i = 0; i < colors.length; ++i) {
				  var currColor = colors[i];
				  colorButtons[currColor].style.border = currColor == color ? '2px solid #789' : '2px solid #fff';
				}

				// Retrieves the current options from the drawing manager and replaces the
				// stroke or fill color as appropriate.
				/*var polylineOptions = drawingManager.get('polylineOptions');
				polylineOptions.strokeColor = color;
				drawingManager.set('polylineOptions', polylineOptions);*/

				var rectangleOptions = drawingManager.get('rectangleOptions');
				rectangleOptions.fillColor = color;
				drawingManager.set('rectangleOptions', rectangleOptions);

				var circleOptions = drawingManager.get('circleOptions');
				circleOptions.fillColor = color;
				drawingManager.set('circleOptions', circleOptions);

				var polygonOptions = drawingManager.get('polygonOptions');
				polygonOptions.fillColor = color;
				drawingManager.set('polygonOptions', polygonOptions);
				
				//rectangle.fillColor = color;
			  }

			  function setSelectedShapeColor(color) {
				if (selectedShape) {
				  if (selectedShape.type == google.maps.drawing.OverlayType.POLYLINE) {
					selectedShape.set('strokeColor', color);
				  } else {
					selectedShape.set('fillColor', color);
				  }
				}
			  }

			  function makeColorButton(color) {
				var button = document.createElement('span');
				button.className = 'color-button';
				button.style.backgroundColor = color;
				google.maps.event.addDomListener(button, 'click', function() {
				  selectColor(color);
				  setSelectedShapeColor(color);
				});

				return button;
			  }

			   function buildColorPalette() {
				 var colorPalette = document.getElementById('color-palette');
				 for (var i = 0; i < colors.length; ++i) {
				   var currColor = colors[i];
				   var colorButton = makeColorButton(currColor);
				   colorPalette.appendChild(colorButton);
				   colorButtons[currColor] = colorButton;
				 }
				 selectColor(colors[0]);
			   }

			  function gambarMap() {
				var map = new google.maps.Map(document.getElementById('map'), {
				  zoom: 10,
				  center: new google.maps.LatLng('-6.2297264','106.6894312'),
				  mapTypeId: google.maps.MapTypeId.ROADMAP,
				  disableDefaultUI: true,
				  zoomControl: true
				  
				});
				
				/*rectangle = new google.maps.Rectangle({		
					editable: true,
					strokeColor: '#FF0000',
					strokeOpacity: 0.8,
					strokeWeight: 0,
					fillColor: '#FF0000',
					fillOpacity: 0.45,
					map: map,
					bounds: {
					  north: <?php echo $ne[0]; ?>,
					  east: <?php echo $ne[1]; ?>,
					  south: <?php echo $sw[0]; ?>, 
					  west: <?php echo $sw[1]; ?>
					}
				});*/  
				
				var a = new google.maps.LatLng();
				var b = new google.maps.LatLng();
				var c = new google.maps.LatLng();
				var d = new google.maps.LatLng();
				
				var lines = [a,b,c,d,a];
				polyline = new google.maps.Polyline({
					path: lines,
					strokeColor:"#0000FF",
					strokeOpacity:0.8,
					strokeWeight:2,		
					editable: true,
					map: map
				});
				
				//console.log('gmaps loaded');
				var polyOptions = {
				  strokeWeight: 0,
				  fillOpacity: 0.45,
				  editable: true,
				}; 
				// Creates a drawing manager attached to the map that allows the user to draw
				// markers, lines, and shapes.
								
				drawingManager = new google.maps.drawing.DrawingManager({
				  drawingMode: google.maps.drawing.OverlayType.POLYLINE,
				  markerOptions: {
					draggable: true
				  },
				  polylineOptions: {
					editable: true
				  },
				  rectangleOptions: polyOptions,  
				  circleOptions: polyOptions,
				  polygonOptions: polyOptions,
				  map: map
				});
								
				//var markers = [];
				google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
					/*if (e.type == google.maps.drawing.OverlayType.RECTANGLE) {
						var choiceRectangle = e.overlay;
						choiceRectangle.type = e.type;
						//google.maps.event.addListener(choiceRectangle,'click',function(){
							//var latlong = array();
							var bounds = choiceRectangle.getBounds();
							var ne = bounds.getNorthEast();
							var sw = bounds.getSouthWest();
							$("#txtKoor1").val("");
							$("#txtKoor1").val(ne);
							$("#txtKoor2").val("");
							$("#txtKoor2").val(sw);
						//});
					}*/
					if (e.type != google.maps.drawing.OverlayType.MARKER) {
						// Switch back to non-drawing mode after drawing a shape.
						drawingManager.setDrawingMode(null);

						// Add an event listener that selects the newly-drawn shape when the user
						// mouses down on it.
						var newShape = e.overlay; 
						newShape.type = e.type;
						google.maps.event.addListener(newShape, 'click', function() {
						  setSelection(newShape);
						});
						setSelection(newShape);
					} 
					/* else if (e.type == google.maps.drawing.OverlayType.MARKER) {
						var choiceMarker = e.overlay; 
						choiceMarker.type = e.type;
						//markers.push(choiceMarker.getPosition())
						//$("#mark_path").val("");
						//$("#mark_path").val(markers); 
						
						var infowindow = new google.maps.InfoWindow({
						  content: '<div id="content"><textarea name="txtContent[]"></textarea>' +
										'<input type="hidden" id="mark" name="mark[]" value="' + choiceMarker.getPosition() + '">' +
									'</div>' 
						});
						google.maps.event.addListener(choiceMarker,'click',function(){
						  infowindow.open(map,choiceMarker);
						});
					}*/
				});
		 

				// Clear the current selection when the drawing mode is changed, or when the
				// map is clicked.
				google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
				google.maps.event.addListener(map, 'click', clearSelection);
				google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
				
				buildColorPalette();	
				
				setTimeout(function(){
					google.maps.event.addListener(drawingManager, 'polylinecomplete', function(line) {
						var str = line.getPath().getArray();
						$("#txtKoor1").val("");
						$("#txtKoor1").val(str[0]); 
						$("#txtKoor2").val("");
						$("#txtKoor2").val(str[1]); 
						$("#txtKoor3").val("");
						$("#txtKoor3").val(str[2]); 
						$("#txtKoor4").val("");
						$("#txtKoor4").val(str[3]); 
					}); 
				},1000);		
			}
			google.maps.event.addDomListener(window, 'load', gambarMap);
            </script>
 
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>

                <li>
                    <a href="<?php echo base_url('admin/area/daftar') ?>">Area</a>
                </li>
                
                
                <li class="active">Tambah Area</li>
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
                    Formulir Tambah Area
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/area/doAdd/'.$this->uri->segment(4); ?>" role="form"> 
                       <?php 
                       $dataOld = $this->session->flashdata('oldPost'); 
                       echo $this->session->flashdata('msgbox');?>
                        <!-- #section:elements.form -->
						<div class="form-group">
							<div class="col-xs-12">
								<div class="clearfix">
									<?php echo $this->session->flashdata('msgbox') ?>
								 </div>
								Silahkan gambar rute di bawah ini, klik 2x pada titik terakhir untuk selesai menggambar.
							</div>
							<div class="col-xs-12">
								<div id="panel">
								  Ubah warna rute : <br>
								  <div id="color-palette"></div>
								  <div class="clear"></div>
									<div>
										<button type="button" class="btn btn-danger btn-sm" id="delete-button" style="margin-left:2px"><i class="fa fa-trash" style="font-size: 14px;"></i>&nbsp;&nbsp;<span>Hapus Rute</span></button>
									</div>
								</div>
								<div id="map"></div>
							</div>
                        </div>
						<div class="form-group">        
                          <div class="col-sm-2" style="border-bottom: 2px solid #6EBACC;">
                            Harap isi isian di bawah ini:
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Area</label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="txtArea" value="" placeholder="Isi area" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Koordinat latitude 1</label>
                            <div class="col-sm-9">
                                <input type="text" id="txtKoor1" name="txtKoor1" value="" placeholder="Isi koordinat latitude 1" class="col-xs-10 col-sm-5" required readonly/>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Koordinat latitude 2</label>
                            <div class="col-sm-9">
                                <input type="text" id="txtKoor2" name="txtKoor2" value="" placeholder="Isi koordinat latitude 2" class="col-xs-10 col-sm-5" required readonly/>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Koordinat latitude 3</label>
                            <div class="col-sm-9">
                                <input type="text" id="txtKoor3" name="txtKoor3" value="" placeholder="Isi koordinat latitude 3" class="col-xs-10 col-sm-5" required readonly/>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Koordinat latitude 4</label>
                            <div class="col-sm-9">
                                <input type="text" id="txtKoor4" name="txtKoor4" value="" placeholder="Isi koordinat latitude 4" class="col-xs-10 col-sm-5" required readonly/>
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Simpan
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Reset
                                </button>
                            </div>
                        </div>

                        <div class="hr hr-24"></div>

                    </form>


                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->