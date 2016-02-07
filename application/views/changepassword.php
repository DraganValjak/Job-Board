<?php
$this->load->view('header');
?>
	<!-- START SEPARATOR  -->
	<div id="separator">
		<div class="btop-1px"></div>
		<div class="container">
			<!-- start separator -->
			<div class="sixteen columns">
				<h4 class="page-title">Posao na brzinu</h4>
			</div><!-- sixteen columns -->
		</div><!-- .container -->
		<div class="bbottom-1px"></div>
	</div><!-- #separator -->
	<!-- END SEPARATOR -->	
        
        
               <!-- START PAGE WRAPPER -->
	<div class="container main-wrapper">
		<div id="main-content" class="sixteen columns">
                    <div class="row remove-bottom clearfix">
                        <h5>Promijenite zaporku</h5>
                                                 <!--  #contact-form -->
			<div id="contacts-form-main">
                             <?php
 
        echo form_open('login/change_password', 'id="ajax-contact-form-main"');
        echo validation_errors('<p style="color:red;">', '</p>');
        echo form_hidden('email',$email);
        ?>
         <label for="zaporka">Nova zaporka </label>
        <input type="password" name="password" required   class="required sign red" title="Nova zaporka" />
        <label for="zaporka">Ponovite zaporku </label>
        <input type="password" name="cpassword" required   class="required sign red" title="Ponovite zaporku" />
        <input type="submit" class="submit no-margin-bottom" name="submit" value="Pošalji"/>
        <?php echo form_close(); ?>
				<div class="clear"></div>
			</div> 
                        <!-- end #contact-form -->
                    </div><!--row remove-bottom clearfix-->
                    
                    	</div><!-- main-content -->
		
	</div><!-- .container -->
<?php
$this->load->view('footer');

# end of file /views/changepassword.php
