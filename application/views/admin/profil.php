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
                                <li><a class="active" href="<?php echo base_url(); ?>admin/change_profil">Profil</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/sending_emails">Pošalji email</a></li>
			</ul>
			<!-- end filter -->
                        
                        <div class="clear"></div>
<div class="row">
				<div class="six columns alpha">
                                          
                                       <div id="contacts-form-main">
                             <?php
        echo form_open('admin/change_profil', 'id="ajax-contact-form-main"');
        echo validation_errors('<p style="color:red;">', '</p>');
        ?>
         <label for="ime">Ime <span>*</span></label>
        <input type="text" name="user_name" required   class="required sign red"  value="<?php echo $user->user_name; ?>" title="Vaše ime" />
        <?php if($user->type == '0'): ?>
         <label for="prezime">Prezime <span>*</span></label>
        <input type="text" name="last_name" required   class="required sign red" value="<?php echo $user->last_name; ?>" title="Vaše prezime" />
        <?php endif; ?>
         <label for="email">Email<span>*</span></label>
        <input type="email" name="email" required   class="required sign red"  value="<?php echo $user->email; ?>" title="Email" />  
        <label for="lokacija">Adresa <small> Ulica, kućni broj, mjesto</small><span>*</span></label>
        <input type="text" name="location" required class="required sign red" value="<?php echo $user->location; ?>"  title="Ulica, kućni broj, mjesto"  />
        <label for="state">Država <span>*</span></label>
        <p>Vaša država je:  <strong><?php echo $state_options[$user->state_id]?></strong></p>
        <p>Ako želite promijeniti državu:</p>
       <?php echo form_dropdown('state', $state_options_admin,  set_value('state', $user->state_id), 'class="category"'); ?>
        <label for="tel">Telefon <span>*</span></label>
        <input type="number" name="tel"    class="required sign red" value="<?php echo $user->tel; ?>" title="Vaš telefon"  />
        <label for="about">Ponešto o vama </label>
        <textarea name="about" class="required sign red" title="O vama"> <?php echo $user->about; ?></textarea>
        <label for="web">Web stranica, Facebook </label>
        <input type="text" name="web"  class="required sign red"  value="<?php echo $user->url; ?>" title="Vaša web stranica"  /> 
        
        <label for="license">Za koja vozila ili skup vozila imate  dozvolu? <span>*</span></label>
        <p>Vaše trenutne kategorije su:  <strong><?php echo $user->license;?></strong></p>
        <input type="hidden" type="text" name="license" value="<?php echo $user->license;?>" />
        <div class="collapse-styling red">
				<h6>Želite li promijeniti vaše kategorije ?</h6>
				<div class="toggle-content">
                                    <p>Ponovo unesite sve kategorije.</p>
        <?php foreach ($license as $l): ?>
        <p><strong style="width:20px; display:inline-block;"><?php echo $l['name']; ?></strong>
        <input style="margin-left:30px;" type="checkbox" name="newlicences[]" id="licenses" value="<?php echo $l['name']; ?>" />
        <p>
         <?php endforeach; ?>
				</div><!-- .toggle-content -->
			</div><!-- .collapse-demo1 -->

        <input type="submit" class="submit no-margin-bottom" name="submit_profil" value="Promijeni"/>
        <?php echo form_close(); ?>

				<div class="clear"></div>
			</div> 
                        <!-- end #contact-form -->
                        
                        <script>                      
                        /*******************************
			COLLAPSE
********************************/

	jQuery(document).ready(function() {
	
           jQuery('div.toggle-content').css('display','none');
           jQuery('.collapse-styling h6').on('click', function(){
               jQuery('div.toggle-content').slideToggle();
           })
   
            });
         

</script>
                       
                                                 
                                </div><!-- six-->
    
    <div class="six columns omega">
					<ul class="arrow2">
                                                <li>Promijenite vaše ime, prezime.</li>
						<li>Promijenite email</li>
						<li>Promijenite adresu</li>
                                                <li>Promijenite državu</li>
                                                <li>Promijenite telefon</li>
                                                <li>Napišie nešto o sebi</li>
                                                <li>Imate web ili Facebook ?</li>
                                                <li>Promijenite kategorije vozačke dozvole</li>
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

