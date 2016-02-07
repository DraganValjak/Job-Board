
        
       <!-- START MENU WRAPPER -->
	<div id="menu-wrapper">
		<div class="container">
			<div class="four columns">
				<div id="logo">
                                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.png" alt="Logo" /></a>
				</div><!-- .logo -->
			</div><!-- four columns -->
			<div class="twelve columns navigation">
				<div id="menu" class="fix-fish-menu">
					<ul id="nav" class="sf-menu">
						 <li><a href="<?php echo base_url().'jobs/listings'; ?>">Poslovi</a></li>
		                                 <li><a href="<?php echo base_url().'workers/listings'; ?>">Posloprimci</a></li>
                                                 <li><a style="color:#0060B6;" href="<?php echo base_url().'drive/hitchhikers'; ?>">Povezi Me</a></li>

                                              
                                               <?php if($this->session->userdata('is_logged_in') === FALSE){ ?>
				 		<li><a href="#">Registirajte se</a>
				 		<ul>
                                                    <li><a href="<?php echo base_url() .'login/signup'; ?>">Posloprimci</a></li>
								<li><a href="<?php echo base_url() .'login/company_signup'; ?>">Poslodavci</a></li>

							</ul>
                                                    </li>
					 	<?php } ?>
                                                    
                                                     <li><a href="<?php echo base_url() .'education'; ?>">Edukacija</a>
                                                        <ul>
                                                    <li><a href="<?php echo base_url() .'education/kod95'; ?>">KOD 95</a></li>
								<li><a href="<?php echo base_url() .'education/vozac'; ?>">KV vozač</a></li>
                                                                <li><a href="<?php echo base_url() .'education/adr'; ?>">ADR</a></li>
                                                                <li><a href="<?php echo base_url() .'education/strojevi'; ?>">Radni strojevi</a></li>
                                                                 <li><a href="<?php echo base_url() .'education/tahograf'; ?>">Tahograf</a></li>

							</ul>
                                                    </li>
                                                    
                                                    <li><a href="#">Pomoč</a>
                                                        <ul>
                                                    <li><a href="<?php echo base_url() .'terms/help'; ?>">Posao</a></li>
								<li><a href="<?php echo base_url() .'terms/stopper'; ?>">Povezi Me</a></li>

							</ul>
                                                    </li>
				 		
		 				
				 	</ul>  <!-- end #nav  -->
			 	</div>	<!-- end #menu  -->	
			</div><!-- .twelve columns -->
		</div><!-- .container -->
	</div><!-- #slider-wraper -->
	<!-- END MENU WRAPPER -->

