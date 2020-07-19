<div class="main-content">
	<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&extn=.js"></script>
	<style type="text/css">
      #map_2385853 {
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
			
            <script type='text/javascript'>//<![CDATA[
			
<?php
$area = explode(",",$dataDetail['latlong_a']);
?>
var contactLatitude = <?php echo $area[0];?> ;
var contactLongitude = <?php echo $area[1];?>;				
$(function(){
	var locations = {}; //A repository for markers (and the data from which they were contructed).

	//initial dataset for markers
	var locs = {
	    1: {
	        info: '11111. Some random info here',
	        lat: 46.0553,
	        lng: 14.5144
	    },
	    2: {
	        info: '22222. Some random info here',
	        lat: 46.0553,
	        lng: 14.5144
	    },
	    3: {
	        info: '33333. Some random info here',
	        lat: -33.7333,
	        lng: 151.0833
	    },
	    4: {
	        info: '44444. Some random info here',
	        lat: 27.9798,
	        lng: -81.731
	    }
	};
	var map = new google.maps.Map(document.getElementById('map_2385853'), {
	    zoom: 1,
	    streetViewControl: false,
	    center: new google.maps.LatLng(contactLatitude, contactLongitude),
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	});
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
	var infowindow = new google.maps.InfoWindow();

	function setMarkers(locObj) {
	    $.each(locObj, function (key, loc) {
	        if (!locations[key] && loc.lat !== undefined && loc.lng !== undefined) {
	            //Marker has not yet been made (and there's enough data to create one).

	            //Create marker
	            loc.marker = new google.maps.Marker({
	                position: new google.maps.LatLng(loc.lat, loc.lng),
	                map: map
	            });

	            //Attach click listener to marker
	            google.maps.event.addListener(loc.marker, 'click', (function (key) {
	                return function () {
	                    infowindow.setContent(locations[key].info);
	                    infowindow.open(map, locations[key].marker);
	                }
	            })(key));

	            //Remember loc in the `locations` so its info can be displayed and so its marker can be deleted.
	            locations[key] = loc;
	        } else if (locations[key] && loc.remove) {
	            //Remove marker from map
	            if (locations[key].marker) {
	                locations[key].marker.setMap(null);
	            }
	            //Remove element from `locations`
	            delete locations[key];
	        } else if (locations[key]) {
	            //Update the previous data object with the latest data.
	            $.extend(locations[key], loc);
	            if (loc.lat !== undefined && loc.lng !== undefined) {
	                //Update marker position (maybe not necessary but doesn't hurt).
	                locations[key].marker.setPosition(
	                new google.maps.LatLng(loc.lat, loc.lng));
	            }
	            //locations[key].info looks after itself.
	        }
	    });
	}

	var ajaxObj = { //Object to save cluttering the namespace.
	    options: {
	        url: "<?php echo base_url('admin/monitoring/get_data_json')?>", //The resource that delivers loc data.
	        dataType: "json" //The type of data tp be returned by the server.
	    },
	    delay: 1000, //(milliseconds) the interval between successive gets.
	    errorCount: 0, //running total of ajax errors.
	    errorThreshold: 5, //the number of ajax errors beyond which the get cycle should cease.
	    ticker: null, //setTimeout reference - allows the get cycle to be cancelled with clearTimeout(ajaxObj.ticker);
	    get: function () { //a function which initiates 
	        if (ajaxObj.errorCount < ajaxObj.errorThreshold) {
	            ajaxObj.ticker = setTimeout(getMarkerData, ajaxObj.delay);
	        }
	    },
	    fail: function (jqXHR, textStatus, errorThrown) {
	        console.log(errorThrown);
	        ajaxObj.errorCount++;
	    }
	};

	//Ajax master routine
	function getMarkerData() {
	    $.ajax(ajaxObj.options)
	        .done(setMarkers) //fires when ajax returns successfully
	    .fail(ajaxObj.fail) //fires when an ajax error occurs
	    .always(ajaxObj.get); //fires after ajax success or ajax error
	}

	setMarkers(locs); //Create markers from the initial dataset served with the document.
	//ajaxObj.get(); //Start the get cycle.

	// *******************
	//test: simulated ajax
	var testLocs = {
	    1: {
	        info: '1. New Random info and new position',
	        lat: -37,
	        lng: 124.9634
	    },
	    2: {
	        lat: 70,
	        lng: 14.5144
	    },
	    3: {
	        info: '3. New Random info'
	    },
	    4: {
	        remove: true
	    },
	    5: {
	        info: '55555. Added',
	        lat: -37,
	        lng: 0
	    }
	};
	setTimeout(function () {
	    setMarkers(testLocs);
	}, ajaxObj.delay);
	// *******************
	
});//]]> 

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
								<div id="map_2385853"></div>
							</div>
                        </div>
                    </form>
<script>
  // tell the embed parent frame the height of the content
  if (window.parent && window.parent.parent){
    window.parent.parent.postMessage(["resultsFrame", {
      height: document.body.getBoundingClientRect().height,
      slug: "None"
    }], "*")
  }
</script>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->