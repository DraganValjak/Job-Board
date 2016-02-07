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
				<h4 class="page-title">Registracija za poslodavce</h4>
			</div><!-- sixteen columns -->
		</div><!-- .container -->
		<div class="bbottom-1px"></div>
	</div><!-- #separator -->
	<!-- END SEPARATOR -->	
        
        
        <!-- START PAGE WRAPPER -->
	<div class="container main-wrapper">
		<div id="main-content" class="twelve columns">
	
					<div class="row">
				<div class="six columns alpha">
                            <div id="contacts-form-main">
        <?php
        echo form_open('login/company_validation', 'id="ajax-contact-form-main"');
        echo validation_errors('<p style="color:red;">', '</p>');
        ?>
        <label for="ime">Naziv poduzeča (obrta) <span>*</span></label>
        <input type="text" name="company_name" required class="required sign" title="Naziv poduzeča"  />
        <label for="email">Email <span>*</span></label>
        <input type="email" name="email" required   class="required sign" title="Vaš email" />
        <label for="zaporka">Zaporka <span>*</span></label>
        <input type="password" name="password" required   class="required sign" title="Vaša zaporka"  />
        <label for="czaporka">Ponovite zaporku <span>*</span></label>
        <input type="password" name="cpassword" required   class="required sign" title="Ponovite zaporku"  />
        <input type="submit" class="submit no-margin-bottom" name="signup_submit" value="Registriraj se"/>
       <?php       
        echo form_close();
        ?>
        <p>Sva polja označena <span>*</span> su obavezna.</p><br />

<div class="clear"></div>
			</div> <!-- end #contact-form -->
				</div><!-- six -->
				<div class="six columns omega">
					<ul class="arrow2">
						<li>Ime poduzeča, obrta je obavezno</li>
						<li>Email je obavezan</li>
						<li>Zaporke su obavezne</li>

					</ul>
				</div><!-- six-->
			</div><!-- row -->	
                   
           
			
		  
		 
			
		</div><!-- main-content -->
                
                
     <!-- START SIDEBAR -->
		<div id="sidebar" class="four columns">

			<div class="widget">
				<h6>Tražite djelatnika</h6>
				<div class="gray-dash-3px"></div>
				<p>Poslodavci, ponekad se čini nemoguće naći dobrog i kvalitetnog radnika. Ovaj specijalizirani portal vam nudi brz i uspješan pronalazak djelatnika sa karakteristikama koje vi tražite. Svoje potrebe za vozačima, dispečerima i skladištarima oglasite ovdje .</p>
			</div><!-- widget -->
                        <div class="widget">
				<h6>Posao na brzinu</h6>
				<div class="gray-dash-3px"></div>
				<p>Svjesni smo teške situacije u kojoj se nalazi gospodarstvo, a time i profesija vozača i
                                    pratećeg osoblja naše zemlje, a isto tako i gospodarstvo zemalja u okruženju. Kako je brzina u našem poslu jedan od bitnih faktora 
                                    ovim specijaliziranim portalom pokušali bi smo pronaći lakši put do posla, a isto tako i poslodavcima put do dobrog radnika..</p>
                                <p>Vlasnik ovog portala je udruga <a href="http://www.convoy.hr" target="_blank">Convoy - prijatelji na cesti</a></p>
			</div><!-- widget -->
	
		</div><!-- sidebar -->

</div><!-- .container -->
<?php
$this->load->view('footer');

# end of file /views/signup.php
