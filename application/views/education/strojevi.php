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
                            <h4 class="page-title">UPIS U PROGRAME ZA RUKOVATELJE SVIM RADNIM STROJEVIMA</h4>
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
                           $text = 'UPIS U PROGRAME ZA RUKOVATELJE SVIM RADNIM STROJEVIMA'; 
                   echo  share_button('facebook',array('url'=>$url, 'text'=>$text));?></p>
             <h5><a href="http://www.mazda-start.hr" target="_blank">Pučko otvoreno učilište NOVAK Mala Subotica</a>, Braće Radića 69, PODRUŽNICA ČAKOVEC, ZELENA 1, tel. 040/312-113, mob.099/2141890,OIB:84728804906</h5>
             <p>&nbsp;</p>
             
             <div class="row">
				<div class="six columns alpha">
                                    <h5>3. PROGRAMI  OSPOSOBLJAVANJA </h5>
                                    
					<ul class="disc">
						<li>1.	RUKOVATELJ BULDOŽERIMA I GREDERIMA</li>
                                                <li>2.	RUKOVATELJ ELEKTRIČNIM KOLICIMA</li>
                                                <li>3.	RUKOVATELJ AUTODIZALICOM)</li>
                                                <li>4.	RUKOVATELJ UTOVARIVAČEM</li>

					</ul>
				</div><!-- six -->
                        </div><!--row-->
                     
            
               
                    <h6>DODATNE INFORMACIJE     tel. 040/312-113, mob. 099/2141890 Dubravka Sklepić</h6>
                   
			<!-- LISTS -->
			
		
                       <div class="divider-page-1px"></div>
                        <p>Vlasnik ovog web servisa je <a href="mailto:udruga@convoy.hr"> udruga Convoy - prijatelji na cesti</a></p>
                </div><!-- main-content -->
	</div><!-- .container -->

		
	<!-- END PORTFOLIO WRAPPER -->



<?php
$this->load->view('./footer');
