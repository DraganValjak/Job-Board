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
				<h4 class="page-title">Zaboravljena zaporka</h4>
			</div><!-- sixteen columns -->
		</div><!-- .container -->
		<div class="bbottom-1px"></div>
	</div><!-- #separator -->
	<!-- END SEPARATOR -->	

        <!-- START PAGE WRAPPER -->
	<div class="container main-wrapper">
		<div id="main-content" class="sixteen columns">
                    <div class="row remove-bottom clearfix">
                        <h5>Izaberite tip korisnika, upišite vašu email adresu i poslati ćemo vam privremenu zaporku na vaš email...</h5>
                                                 <!--  #contact-form -->
			<div id="contacts-form-main">
                             <?php
                             $category_options = array(''=>'Izaberite tip korisnika','primac'=>'Korisnik', 'pos'=>'Poslodavac');
        echo form_open('login/forgot_validation', 'id="ajax-contact-form-main"');
        echo validation_errors('<p style="color:red;">', '</p>');
        echo form_label('Vi ste:', 'category');
        echo form_dropdown('category', $category_options, set_value('category'), 'class="category red"');
        ?>
         <label for="email">Email <span>*</span></label>
        <input type="email" name="email" required   class="required sign red" title="Vaš email" />
        <input type="submit" class="submit no-margin-bottom" name="submit" value="Pošaljite zahtijev"/>
        <?php echo form_close(); ?>
				<div class="clear"></div>
			</div> 
                        <!-- end #contact-form -->
                    </div><!--row remove-bottom clearfix-->
                    
                    	</div><!-- main-content -->
		
	</div><!-- .container -->
<?php
$this->load->view('footer');

# end of file /views/forgot.php
