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
                           $text = 'Vodič za nove korisnike, kako koristiti Povezi Me'; 
                   echo  share_button('facebook',array('url'=>$url, 'text'=>$text));?></p>
                    <h4>Povezi Me!</h4>
                    
                    <h6>Nova funkcijonalnost web servisa 'Posao Na Brzinu' </h6>
                    <p>Koliko puta ste bili u prilici stopirati? Morali ste ostaviti kamion negdje ili ste se jednostavno trebali prebaciti na posao. 
                        Ovim servisom željeli bismo potaknuti solidarnost među vozačima, upoznvanje vozača,  a ujedno olakšati pronalaženje prijevoza do potrebnog odredišta. 
                    Web aplikacija je vrlo jednostavna za korištenje i responsivnog je dizajna što znaći 
                    da se može koristiti bez ikakvih zapreka ili smetnji na svim uređajima (mobiteli, tableti, laptop....) </p>
                    <div class="divider-page-1px"></div>
			<!-- LISTS -->
			
			<div class="row">
				<div class="six columns alpha">
                                    <h5>Kako koristiti 'Povezi Me'</h5>
					<ul class="disc">
						<li>Napravite profil</li>
						<li>Kad ste se uspiješno registrirali, možete promijeniti sliku, poslati email sa web stranice i pozvati prijatelje da vam se  pridruže, promijeniti podatke, zaporku...</li>
						<li>Samom registracijom vaš profil nije javan, niti je vidljivi ostalim  korisnicima web stranice. </li>
                                                <li>Kada napravite vaš prvi 'Povezi Me' oglas ,aktivirali ste vašu vidljivost na web stranici do datuma završetka 'Povezi Me' oglasa.</li>
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
