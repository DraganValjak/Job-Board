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
                                <li><a href="<?php echo base_url(); ?>admin/sending_emails">Pošalji email</a></li>
			</ul>
			<!-- end filter -->
                        
                        <div class="clear"></div>
<div class="row">
				<div class="six columns alpha">
                                          
                                       <div id="contacts-form-main">
                                           <h3>Uredite oglas <span style="color:green;">&DoubleDownArrow;</span></h3>

<?php
   echo form_open('admin/edit_advertisement/'.$this->uri->segment(3), 'id="ajax-contact-form-main"');
        echo validation_errors('<p style="color:red;">', '</p>');
      
  foreach($advertisement as $advert):
?>
     
         <label for="naslov">Naslov oglasa </label>
         <input type="text" name="title" required   class="required sign red" value="<?php echo $advert['title']; ?>" title="Naslov oglasa" />
         <?php
         echo form_label('Izaberite kategoriju posla','categories');
         echo form_dropdown('category', $add_categories,   set_value('category'),'class="category"');
         ?>
        <label for="type">Izaberite tip posla</label>
   
        <select class="category" name="job_type">
            <option value="Za stalno">Za stalno</option>
            <option value="Na određeno">Na određeno</option>
        </select>
        
                <label for="expirence">Ponovo izaberite potrebno iskustvo</label>
      
        <select class="category" name="expirience">
            <option value="Najmanje godinu dana">Najmanje godinu dana</option>
            <option value="Više od dvije godine">Više od dvije godine</option>
            <option value="Više od tri godine">Više od tri godine</option>
            <option value="Više od četiri godine">Više od četiri godine</option>
            <option value="Više od pet godina">Više od pet godina</option>
        </select>
                <?php if($this->session->userdata('type') == '1'){ ?>
        <label for="license">Tražene kategorije su:  <strong><?php echo $advert['job_license'];?></strong></label>
 
        <input type="hidden" type="text" name="license" value="<?php echo $advert['job_license']; ?>" />
        <div class="collapse-styling red">
				<h6>Želite li promijeniti tražene kategorije ?</h6>
				<div class="toggle-content">
                                    <p>Ponovo unesite sve kategorije.</p>
        <?php foreach ($license as $l): ?>
        <p><strong style="width:20px; display:inline-block;"><?php echo $l['name']; ?></strong>
        <input style="margin-left:30px;" type="checkbox" name="newlicences[]" id="licenses" value="<?php echo $l['name']; ?>" />
        <p>
         <?php endforeach; ?>
				</div><!-- .toggle-content -->
			</div><!-- .collapse-demo1 -->
                        <label for="body">Opis posla </label>
                        <?php }else{ ?>
        <label for="body">Vaše preporuke </label>
        <?php } ?>
        <textarea name="body" class="required sign red" title="O vama"> <?php echo $advert['body'] ?></textarea>
        
        <label for="date">Početak oglasa <?php  echo hr_oblik_datuma($advert['date_created']) ?></label>
        <p>Kliknite u polje promijenite datum</p>
        <input type="hidden" type="text" name="date_created" value="<?php echo $advert['date_created']; ?>" />
         <input type="text" style="width:170px;" name="new_date_created"  class="datepicker" id="datepicker_1"  readonly="readonly"   class="required sign red"  title="Početni datum oglasa" />
         <div class="clear"></div>
         <label for="date2">Završetak oglasa <?php  echo hr_oblik_datuma($advert['date_expires']) ?> </label>
        <p>Kliknite u polje promijenite datum</p>
        <input type="hidden" type="text" name="date_expires" value="<?php echo $advert['date_expires']; ?>" />
         <input type="text" style="width:170px;" name="new_date_expires" class="datepicker" id="datepicker_2"  readonly="readonly"   class="required sign red"  title="Završni datum oglasa" />
       <div class="clear"></div>
        <input type="submit" class="submit no-margin-bottom" name="submit" value="Uredi oglas"/>
      

  <?php 
endforeach;
  echo form_close();
   ?>
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

 <script>
jQuery(function() {
jQuery( ".datepicker" ).datepicker({   
minDate: 'today',
showButtonPanel: true
});
});
</script>
                       
                                                 
                                </div><!-- six-->
    
                                <div class="six columns omega">
        
					<ul class="arrow2">
                                        
                                                <li>Naziv oglasa je obavezan.</li>
                                                <li>Kategorija posla je obavezna.</li>
						<li>Tip posla je: 'za stalno', ako drugačije ne izaberete<li>
						<li>Potrebno iskustvo: 'nije potrebno', ako drugačije ne izaberete</li>
                                                <li>Izaberite potrebne vozačke kategorije</li>
                                                <?php if($this->session->userdata('type') == '1') { ?>
                                                <li>Opis posla je obavezan</li>
                                                <?php }else{ ?>
                                                <li>Preporuke nisu obavezne</li>
                                                <?php } ?>
                                                <li>Datum početka oglasa možete promijeniti.</li>
                                                <li>Datum početka oglasa možete promijeniti.</li>
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

