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
			<div class="sixteen columns">
                            <h4 class="page-title"><?php if(isset($error)){echo $error;}else{ echo 'Posao na brzinu';} ?></h4>
			</div><!-- sixteen columns -->
		</div><!-- .container -->
		<div class="bbottom-1px"></div>
	</div><!-- #separator -->
	<!-- END SEPARATOR -->	
        
        	<!-- START PORTFOLIO WRAPPER -->
	<div class="container main-wrapper">
		<div id="main-content">
                   
                    
			<div id="filterby"></div>
	
			<!-- start filter -->
			<ul id="filters" class="clearfix">
				<li><a href="#" data-filter="*" class="selected">Sve</a></li>
                                <li><a href="<?php echo base_url(); ?>login/company_login">Prijava za poslodavce</a></li>
                                <li><a href="<?php echo base_url(); ?>login/signup">Registracija za korisnike</a></li>
                                <li><a href="<?php echo base_url(); ?>login/company_signup">Registracija za poslodavce</a></li>
                                <li><a href="<?php echo base_url(); ?>login/forgot">Zaboravili ste zaporku?</a></li>
			</ul>
			<!-- end filter -->
                        
                        <div id="container-portfolio" class="portfolio-3">


                            		    	<!-- Item #1 -->
	            <div class="item-block one-third column posao">
					<!-- start item block -->
                                               <div class="block">
                                                   <div class="fast_s">
                                                       <h5>Potražite posao</h5>                              
                         <!--  #contact-form -->
			<div id="contacts-form-main">
                            <?php
                            $attributes = array('id' => 'ajax-contact-form-main');
                        
                            echo form_open(base_url().'jobs/search', $attributes);
                            echo form_label('Kategorija', 'kategorija');
                            echo form_dropdown('category', $category_options,  set_value('category'), 'class="category"');
                            echo form_label('Država', 'država');
                            echo form_dropdown('state', $state_options,  set_value('state'), 'class="category"');
                            echo form_submit('action', 'Traži','class="button cta-button"');
                            echo form_close(); ?>
				<div class="clear"></div>
			</div> 
                        <!-- end #contact-form -->
                                                   </div><!--fast_s-->
						</div><!-- block -->  
				</div><!-- item-block -->
                                <!-- Item #1 end -->
                                
                       <!-- Item #2 -->
	            <div class="item-block one-third column posloprimci">
					<!-- start item block -->
                                                <div class="block">
                                                    <div class="fast_t">
                                                        <h5>Potražite djelatnika</h5>
                         <!--  #contact-form -->
			<div id="contacts-form-main">
                            <?php
                            $attributes = array('id' => 'ajax-contact-form-main');
                        
                            echo form_open(base_url().'workers/search', $attributes);
                            echo form_label('Kategorija', 'kategorija');
                            echo form_dropdown('category', $category_options,  set_value('category'), 'class="category"');
                            echo form_label('Država', 'država');
                            echo form_dropdown('state', $state_options,  set_value('state'), 'class="category"');
                            echo form_submit('action', 'Traži','class="button cta-button"');
                            echo form_close(); ?>
				<div class="clear"></div>
			</div> 
                        <!-- end #contact-form -->
                                                    </div><!-- fast_s-->
						</div><!-- block -->  
				</div><!-- item-block -->
                                <!-- Item #2 end -->
                                
                 <!-- Item #3 -->
	            <div class="item-block one-third column korisnici">
					<!-- start item block -->
                                                <div class="block">
                                                    <div class="fast_v">
                                                        
                                                    <h5>Prijava za korisnike</h5>
                         <!--  #contact-form -->
			<div id="contacts-form-main">
                           <?php echo form_open('login/login_validation');

      echo validation_errors();
      
      echo form_label('Email', 'email');
      echo form_input('email', $this->input->post('email'));
      echo form_label('Zaporka', 'zaporka');
      echo form_password('password');
      echo form_submit('user_submit', 'Prijava');
      echo form_close();
      ?>
                            <p><a href="<?php echo base_url().'login/facebook_request'; ?>"><img  width="100" class="face" src="<?php echo base_url(); ?>images/facebook_login.png"></a></p>
				<div class="clear"></div>
			</div> 
                        <!-- end #contact-form --> 
                       
                        </div><!--fats_s--> 
						</div><!-- block -->  
				</div><!-- item-block -->
                                <!-- Item #3 end -->
                            
                        </div><!-- #container-portfolio -->
                    
                    
                    
                </div><!-- main-content -->
	</div><!-- .container -->

		
	<!-- END PORTFOLIO WRAPPER -->
<?php
$this->load->view('footer');

# end of file /views/front.php
