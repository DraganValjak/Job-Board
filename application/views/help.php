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
                            <h4 class="page-title">Vodič za nove korisnike</h4>
			</div><!-- sixteen columns -->
		</div><!-- .container -->
		<div class="bbottom-1px"></div>
	</div><!-- #separator -->
	<!-- END SEPARATOR -->	
        
        	<!-- START PORTFOLIO WRAPPER -->
	<div class="container main-wrapper">
		<div id="main-content">
             <p><?php 
				$url = current_url();
                           $text = 'Vodič za nove korisnike, kako koristiti Posao na brzinu'; 
                   echo  share_button('facebook',array('url'=>$url, 'text'=>$text));?></p>
                    <h4>Tražite ili nudite posao ?</h4>
                    <h6>Posloprimci</h6>
                    <p>U transportu su, osim vozača bitni i drugi sudionici koji čine krug: vozači, dispečeri, skladištari Stoga smo odlučili na ovom specijaliziranom portalu 
                        omogućiti potražnju i ponudu istih. U koliko nemate posao ili ga želite promijeniti svoju ponudu možete postaviti ovdje. .</p>
                    <h6>Poslodavci</h6>
                    <p>Poslodavci, ponekad se čini nemoguće naći dobrog i kvalitetnog radnika. Ovaj specijalizirani portal vam nudi brz i uspješan pronalazak 
                        djelatnika sa karakteristikama koje vi tražite. Svoje potrebe za vozačima, dispečerima i skladištarima oglasite ovdje .</p>
                    <div class="divider-page-1px"></div>
			<!-- LISTS -->
			
			<div class="row">
				<div class="six columns alpha">
                                    <h5>Kako koristiti 'Posao na brzinu'</h5>
					<ul class="disc">
						<li>Napravite profil</li>
						<li>Kad ste se uspiješno registrirali, možete promijeniti sliku, poslati email sa web stranice i pozvati prijatelje da vam se  pridruže, promijeniti podatke, zaporku...</li>
						<li>Samom registracijom vaš profil nije javan, niti je vidljivi ostalim  korisnicima web stranice. </li>
                                                <li>Kada napravite vaš prvi oglas,aktivirali ste vašu vidljivost na web stranici do datuma završetka oglasa.</li>
                                                <li>Vašim oglasima možete upravljati. Možete ih promijeniti ili jednostavno izbrisati.</li>
                                                <li>Kada istekne datum završetka oglasa vaš profil više nije vidljiv. </li>
					</ul>
				</div><!-- six -->
                        </div><!--row-->
                       
                        <p>Vlasnik ovog web servisa je <a href="mailto:udruga@convoy.hr"> udruga Convoy - prijatelji na cesti</a></p>
                </div><!-- main-content -->
	</div><!-- .container -->

		
	<!-- END PORTFOLIO WRAPPER -->
<?php
$this->load->view('footer');

# end of file /views/front.php
