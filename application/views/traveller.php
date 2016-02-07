<?php
$this->load->view('traveler_header');
$this->load->view('top_panel');
$this->load->view('navigation');
?>
	<!-- START SEPARATOR  -->
	<div id="separator">
		<div class="btop-1px"></div>
		<div class="container">
			<!-- start separator -->
			<div class="sixteen columns">
                            <h4 class="page-title"><?php echo $text = 'Od ' . $traveller['from'] .' do '. $traveller['to'];?></h4>
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
if($traveller){
?>
			
                    
          <div class="alignleft caption">
                            <img src="<?php echo $traveller['user_image']; ?>" alt="Posao na brzinu" class="border" title="Align Left" width="100" />	
			</div>              
            <?php 
            // ako imamo last name, vracamo ime i prezime, ako nemamo vracamo samo user_name
            $user_name = (isset($traveller['last_name'])) ?  $traveller['user_name'] .' '. $traveller['last_name'] : $traveller['user_name'];
             // ako imamo url, radimo od toga link
            ?>

         <p><?php  echo $company =  ($traveller['url']) ? '<a href="'.$traveller['url'].'" target="_blank">'.$user_name.' <strong style="color:#FF7E00;"> &Rrightarrow;</strong>  </a>' : "<strong>$user_name</strong>";?></p>
        <p>Datum: <strong><?php echo hr_oblik_datuma($traveller['date_hitchhiking']);?> u <?php echo $traveller['at_what_time'];?>.</strong></p>
        <p>Tel: <?php echo $traveller['tel'];?></p>
        <p><?php echo '<a href="mailto:'.$traveller['email'].'">'.$traveller['email'].'</a>';?></p>
        <?php if(isset($traveller['body'])){?> <p>Opis: <?php echo $traveller['body'];?></p><?php }?>
      <div class="divider-page-1px"></div>
    
      
      <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/hr_HR/all.js#xfbml=1&appId=204346619733634";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-share-button" data-href="<?php echo current_url(); ?>" data-type="button_count"></div>
		
      
     
       

                               
    
		
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
                
               <!-- COMMENTS BLOCK -->
			<div id="comments-block">
				<div class="comments-title">
					<h6><?php echo $count_comments ?> komentara</h6>
					<div class="gray-dash-3px"></div>
				</div>
					<?php  if($comments){?>
					<!-- COMMENT BLOCK -->
                                     <?php foreach($comments as $comment){ 
                                                     $posted = (int)strtotime($comment['created_at']); 
                                                     $current = time();?>
					<div class="comment-block">
						<div class="gravatar">
							<a href="#"><img src="<?php echo $comment['user_image'];?>" alt="<?php echo $comment['user_name'];?>" title="<?php echo $comment['user_name'];?>" class="transition-effect"/></a>
				        </div><!-- .gravatar -->
						<div class="comment-text clearfix">
							<span class="comment-info">
								<span class="italic">Prije <?php echo $this->timeword->convert($posted, $current); ?></span>
								<span class="italic">Komentira <strong><?php echo $comment['user_name'];?></strong></span>
							</span>
							<p class="comment">
				        		<?php echo $comment['comment'];?>
				        	</p>
						</div><!-- end comment-text -->
					</div><!-- end comment-block -->
                                        <?php }// kraj foreach
                                        }// kraj IF ?>
                                        </div><!-- .comments-block -->
			<!-- END COMMENTS BLOCK -->	
            <?php if($this->session->userdata('type') == '0'){ ?>   
               <!-- COMMENTS FORM -->
			<div id="comments-form">
				<div class="comments-title">
					<h6>Komentiraj</h6>
					<div class="gray-dash-3px"></div>
				</div>
                            <form id="form-post-comment" action="<?php echo base_url(). 'comments/add_comment/'.$traveller['id'];?>" method="post">
					<textarea id="comment-message" name="comment" placeholder="Vaš komentar"></textarea>
					<input type="submit" value="Pošalji" class="submit">
					<span></span>
				</form>
			</div><!-- #comments-form -->
			<!-- END COMMENTS FORM -->
               <?php } ?>
		</div><!-- main-content -->
<?php
$this->load->view('sidebar');
?>
</div><!-- .container -->
<?php
$this->load->view('footer');

# end of file /views/listings.php

