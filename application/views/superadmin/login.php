<?php
$this->load->view('header');
$this->load->view('top_panel');
$this->load->view('navigation');
?>
	<!-- START SEPARATOR  -->
	<div id="separator">
		<div class="btop-1px"></div>
		<div class="container">
			<!-- start separator -->
			<div class="cta-block">
				<h4 class="page-title">Prijava za administraciju</h4>
			</div><!-- sixteen columns -->
		</div><!-- .container -->
		<div class="bbottom-1px"></div>
	</div><!-- #separator -->
	<!-- END SEPARATOR -->	

<!-- START PAGE WRAPPER -->
	<div class="container main-wrapper">
		<div id="main-content" class="twelve columns">
			<div class="contacts-block">
			
            <fieldset class="info_fieldset">            
            <div id="contacts-form-main">
       <?php echo form_open('adminlogin/login','id="ajax-contact-form-main"');

      echo validation_errors('<p style="color:red;">', '</p>');
      ?>
                <label for="email">Vaš email</label>          
      <input type="email" name="email" required  placeholder="Vaš email" class="last-item required red" title="Vaša zaporka" />
       <div class="clear"></div>
      <label for="password">Vaša zaporka</label>
       <input type="password" name="password" required  placeholder="Vaša zaporka" class="required red" title="Vaš email"  />
       
       <div class="clear"></div>
       <input type="submit" class="submit no-margin-bottom" name="admin_submit" value="Prijava"/>
       
       <?php
      echo form_close();
      ?>
        <div class="clear"></div>
       

				<div class="clear"></div>
			</div> <!-- end #contact-form -->
			</fieldset>
		    <div class="clear"></div>
		    </div><!-- .contacts-block -->
			
		</div><!-- main-content -->
                
                
                <!-- START SIDEBAR -->
		<div id="sidebar" class="four columns">

			<div class="widget">
				<h6>Tražite djelatnika</h6>
				<div class="gray-dash-3px"></div>
				<p>Poslodavci, ponekad se čini nemoguće naći dobrog i kvalitetnog radnika. Ovaj specijalizirani portal vam nudi brz i uspješan pronalazak djelatnika sa karakteristikama koje vi tražite.
                                    Svoje potrebe za vozačima, dispečerima i skladištarima oglasite ovdje.</p>
			</div><!-- widget -->
                        <div class="widget">
				<h6>Posao na brzinu</h6>
				<div class="gray-dash-3px"></div>
				<p>Svjesni smo teške situacije u kojoj se nalazi gospodarstvo, a time i profesija vozača i
                                    pratećeg osoblja naše zemlje, a isto tako i gospodarstvo zemalja u okruženju. Kako je brzina u našem poslu jedan od bitnih faktora 
                                    ovim specijaliziranim portalom pokušali bi smo pronaći lakši put do posla, a isto tako i poslodavcima put do dobrog radnika..</p>
			</div><!-- widget -->
	
		</div><!-- sidebar -->


</div><!-- .container -->
<?php
$this->load->view('footer');

# end of file /views/company_login.php
