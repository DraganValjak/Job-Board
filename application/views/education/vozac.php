<?php
$this->load->view('./header');
$this->load->view('./top_panel');
$this->load->view('./navigation');
?>



<!-- START SEPARATOR  -->
	<div id="separator">
		<div class="btop-1px"></div>
		<div class="container">
			<!-- start separator -->
			<div class="sixteen columns">
                            <h4 class="page-title">PROGRAM PREKVALIFIKACIJE ZA ZANIMANJE VOZAČ MOTORNOG VOZILA</h4>
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
                           $text = 'PROGRAM PREKVALIFIKACIJE ZA ZANIMANJE VOZAČ MOTORNOG VOZILA'; 
                   echo  share_button('facebook',array('url'=>$url, 'text'=>$text));?></p>
             <h5><a href="http://www.mazda-start.hr" target="_blank">Pučko otvoreno učilište NOVAK Mala Subotica</a>, Braće Radića 69, PODRUŽNICA ČAKOVEC, ZELENA 1, tel. 040/312-113, mob.099/2141890,OIB:84728804906</h5>
             <p>&nbsp;</p>
             <p>CILJ programa obrazovanja za zanimanja vozač motornog vozila je stjecanje znanja, vještina i stajališta za osobni razvoj i daljnje učenje, 
                 te stjecanje praktičnih i teorijskih znanja i vještina za obavljanje poslova vozač/ica motornog vozila.  </p>
              <p>&nbsp;</p>
             <p>UVJETI ZA UPIS     U obrazovni program mogu se upisati svi polaznici koji su završili srednjoškolsko obrazovanje.</p>
              <p>&nbsp;</p>
             <p>TRAJANJE OBRAZOVANJA     Cjelokupan program prekvalifikacije provodi se u trajanju od najmanje  </p>
               <p>&nbsp;</p>
              <p>UPISNA DOKUMENTACIJA     Domovnica, rodni list, razredne svjedodžbe, svjedodžba o završenoj srednjoj školi, 
                  vozačka dozvola „C“ kategorije ili „B“ kategorije uz liječničko uvjerenje za vozača „C“ kategorije, jedna slika.</p>
             <p>&nbsp;</p>
               <p>NAČIN IZVOĐENJA NASTAVE     Nastava se izvodi dopisno-konzultativnom nastavom, sukladno izvedbenom planu i programu koji je odobren 
                   od Ministarstva znanosti, obrazovanja i sporta. Teorijski dio nastave održava se u prostorima 
                   Pučkog otvorenog učilišta „Novak“ Mala Subotica, Podružnica Čakovec, Zelena 1, a praktični dio programa u licenciranim radionama. </p>
                     <p>&nbsp;</p>
                     <p>ZAVRŠETAK OBRAZOVANJA     Polaznici nakon položenih predmetnih ispita prekvalifikaciju završavaju izradom i obranom završnog rada u organizaciji i 
                         provedbi škole. Polaznici dobivaju 
                         Svjedodžbe o položenim predmetnim ispitima i Svjedodžbu o završnom radu koju mogu upisati u radnu knjižicu.</p>
                     <p>&nbsp;</p>
                     
                    <h6>POČETAK OBRAZOVNE GRUPE    OŽUJAK 2014.</h6>
               
                    <h6>DODATNE INFORMACIJE     tel. 040/312-113, mob. 099/2141890 Dubravka Sklepić</h6>
                    <h6><a href="http://sdrv.ms/1ckwoRF" target="_blank">Preuzmite upisnicu </a></h6>
			<!-- LISTS -->
			
		
                       <div class="divider-page-1px"></div>
                        <p>Vlasnik ovog web servisa je <a href="mailto:udruga@convoy.hr"> udruga Convoy - prijatelji na cesti</a></p>
                </div><!-- main-content -->
	</div><!-- .container -->

		
	<!-- END PORTFOLIO WRAPPER -->



<?php
$this->load->view('./footer');
