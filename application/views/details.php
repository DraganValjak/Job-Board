<?php
$this->load->view('details_header');
$this->load->view('top_panel');
$this->load->view('navigation');
?>
	<!-- START SEPARATOR  -->
	<div id="separator">
		<div class="btop-1px"></div>
		<div class="container">
			<!-- start separator -->
			<div class="sixteen columns">
                            <h4 class="page-title"><?php echo $title = ($details) ? $details['title']: 'Posao nije pronađen'; ?> <small class="button cta-button">   <?php if($details)echo  $details['job_type']; ?>   </small></h4>
			</div><!-- sixteen columns -->
		</div><!-- .container -->
		<div class="bbottom-1px"></div>
	</div><!-- #separator -->
	<!-- END SEPARATOR -->	
        
        <!-- START PAGE WRAPPER -->
	<div class="container main-wrapper">
            
                 <!-- CLIENTS -->
	

	<div id="clients" class="container">
		<ul id="clients-carousel" class="jcarousel-skin-tango" >
			<!-- start carousel -->
			<li><div class="four columns">
				<div class="block">
                                    <a href="http://www.convoy.hr" target="_blank"><img src="<?php echo base_url(). 'images/clients/convoyPosao.png'; ?>" alt="" /></a>
				</div><!-- block -->  
			</div><!-- .four  --></li>
                        
                         <li><div class="four columns">
				<div class="block">
					 <a href="http://www.mazda-start.hr" target="_blank"><img src="<?php echo base_url(). 'images/clients/pou.jpg'; ?>" alt="" /></a>
				</div><!-- block -->  
			</div><!-- .four  --></li>

			<li><div class="four columns">
				<div class="block">
					 <a href="http://www.tahograf.hr" target="_blank"><img src="<?php echo base_url(). 'images/clients/tahografPosao.png'; ?>" alt="" /></a>
				</div><!-- block -->  
			</div><!-- .four  --></li>

			<li><div class="four columns">
				<div class="block">
					 <a href="http://www.e92.hr" target="_blank"><img src="<?php echo base_url(). 'images/clients/karteloPosao.png'; ?>" alt="" /></a>
				</div><!-- block -->  
			</div><!-- .four  --></li>

			<li><div class="four columns">
				<div class="block">
					 <a href="https://www.facebook.com/groups/121324640418/" target="_blank"><img src="<?php echo base_url(). 'images/clients/facebookPosao.png'; ?>" alt="" /></a>
				</div><!-- block -->  
			</div><!-- .four  --></li>

					
		</ul><!-- #clients-carousel -->
	</div><!-- .container -->
	<!-- END CLIENTS -->
            
		<div id="main-content" class="twelve columns">
 <?php
if($details){
?>
			
                    
          <div class="alignleft caption">
                            <img src="<?php echo $details['user_image']; ?>" alt="Posao na brzinu" class="border" title="Align Left" width="100" />	
			</div>              
            <?php 
            // ako imamo last name, vracamo ime i prezime, ako nemamo vracamo samo user_name
            $user_name = (isset($details['last_name'])) ?  $details['user_name'] .' '. $details['last_name'] : $details['user_name'];
             // ako imamo url, radimo od toga link
            ?>

         <p><?php  echo $company =  ($details['url']) ? '<a href="'.$details['url'].'" target="_blank">'.$user_name.' <strong style="color:#FF7E00;"> &Rrightarrow;</strong>  </a>' : "<strong>$user_name</strong>";?></p>
         <p>Iskustvo: <strong><?php echo $details['exspirience'];?></strong></p> 
         <p>Kategorije: <strong><?php echo $details['job_license'];?></strong></p> 
        <p>Opis: <?php echo $details['body'];?></p>
        <p>Adresa: <?php echo $details['location'];?>, <?php echo $details['state_name'];?></p>
        <p>Tel: <strong><?php echo $details['tel'];?></strong></p>
        <p>Javiti se do: <strong><?php echo hr_oblik_datuma($details['date_expires']);?></strong></p>
        <p><?php echo '<a href=mailto:"'.$details['email'].'">'.$details['email'].'</a>';?></p>
        <?php $posted = (int)strtotime($details['date_created']); 
              $current = time();
        ?>
      <p><i> Oglas je predan prije <?php echo $this->timeword->convert($posted, $current); ?> </i></p>
      <p>&nbsp;</p>
	  
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/hr_HR/all.js#xfbml=1&appId=204346619733634";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-share-button" data-href="<?php echo current_url(); ?>" data-type="button_count"></div>
                           
                   
		<div class="divider-page-1px"></div>	
		
<?php
}else{
 ?>
      <div id="main-content" class="twelve columns">
				
				<h4><?php echo $no_jobs; ?></h4>
                                <h5>Pokušajte s novom pretragom &Rightarrow;</h5>
                                <img src="<?php echo base_url(); ?>images/404.png">
			</div>              
<?php } ?>
                    	
                 
                 
                <a href="javascript:history.back()" class="button cta-button">&lAarr; Natrag</a>  

		</div><!-- main-content -->
<?php
$this->load->view('sidebar');
?>
</div><!-- .container -->
<?php
$this->load->view('footer');

# end of file /views/listings.php

