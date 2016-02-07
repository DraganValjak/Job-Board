<?php
$this->load->view('header');
$this->load->view('top_panel');
?>
<!-- START SEPARATOR  -->
	<div id="separator">
		<div class="btop-1px"></div>
		<div class="container">
			<!-- start separator -->
			<div class="cta-block">
                            
                                
                                

				<div class="twelve columns navigation" style="float:right !important;">
				<div id="menu" class="fix-fish-menu">
					<?php  $this->load->view('admin/meni/glavni_navbar');?>
			 	</div>	<!-- end #menu  -->	
			</div><!-- .twelve columns -->
			
                                
                                
                  <h4 class="page-title"><?php echo $name = (isset($user->last_name)) ? $user->user_name . ' ' . $user->last_name : $user->user_name; ?></h4>
                                
                             <img src="<?php echo $user->user_image ?>" title="<?php echo $user->user_name; ?>" width="100" height="100" />   
                                              
                                
                                
                                
                                
                                
                                
			</div><!-- sixteen columns -->
		</div><!-- .container -->
		<div class="bbottom-1px"></div>
	</div><!-- #separator -->
	<!-- END SEPARATOR -->	
        
        
            <!-- START PAGE WRAPPER -->
	<div class="container main-wrapper">
            <div id="main-content" class="twelve columns">
                <div>
                <h5 style="color:red; margin-bottom: 10px;" ><?php echo  $this->session->flashdata('change_user_data'); ?></h5>
                </div>
                    
                       
                			<!-- start filter -->
			<ul id="filters" class="clearfix">
                                <li><a href="<?php echo base_url(); ?>admin/index">Oglasi</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/change_image">Slika</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/change_password">Zaporka</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/change_profil">Profil</a></li>
                                <li><a class="active" href="<?php echo base_url(); ?>admin/sending_emails">Pošalji email</a></li>
			</ul>
			<!-- end filter -->
                        
                        <div class="clear"></div>
<div class="row">
				<div class="six columns alpha">
                                          
                                       <div id="contacts-form-main">
                             <?php
        echo form_open(base_url().'send_email/send', 'id="ajax-contact-form-main"');
        echo validation_errors('<p style="color:red;">', '</p>');
        ?>

        <label for="email">Email<span>*</span></label>
        <input type="email" name="email" required   class="required sign red"   title="Email" />  

        <label for="message">Poruka </label>
        <textarea name="message" required class="required sign red" title="Poruka"> </textarea>
        

        <input type="submit" class="submit no-margin-bottom" name="submit_email" value="Promijeni"/>

          <?php echo form_close(); ?>             
                        </div>                         
                                </div><!-- six-->

                                
    <div class="six columns omega">
					<ul class="arrow2">
                                                <li>Pošaljite email!</li>
						<li>Email je obavezan</li>
						<li>Poruka je obavezna</li>
                                                <li>Sva polja su obavezna *</li>
					</ul>
				</div><!-- six-->
</div><!-row-->

        
        
        
        		</div><!-- main-content -->

                
<?php
$this->load->view('admin_sidebar');
?>
                
</div><!-- .container -->
      
<?php
$this->load->view('admin_footer');


