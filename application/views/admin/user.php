<?php
$this->load->view('header');
$this->load->view('top_panel');
?>
<!-- START SEPARATOR  -->
	<div id="separator">
		<div class="btop-1px"></div>
		<div class="container">
			<!-- start separator -->
			<div class="cta-block">
                            
                                
                                

				<div class="twelve columns navigation" style="float:right !important;">
				<div id="menu" class="fix-fish-menu">
					<?php  $this->load->view('admin/meni/glavni_navbar');?>
			 	</div>	<!-- end #menu  -->	
			</div><!-- .twelve columns -->
			
                                
                                
                  <h4 class="page-title"><?php echo $name = (isset($user->last_name)) ? $user->user_name . ' ' . $user->last_name : $user->user_name; ?></h4>
                                
                             <img src="<?php echo $user->user_image ?>" title="<?php echo $user->user_name; ?>" width="100" height="100" />   
                                              
                                
                                
                                
                                
                                
                                
			</div><!-- sixteen columns -->
		</div><!-- .container -->
		<div class="bbottom-1px"></div>
	</div><!-- #separator -->
	<!-- END SEPARATOR -->	
        
        
            <!-- START PAGE WRAPPER -->
	<div class="container main-wrapper">
            <div id="main-content" class="twelve columns">
                <div>
                <h5 style="color:green;"><?php echo  $this->session->flashdata('change_user_data'); ?></h5>
                </div>
                        
                       
                			<!-- start filter -->
			<ul id="filters" class="clearfix">
                                <li><a class="active" href="<?php echo base_url(); ?>admin/index">Oglasi</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/change_image">Slika</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/change_password">Zaporka</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/change_profil">Profil</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/sending_emails">Pošalji email</a></li>
			</ul>
			<!-- end filter -->

                                            <?php if(empty($advertisement)){ ?>
                                            <h5 style="color:red; padding:10px;">Nemate niti jedan oglas</h5>
                                            <?php }else{?>
                                            <h5 style="color:red; padding:10px;">Oglasi za posao</h5>
                                            
                                            <!-- TABLE -->
				<table>
					<thead>
						<tr>
							<th>Naziv oglasa</th>
							<th>Datum završetka</th>
							<th>Uredi</th>
                                                        <th>Obriši</th>
						</tr>
					</thead>
				<tbody>
                                    
                                    <?php foreach($advertisement as $advertis):?>
					<tr>
						<td><?php echo $advertis['title']; ?></td>
						<td><?php echo hr_oblik_datuma($advertis['date_expires']); ?></td>
						<td><a href="<?php echo base_url().'admin/edit_advertisement/'.$advertis['id'];?>">Uredi</a></td>
						<td><a href="<?php echo base_url().'admin/delete_advertisement/'.$advertis['id'];?>">Obriši</a></td>
					</tr>
                                        
                                        <?php endforeach; ?>
					
				</tbody>
			</table>		
			<!-- TABLE -->		
                                            
                                            <?php }?>
                        
                        <?php 
                        if($this->session->userdata('type') == '0'){
                        if(empty($hitchhiker)){ ?>
                                            <h5 style="color:red; padding:10px;">Nemate niti jedan Povezi Me oglas</h5>
                                            <?php }else{?>
                                            <h5 style="color:red; padding:10px;">Povezi Me oglasi</h5>
                                            
                                            <!-- TABLE -->
				<table>
					<thead>
						<tr>
							<th>OD</th>
							<th>DO</th>
							<th>Datum / sat</th>
                                                        <th>Obriši</th>
						</tr>
					</thead>
				<tbody>
                                    
                                    <?php foreach($hitchhiker as $hitch):?>
					<tr>
						<td><?php echo $hitch['from']; ?></td>
                                                <td><?php echo $hitch['to']; ?></td>
						<td><?php echo hr_oblik_datuma($hitch['date_hitchhiking']); ?> u <?php echo $hitch['at_what_time']; ?></td>
						<td><a href="<?php echo base_url().'admin/delete_hitchhiker/'.$hitch['id'];?>">Obriši</a></td>
					</tr>
                                        
                                        <?php endforeach; ?>
					
				</tbody>
			</table>		
			<!-- TABLE -->		
                                            
                                            <?php }
                        } // kray type ?>
                                           

        
        
        
        		</div><!-- main-content -->

                
<?php
$this->load->view('admin_sidebar');
?>
                
</div><!-- .container -->
      
<?php
$this->load->view('admin_footer');