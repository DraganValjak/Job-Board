


		<!-- START SIDEBAR -->
		<div id="sidebar" class="four columns">

 <?php 
 $user= array();
 if($this->session->userdata('is_logged_in') == 1){
     $user = $this->session->all_userdata();
     /*
      * u array user spremamo sve podatke o korisniku
      * Korisnik je logiran, sada imamo dvije opcije
      * poslodavac i posloprimac
      */
     
    ?>
        
                    
     <div class="widget clearfix">
         <h6><img src="<?php echo $user['user_image'];?>" alt="<?php echo $user['user_name']; ?>" width="40" height="40" /> &nbsp;<?php echo $user['user_name']; ?></h6>
				<div class="clear"></div>
				<ul class="tags">
					<li><a href="<?php echo site_url('admin/add');?>" style="border: 1px solid #2E21E4;" class="button tag-button">+ Oglas Za Posao</a></li>
                                        <?php if($this->session->userdata('type') == '0'){ ?>
                                        <li><a href="<?php echo site_url('admin/addHitchhiker');?>" style="border: 1px solid #FF7E00;" class="button tag-button">+ Povezi Me Oglas</a></li>
                                        <?php }?>
					<li><a href="<?php echo site_url('admin/index');?>" class="button tag-button">Upravljačka ploča</a></li>
                                        <li><a href='<?php echo site_url('login/logout')?>' class="button tag-button">Odjava</a></li>
									
				</ul>
				
			</div><!-- widget -->  
 
 <?php }else{  ?>
                        <div class="widget clearfix">
                            <ul class="tags">
					<li><a href="<?php echo site_url().'login';?>" class="button" style=" border: 1px solid #FF7E00 !important;">Prijavite se</a></li>
                                        <li><a href="<?php echo base_url().'login/facebook_request'; ?>"><img  width="100" class="face_button" src="<?php echo base_url(); ?>images/sidebar_login.png"></a></li>
                            </ul>
                        
                        </div>
 <?php  } // if user kraj?> 
                    

                        
                        
                      <div class="fast_s">
                        <div id="contacts-form-main" style="padding-right: 10px;">
                            <h6>Brza pretraga</h6>
                         
                            <?php
                            // ako je uri segment == drive, tražimo samo državu
                            $attributes = array('id' => 'ajax-contact-form-main');
                            echo form_open(base_url(). $this->uri->segment(1).'/search', $attributes);
                            if($this->uri->segment(1) == 'drive'){  ?>
                            <div class="ui-widget">  
                            <label for="from">Mjesto polaska <span>*</span></label>
                            <input  class="category" id="set" type="text" placeholder="Mjesto, Grad, dio grada…" value="" name="set">
                            </div>
                           <?php  }else{
                            echo form_label('Kategorija', 'kategorija');
                            echo form_dropdown('category', $category_options,  set_value('category'), 'class="category"');
                            echo form_label('Država', 'država');
                            echo form_dropdown('state', $state_options,  set_value('state'), 'class="category"');
                            }
                            echo form_submit('action', 'Traži','class="button cta-button"');
                            echo form_close(); 
                            ?>
				<div class="clear"></div>
			</div> <!-- end #contact-form -->
                            </div> 
                               
                        </div><!-- widget -->


	<script type="text/javascript">
jQuery(function() {
jQuery( "#set" ).autocomplete({
source: function( request, response ) {
jQuery.ajax({
url: "http://ws.geonames.org/searchJSON?&continentCode=EU",
dataType: "jsonp",
data: {
featureClass: "P",
style: "full",

maxRows: 10,
name_startsWith: request.term
},
success: function( data ) {
response( jQuery.map( data.geonames, function( item ) {
return {
label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
value: item.name
}
}));
}
});
},
minLength: 2,
select: function( event, ui ) {
event.preventDefault();
var value = jQuery.trim(ui.item.label);
jQuery(this).val(value);
},
open: function() {
jQuery( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
},
close: function() {
jQuery( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
}
});
});
</script>		


		</div><!-- sidebar -->
	

		
	<!-- END BLOG WRAPPER -->


