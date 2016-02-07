<?php
$this->load->view('header');
$this->load->view('top_panel');
?>

<!-- START MENU WRAPPER -->
	<div id="menu-wrapper">
		<div class="container">
			<div class="four columns">
				<div id="logo">
                                    <img src="<?php echo base_url(); ?>images/logo.png" alt="Logo" />
				</div><!-- .logo -->
			</div><!-- four columns -->
			
		</div><!-- .container -->
	</div><!-- #slider-wraper -->
	<!-- END MENU WRAPPER -->

<!-- START SEPARATOR  -->
	<div id="separator">
		<div class="btop-1px"></div>
		<div class="container">
			<!-- start separator -->
			<div class="cta-block">
				<h4 class="page-title">Dobrodošli <?php echo $this->session->userdata('user_name'); ?></h4>
			</div><!-- sixteen columns -->
		</div><!-- .container -->
		<div class="bbottom-1px"></div>
	</div><!-- #separator -->
	<!-- END SEPARATOR -->	
        
        
        <!-- START PAGE WRAPPER -->
	<div class="container main-wrapper">
		<div id="main-content" class="twelve columns">
                    <h6>Molimo vas dopunite vaše registracijske podatke</h6>
                    <p>Sva polja označena <strong> * </strong> su obavezna</p>
                    <h6 style="color:red;"><?php echo  $this->session->flashdata('change_user_data'); ?></h6>
                    
                        
					<div class="row">
				<div class="six columns alpha">
                            <div id="contacts-form-main"> 
                                
        <?php
        echo form_open('admin/newuser_updatedata', 'id="ajax-contact-form-main"');
        if(strlen(validation_errors())){
            echo "<h5 style='color:red;'>Molimo vas pokušajte ponovo...</h5>";
        }
        echo validation_errors('<p style="color:red;">', '</p>');
        ?>
       <label for="lokacija">Adresa <small> ulica, kućni broj</small><span>*</span></label>
        <input type="text" name="street" required class="required sign" title="Ulica, kućni broj"  />
        <label for="city">Mjesto <small> mjesto, grad</small><span>*</span></label>
        <input type="text" name="city" required class="required sign" title="Vaše mjesto, grad"  />
        <label for="state">Država <span>*</span></label>
       <?php echo form_dropdown('state', $state_options_admin,  set_value('state'), 'class="category"'); ?>
        <label for="tel">Telefon <span>*</span></label>
        <input type="number" name="tel"    class="required sign" title="Vaš telefon"  />
        <label for="about">Ponešto o vama </label>
        <textarea name="about" class="required sign" title="O vama"></textarea>
        <label for="web">Web stranica, Facebook </label>
        <input type="text" name="web"  class="required sign" title="Vaša web stranica"  /> 
        
        <label for="license">Za koja vozila ili skup vozila imate  dozvolu? <span>*</span></label>
        <?php foreach ($license as $l): ?>
        <p><strong style="width:20px; display:inline-block;"><?php echo $l['name']; ?></strong>
        <input style="margin-left:30px;" type="checkbox" name="licences[]" id="licenses" value="<?php echo $l['name']; ?>" />
        <p>
         <?php endforeach; ?>
        <br />
        <input type="submit" class="submit no-margin-bottom" name="signup_submit" value="Unesi"/>
       
       <?php       
        echo form_close();
        ?>
        <p>Sva polja označena <span>*</span> su obavezna.</p><br />

<div class="clear"></div>
			</div> <!-- end #contact-form -->
				</div><!-- six -->
				<div class="six columns omega">
					<ul class="arrow2">
						<li>Dopunite vašu registraciju zbog:</li>
						<li>Podataka koji su potrebni kod objave oglasa</li>
						<li>Da bi vas korisnici mogli lakše kontaktirati</li>
                                                <li>Ulica i kućni broj su obavezni</li>
                                                <li>Mjesto ili grad su obavezni</li>
                                                <li>Država je obavezna</li>
                                                <li>Telefon je obavezan</li>
                                                <li>Odabir vozačkih kategorija je obavezan</li>
					</ul>
				</div><!-- six-->
			</div><!-- row -->	
                   
           
			
		  
		 
			
		</div><!-- main-content -->

                

                
</div><!-- .container -->


<?php
$this->load->view('admin_footer');





