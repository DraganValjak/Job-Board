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
				<h4 class="page-title"><b><?php echo $total_jobs;?></b></h4>
                              
									
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
		<p><?php 
				$url = current_url();
                          // $text = isset($hitchhikers['from'], $hitchhikers['to']); 
                           $text = 'Povezi Me od '. isset($hitchhikers['from']) .' do '. isset($hitchhikers['to']);
                   echo  share_button('facebook',array('url'=>$url, 'text'=>$text));?></p>
                
                    
                           
  
 <?php

if($hitchhikers){
    $counter = 0;
    foreach($hitchhikers as $row){
        // računamo koliko poslova ima
        $counter ++;
        // izlistavamo sve poslove
?>
			<div class="alignleft caption">
                            <img src="<?php echo $row['user_image']; ?>" alt="Posao na brzinu" class="border" title="Align Left" width="100" />	
			</div>
                    <p<?php if($counter == 2){ echo ' class="alt"'; $counter = 0;} ?>>
                                   
                                     <?php  
                                     $segments = array($this->uri->segment(1), 'traveller', $row['id']);
                                    
                                         if(!$this->session->userdata('is_logged_in')){ ?>
                                         <a href='#'><span class='title' onclick="return alert('Morate se prijaviti da bi vidjeli cijeli profil.')"> OD <?php echo $row['from']; ?></span></a></p> 
                    <p><span class="title"><strong>DO <?php echo $row['to']; ?></strong></span></p>
                                       <?php  }else{
                                           echo '<a href="'.site_url($segments).'"><span class="title">OD ' .$row['from']. '</span></a></p>';  
                                           echo '<p><span class="title"><strong>DO ' .$row['to']. '</strong></span></p>';
                                         }
                                    
                                     ?>
                        
                                   
                    <p><em><?php echo $row['user_name'];?> <?php echo $row['last_name'];?></em></p>
        <p><em><?php echo hr_oblik_datuma($row['date_hitchhiking']);?>, u  <?php echo $row['at_what_time'];?></em></p>
     
		<div class="divider-page-1px"></div>	
		
<?php
    }//foreach
}else{
 ?>
   <div id="main-content" class="twelve columns">
				
				<h4><?php echo $no_jobs; ?></h4>
                                <h5>Pokušajte s novom pretragom &Rightarrow;</h5>
                                <img src="<?php echo base_url(); ?>images/404.png">
			</div>             
<?php } ?>
                    	
                    
<!-- START PAGINATION-->
			<div id="nav-pagination" class="sixteen columns"> 
                            <ul class="nav-pagination clearfix">
                                
                                <?php if(strlen($pages)){echo $pages;} ?>  
                            </ul>
                            </div><!-- #nav-pagination -->

                       
                           
                            
		</div><!-- main-content -->
<?php
$this->load->view('sidebar');
?>
</div><!-- .container -->
<?php
$this->load->view('footer');

# end of file /views/listings.php
