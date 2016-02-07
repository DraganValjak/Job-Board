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
                                <p>Kategorija <span style="color:#FF7E00;"><?php echo $cat = (isset($_GET['category'])) ?  $category_options[$_GET['category']] : 'Sve'; ?></span>  
                                    &rrarr;   država <span style="color:#FF7E00;"><?php echo $cat = (isset($_GET['state'])) ?  $state_options[$_GET['state']] : 'Sve'; ?>.</span>

									</p>
									
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
                           $text = isset($listings['title']); 
                   echo  share_button('facebook',array('url'=>$url, 'text'=>$text));?></p>
                
                
              
                
                    
                           
  
 <?php

if($listings){
    $counter = 0;
    foreach($listings as $row){
        // računamo koliko poslova ima
        $counter ++;
        // izlistavamo sve poslove
?>
			<div class="alignleft caption">
                            <img src="<?php echo $row['user_image']; ?>" alt="Posao na brzinu" class="border" title="Align Left" width="100" />	
			</div>
                    <p<?php if($counter == 2){ echo ' class="alt"'; $counter = 0;} ?>>
                                   
                                     <?php  
                                     $segments = array($this->uri->segment(1), 'details', $row['id']);
                                     if($this->uri->segment(1) == 'workers'){
                                         if(!$this->session->userdata('is_logged_in')){ ?>
                                         <a href='#'><span class='title' onclick="return alert('Morate se prijaviti da bi vidjeli cijeli profil.')"><?php echo $row['title']; ?></span></a></p> 
                                       <?php  }else{
                                           echo '<a href="'.site_url($segments).'"><span class="title">'.$row['title'].'</span></a></p>';  
                                         }
                                     }elseif ($this->uri->segment(1) == 'jobs') { 
                                         echo '<a href="'.site_url($segments).'"><span class="title">'.$row['title'].'</span></a></p>';
                                     }else{ 
                                          echo '<a href="'.site_url($segments).'"><span class="title">'.$row['title'].'</span></a></p>'; 
                                       }
                                     ?>
                        
                                   
                    <p><em><?php echo $row['user_name'];?></em></p>
        <p><em><?php echo $row['state_name'];?></em></p>
        <?php (int)$posted = strtotime($row['date_created']); // $posted = mktime($row['date_created']);
        $this->load->helper('date');

         $current = time(). "<br />";
     
              
        ?>
      <p><i> Prije  <?php echo $this->timeword->convert($posted , $current); ?> </i>    
        </p>
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
