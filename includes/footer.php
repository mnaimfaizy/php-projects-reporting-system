
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="http://afghanskils.af" target="_blank">Afghan Skils</a> <?php echo date("Y"); ?></p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Developed by: <a
                href="http://mnfprofile.com" target="_blank">Mohammad Naim Faizy</a></p>
    </footer>

</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>
<script>
	/* This function will check once if there are any projects which there end_time is getting near 
	-- So it will send an email and specify the project title. */
		/*jQuery(document).ready(function() {	
			var minute = 1000*60;
			var hour = 1000*60*60;
			var day = 1000*60*60*24;
			setInterval(check_renewal, day);
			function check_renewal() {
				$.ajax({ // create an ajax request to load_orders.php
					type: "GET",
					url: "ajax/check_renewal.php",
					dataType: "html", // expect html to be returned
					success: function(response) {
						//$("#load_paypal_orders").html(response);
						console.log(response);
						//alert(response);	
					}
				});	
			}
		});*/
	</script>

</body>
</html>
