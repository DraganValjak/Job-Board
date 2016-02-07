<!-- START TOP PANEL -->
<?php if(isset($alert)){ print "<script type=\"text/javascript\">alert($alert);</script>";}?>
	<div id="top-panel">
		<div class="container panel">
			<div class="four columns location-map">
				<h6>O nama</h6>
				<div class="gray-dash-3px"></div>
                                <p>Vlasnik web stranice 'Posao na brzinu' je udruga profesionalnih vozača Convoy.
                                    Više o udruzi saznajte na ovom linku: <a href="http://convoy.hr" target="_blank">www.convoy.hr</a></p>
			</div><!-- .four -->		
			<div class="four columns">
				<h6>Kontakt info</h6>
				<div class="gray-dash-3px"></div>
				<ul id="contact-info" class="widget clearfix">
					<li class="location">Varaždinska 76<br>40305 Nedelišće, Hrvatska</li>
					<li class="phone">telefon: +385-98-303-508</li>
					<li class="email"><a href="mailto:udruga@convoy.hr">udruga@convoy.hr</a></li>
				</ul>
			</div><!-- .four -->
			<div class="eight columns">
				<h6>Imate pitanje?</h6>
				<div class="gray-dash-3px"></div>
	        <fieldset class="info_fieldset_top">
	            <div id="note-top"></div>
	            <div id="contacts-form">
                      <?php echo form_open(base_url().'send_email/emailsending', 'id="ajax-contact-form"');  ?>
                            <?php echo validation_errors('<p style="color:red;"></p>');?>
		            	<input type="text" name="newname"   id="newname" required placeholder="Vaše ime" class="required" />
		                <input type="email" name="newemail"  id="newemail" required  placeholder="Vaš email" class="last-item required" />                
		                <div class="clear"></div>
		                <textarea name="newmessage" id="newmessage" required placeholder="Vaša pitanja idu ovdije..."></textarea>
		                <input type="submit" class="submit no-margin-bottom"  value="Pošalji poruku"/>
		                <span></span>
		         <?php echo form_close(); ?>
					<div class="clear"></div>
				</div> <!-- end #contact-form -->
			</fieldset>
			</div><!-- .eight -->
		</div><!-- .container -->
		<div class="toggle colored-bg">
			<a href="#" title="Pandora's Box!"></a>
		</div><!-- .toggle -->
	</div><!-- #top-panel -->
	<!-- END TOP PANEL -->
