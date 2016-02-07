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
                            <h4 class="page-title">Seminari za rukovanje tahografima</h4>
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
                           $text = 'Seminari za rukovanje tahografima'; 
                   echo  share_button('facebook',array('url'=>$url, 'text'=>$text));?></p>
             <h5><a href="http://www.tahograf.hr" target="_blank">Tahograf d.o.o.</a>, Dr.Franje Tuđmana 24, 10431 Sveta Nedelja, Hrvatska</h5>
             <p>&nbsp;</p>
             <p>Zahvaljujući  dugodišnjoj  suradnji poduzeča Tahograf  d.o.o  i  udruge Convoy u mogučnosti  smo našim članovima i simpatizerima udruge  
                 ponuditi jeftinije seminare za rukovanjima tahografima.  Prema zakonu o radnom vremenu, obveznim odmorima mobilnih radnika i uređajima za bilježenje 
                 u cestovnom prometu, obavezne su edukacije vozača.  Prijevoznička poduzeča obavezna su educirati svoje djelatnke i  druge prometne radnike u smislu 
                 provođenja  odredbi o radnom vremenu i 
                 obaveznim odmorima mobilnih radnika.  No isto tako edukaciju može polaziti svaki mobilni djelatnik prema vlastitom  nahođenju, neovisno od poslodavca.</p>
             <h5>Vrste seminara:</h5>
             <h6>1. Seminari za rukovanje s analognim tahografima </h6>
             <p>Na ovim seminarima vozače i prometne rukovoditelje učimo kako se upotrebljavaju analogni tahografi. Seminare organiziramo za najmanje 10 slušatelja, a gornja granica je 20 slušatelja u jednoj grupi. Krene se s teorijskom obukom tko uopće mora voditi evidenciju, tko je izuzet, kako voditi evidenciju (da li je riječ o vozaču u međunarodnom prometu koji spava u kabini ili o vozaču koji spava doma svako veće), nabrajaju se greške pri evidenciji, uči se kako u istom danu voziti više vozila i to evidentirati na istom listiću itd. 
              Na seminaru, svaki vozač dobije Priručnik o korištenju tahografa kao i etui za spremanje taho listića. Uz to dobiju se sitni pokloni poput VDO lampe, štoperice, bloka za pisanje, olovke i sl. 
                Cijena : 350 kn + PDV. </p>
           <h6>2. Seminari za rukovanje s digitalnim tahografima </h6>
             <p>Ovo je drugi tip seminara koji u posljednje vrijeme postaje još zanimljiviji vozačima. Seminare organiziramo za najmanje 4 slušatelja, a gornja granica je 12 slušatelja. Ovo stoga što se drugi dio seminara odvija na simulatorima (imamo ih tri komada) pa veći broj slušatelja nije efektan. Na ovim seminarima prvo ponovimo priču kako se vodi evidencija pomoću analognih tahografa, a onda to isto primijenimo na digitalne tahografe. Vježba se na školskim tahografima sa školskim karticama, tako da vozači ne moraju (i ne mogu) upotrebljavati svoje kartice. 
               Na ovom seminaru svaki vozač dobije upute na hrvatskom jeziku kako se rukuje s VDO digitalnim tahografom (postoje dvije vrste upute - u ovisnosti o tome da li tahograf ima ili nema jednominutno pravilo). Iona ovom seminaru se dobiju sitni pokloni poput VDO lampe, štoperice, bloka za pisanje, olovke i sl. 
               Cijena:  450 kn + PDV. </p>
               <h6>Gdje su seminari?</h6>
              
               <p>Seminari se organiziraju  subotom u prostorijama poduzeča Tahograf d.o.o Sveta Nedelja
                 No postoji mogučnost organiziranja seminara u vašem gradu (mjestu), pod uvijetom da se nađe dovoljan broj kandidata za određenu vrstu seminara.</p>
               <h6>kako do seminara?</h6>
               <p>Kontaktirajte na s na email: <a href="mailto:udruga@convoy.hr">udruga@convoy.hr</a>  ili na tel: 098/303-508</p>
                    
               <p>&nbsp;</p>
			
		
                       <div class="divider-page-1px"></div>
                        <p>Vlasnik ovog web servisa je <a href="mailto:udruga@convoy.hr"> udruga Convoy - prijatelji na cesti</a></p>
                </div><!-- main-content -->
	</div><!-- .container -->

		
	<!-- END PORTFOLIO WRAPPER -->



<?php
$this->load->view('./footer');
