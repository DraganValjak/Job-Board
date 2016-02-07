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
                            <h4 class="page-title">Cjeloživotno obrazovanje</h4>
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
                           $text = 'Cjeloživotno obrazovanje'; 
                   echo  share_button('facebook',array('url'=>$url, 'text'=>$text));?></p>
           
             <h6>Udruga profesionalnih vozača Convoy svojim djelovanjem pokušava olakšati profesionalnim vozačima stjecanje 
                 potrebnih kvalifikacija, održavanjem raznih besplatnih semainara ili sklapanjem ugovora o suradnji sa tvrtkama koje 
            u svojim programima obrazovanja imaju profesionalnim vozačima zanimljive sadržaje.
             Na taj način članovi udruge Convoy mogu iskoristiti pogodnosti koje smo za njih dogovorili.</h6>
             <p>&nbsp;</p>
             
             <div class="row">
				<div class="six columns alpha">
                                    <h5>Sa kojim smo tvrtkama skolopili ugovore?</h5>
					<ul class="disc">
                                            <li><a href="http://www.tahograf.hr/" target="_blank">Tahograf d.o.o. </a></li>
                                                <li><a href="www.mazda-start.hr" target="_blank">Pučko otvoreno učilište NOVAK </a></li>
					</ul>
				</div><!-- six -->
                        </div><!--row-->
			
                        <div class="row">
				<div class="six columns alpha">
                                    <h5>Održani seminari, radionice</h5>
					<ul class="disc">
                                            <li><a href="http://www.convoy.hr/index.php?PodrucjeID=9&ImePodrucja=Truck-stop&CjelinaID=57&CjelinaIme=Radionice%20udruge&JedinicaID=117" target="_blank">Radionica o digitalnim tahografima</a></li>
                                                
					</ul>
				</div><!-- six -->
                        </div><!--row-->
		
                       <div class="divider-page-1px"></div>
                        <p>Vlasnik ovog web servisa je <a href="mailto:udruga@convoy.hr"> udruga Convoy - prijatelji na cesti</a></p>
                </div><!-- main-content -->
	</div><!-- .container -->

		
	<!-- END PORTFOLIO WRAPPER -->



<?php
$this->load->view('./footer');
