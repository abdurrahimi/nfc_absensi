<div class="modal fade" id="GeneralModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 class="modal-title"></h4>
		      	</div>
		      	<div class="modal-body" style="max-height:500px;overflow-y:scroll"></div>
		    </div>
	  	</div>
</div>
<script>
function clickDetail(linkData,linkTitle){
	var title = linkTitle;
	var link = linkData;
	$("#GeneralModal .modal-header h4").empty().html(title);
	$("#GeneralModal .modal-body").empty().load(linkData);
	$('html, body').animate({scrollTop: 0}, 500, function () {
	$("#GeneralModal").modal("show");
});
}
$('#GeneralModal').on('hidden.bs.modal', function () {
    location.reload();
})
</script>

<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
						&copy; <?php echo date('Y').', '; ?>
							<span class="blue bolder">Geofence method </span>
							 
						</span>

						&nbsp; &nbsp;
						<!--
                                                <span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
                                                    -->
					</div>

					<!-- /section:basics/footer -->
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>