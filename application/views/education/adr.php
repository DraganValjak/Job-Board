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
                            <h4 class="page-title">STRUČNO OSPOSOBLJAVANJE OSOBA KOJE  PREVOZE OPASNE TVARI I OSOBE KOJE NJIMA RUKUJU ( ADR )</h4>
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
                           $text = 'STRUČNO OSPOSOBLJAVANJE OSOBA KOJE  PREVOZE OPASNE TVARI I OSOBE KOJE NJIMA RUKUJU ( ADR )'; 
                   echo  share_button('facebook',array('url'=>$url, 'text'=>$text));?></p>
             <h5><a href="http://www.mazda-start.hr" target="_blank">Pučko otvoreno učilište NOVAK Mala Subotica</a>, Braće Radića 69, PODRUŽNICA ČAKOVEC, ZELENA 1, tel. 040/312-113, mob.099/2141890,OIB:84728804906</h5>
             <p>&nbsp;</p>
             
             <div class="row">
				<div class="six columns alpha">
                                    <h5>Literatura osigurana.</h5>
                                    <h6>Potrebna dokumentacija i uvjeti:</h6>
					<ul class="disc">
						<li>1.	Vozačka dozvola - posjedovanje «C» kategorije minimalno jednu godinu</li>
                                                <li>2.	Navršena 21 godina starosti</li>
                                                <li>3.	Domovnica ( fotokopija )</li>
                                                <li>4.	Rodni list ( fotokopija )</li>
                                                <li>5.	Završna svjedodžba ( fotokopija )</li>
                                                <li>6.	ADR iskaznica ( fotokopija )</li>
					</ul>
				</div><!-- six -->
                        </div><!--row-->
                     
                    <h6>Početak predavanja: 22.02.2014.  i   01.03. 2014.</h6>
               
                    <h6>DODATNE INFORMACIJE     tel. 040/312-113, mob. 099/2141890 Dubravka Sklepić</h6>
                    <h6><a href="http://sdrv.ms/1ckz9SS" target="_blank">Preuzmite upisnicu </a></h6>
			<!-- LISTS -->
			
		
                       <div class="divider-page-1px"></div>
                        <p>Vlasnik ovog web servisa je <a href="mailto:udruga@convoy.hr"> udruga Convoy - prijatelji na cesti</a></p>
                </div><!-- main-content -->
	</div><!-- .container -->

		
	<!-- END PORTFOLIO WRAPPER -->



<?php
$this->load->view('./footer');
