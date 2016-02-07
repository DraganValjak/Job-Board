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
                                           <h3>Povezi Me Oglas <span style="color:green;">&DoubleDownArrow;</span></h3>

<?php
   echo form_open('admin/addHitchhiker', 'id="ajax-contact-form-main"');
        echo validation_errors('<p style="color:red;">', '</p>');
  
?>
         <div class="ui-widget">                                  
        <label for="from">Polazak <span>*</span></label>
        <input id="from" class="from" type="text" placeholder="Mjesto, Grad, dio grada…" value="" name="from">
         </div>
          <div class="ui-widget">                                 
        <label for="to">Odredište <span>*</span></label>
        <input id="to" class="to" type="text" placeholder="Mjesto, Grad, dio grada…" value="" name="to">
          </div>
        <div class="clear"></div>
       <label for="at_what_time">U koliko sati ? <span>*</span></label>
        <select class="category" name="at_what_time">
            <option value="" selected="selected">Izaberite sat poaska</option>
<option value="00">00</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
</select>

        <label for="body">Opis, dodatne informacije... </label>
      
        <textarea name="body" class="required sign red" title="Opis, dodatne informacije"> </textarea>
        
        
         <label for="date2">Datum  <span>*</span></label>
         <input type="text" style="width:170px;" name="date_expires" class="datepicker" id="datepicker_2"  readonly="readonly"   class="required sign red"  title="Završni datum oglasa" />
       <div class="clear"></div>
        <input type="submit" class="submit no-margin-bottom" name="submit_add_hitchhiker" value="Predaj oglas"/>
      

  <?php  
  echo form_close();
   ?>
				<div class="clear"></div>
			</div> 
                        <!-- end #contact-form -->


 <script>
jQuery(function() {
jQuery( ".datepicker" ).datepicker({   
minDate: 'today',
showButtonPanel: true
});
});
</script>

<script>
jQuery(function() {
jQuery( "#from, #to" ).autocomplete({
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
                       
                                                 
                                </div><!-- six-->
    
                                <div class="six columns omega">
        
					<ul class="arrow2">
                                        
                                                <li>Mjesto polaska je obavezno</li>
                                                <li>Odredište jo obavezno</li>
						<li>Mjesto polaska i odredište pišite u obliku: mjesto, grad, dio grada. <li>
						<li>Kod pisanja mjesta polaska i odredišta uključije se funkcijonalnost koja vam unaprijed nudi 
                                                moguča polazišta ili odredišta ovisno o početnim slovima koje ste upisali.
                                                Samo kliknite na sugestiju i ona će automatski biti odabrana.</li>
                                                <li>Vrijeme polaska je obavezno, sva odstupanja ili bilo kakve daljnja objašnjenja 
                                                možete opisati u polju za  "Opis i dodatne informacije.."</li>
                                                <li>Polje "Opis i dodatne informacije.." nije obavezno. </li>
                                                <li>Datum je obavezan, kliknite u polje i izaberite datum.</li>
                                                <li>Oglas možete postaviti za određeni datum.</li>
                                                <li>Oglas traje do zadanog datuma i sata, nakon toga oglas nije vidljiv</li>
                                                <li>Sva polja označena * su obavezna.</li>
                                            
                                                
                                              
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

