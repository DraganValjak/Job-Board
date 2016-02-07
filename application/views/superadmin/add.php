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
					<ul id="nav" class="sf-menu">
                                                 <li><a href="<?php echo base_url(); ?>superadmin/add" class="button cta-button">Admin posao</a></li>
						 <li><a href="<?php echo base_url().'jobs/listings'; ?>" class="button cta-button">Poslovi</a></li>
		                                 <li><a href="<?php echo base_url().'workers/listings'; ?>" class="button cta-button">Posloprimci</a></li>
                                                 <li><a href="<?php echo base_url().'drive/hitchhikers'; ?>" class="button cta-button">Povezi Me</a></li>
                                                  <li><a href="<?php echo base_url()."login/logout" ?>" class="button cta-button">Odjava</a></li>
	
				 	</ul>  <!-- end #nav  -->
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
                                <li><a class="active" href="<?php echo base_url(); ?>superadmin/index">Posloprimci</a></li>
                                <li><a  href="<?php echo base_url(); ?>superadmin/company">poslodavci</a></li>
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
                                           <h3>Oglas Za Posao <span style="color:green;">&DoubleDownArrow;</span></h3>

<?php
   echo form_open('superadmin/add', 'id="ajax-contact-form-main"');
        echo validation_errors('<p style="color:red;">', '</p>');
  
?>
     
         <label for="naslov">Naslov oglasa <span>*</span></label>
         <input type="text" name="title" required   class="required sign red" value="" title="Naslov oglasa" />
         <label for="ime">Naziv poslodavca <span>*</span></label>
         <input type="text" name="name" required   class="required sign red" value="" title="Naziv poslodavca" />
         <label for="lokacija">Lokacija poslodavca <span>*</span></label>
         <input type="text" name="user_location" required   class="required sign red" value="" title="Lokacija poslodavca" />
         <label for="drzava">Država poslodavca <span>*</span></label>
          <?php echo form_dropdown('state_id', $state_options_admin,  set_value('state_id'), 'class="category"'); ?>
         <label for="telefon">Telefon <span>*</span></label>
         <input type="text" name="user_tel"  class="required sign red" value="" title="Telefon" />
         <label for="email">Email <span>*</span></label>
         <input type="text" name="user_email"  class="required sign red" value="" title="Email" />
         <?php
         echo form_label('Kategorija posla','categories');
         echo form_dropdown('category', $add_categories,  set_value('category'),'class="category"');
         ?>
        <label for="type">Tip posla <span>*</span></label>
        <select class="category" name="job_type">
            <option value="Za stalno" selected="selected">Za stalno</option>
            <option value="Na određeno">Na određeno</option>
        </select>
        
                <label for="expirence">Iskustvo <span>*</span></label>
        <select class="category" name="exspirience">
            <option value="Najmanje godinu dana" selected="selected">Najmanje godinu dana</option>
            <option value="Više od dvije godine">Više od dvije godine</option>
            <option value="Više od tri godine">Više od tri godine</option>
            <option value="Više od četiri godine">Više od četiri godine</option>
            <option value="Više od pet godina">Više od pet godina</option>
        </select>
                
        <label for="license">Potrebne vozačke dozvole? <span>*</span></label>
        <div class="collapse-styling red">
				<h6>Izaberite </h6>
				<div class="toggle-content">
        <?php foreach ($license as $l): ?>
        <p><strong style="width:20px; display:inline-block;"><?php echo $l['name']; ?></strong>
        <input style="margin-left:30px;" type="checkbox" name="newlicences[]" id="licenses" value="<?php echo $l['name']; ?>" />
        <p>
         <?php endforeach; ?>
				</div><!-- .toggle-content -->
			</div><!-- .collapse-demo1 -->
                        <label for="body">Opis posla </label>
        
        <textarea name="body" class="required sign red" title="O vama"> </textarea>
        
        <label for="date">Datum početka oglasa </label>
         <input type="text" style="width:170px;" name="date_created"  class="datepicker" id="datepicker_1"  readonly="readonly"   class="required sign red"  title="Početni datum oglasa" />
         <div class="clear"></div>
         <label for="date2">Datum zavšetka oglasa <span>*</span></label>
         <input type="text" style="width:170px;" name="date_expires" class="datepicker" id="datepicker_2"  readonly="readonly"   class="required sign red"  title="Završni datum oglasa" />
       <div class="clear"></div>
        <input type="submit" class="submit no-margin-bottom" name="submit_add_driver" value="Predaj oglas"/>
      

  <?php  
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
                                                <li>Datum početka oglasa nije obavezan. Ako ga ne postavite, datum početka oglasa biti će odmah.</li>
                                                <li>Datum početka oglasa nije moguče postaviti unatrag od trenutnog datuma.</li>
                                                <li>Datum kraja oglasa je obavezan.</li>
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

