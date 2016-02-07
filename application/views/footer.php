


<!-- START FOOTER -->
	<div id="footer">
		<div class="btop-1px"></div>
		<div class="container">
			<div class="four columns copyright">
				<img src="<?php echo base_url();?>images/logo-footer.png" alt="" />
				<p class="last">@ 2013 Sva prava pridržana.<br>Program by <a href="https://plus.google.com/115443515251328918034/posts">Dragan Valjak</a> za <a href="http://www.convoy.hr/">Convoy</a>.</p>
			</div><!-- .copyright -->
			<div class="twelve columns">
				<div id="secondary-nav" class="clearfix">
					<ul class="clearfix">
                                            <li><a href="<?php echo base_url().'terms/user';?>">Uvijeti korištenja</a></li>
						<li><a href="<?php echo base_url().'terms/data'; ?>">Zaštita podataka</a></li>

					</ul>
					<div class="gray-dash-3px"></div>
				</div><!-- #secondary-nav -->
				<ul id="footer-social">
	    			<li class="facebook"><a href="https://www.facebook.com/groups/121324640418/"></a></li>

	    		</ul><!-- footer-social -->
			</div><!-- twelve columns -->
		</div><!-- container -->
	</div><!-- #footer -->
	<!-- END FOOTER -->

<script type="text/javascript" src="<?php echo base_url();?>js/contact.js"></script>
	

<script type="text/javascript">
/***************************************************
			Camera Slider
***************************************************/
jQuery.noConflict()(function($){
			$('#camera_wrap_1').camera({
				thumbnails: false,
				pagination: false,
				loader: 'bar',
				loaderPadding: 0,
				loaderStroke: 3,
				pagination: true,
				loaderColor: '#7d7d7d'
			});
		});
</script>

<script>
jQuery.noConflict()(function($){
		// create player
    $('#player2').mediaelementplayer({
        // add desired features in order
        // I've put the loop function second,
        features: ['playpause','loop','current','progress','duration']
    });
});
</script>


 


	
<!-- End Document
================================================== -->
</body>
</html>

