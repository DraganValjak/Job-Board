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
					<ul id="nav" class="sf-menu">
                                                 <li><a href="<?php echo base_url(); ?>superadmin/add" class="button cta-button">Admin posao</a></li>
						 <li><a href="<?php echo base_url().'jobs/listings'; ?>" class="button cta-button">Poslovi</a></li>
		                                 <li><a href="<?php echo base_url().'workers/listings'; ?>" class="button cta-button">Posloprimci</a></li>
                                                 <li><a href="<?php echo base_url().'drive/hitchhikers'; ?>" class="button cta-button">Povezi Me</a></li>
                                                  <li><a href="<?php echo base_url()."login/logout" ?>" class="button cta-button">Odjava</a></li>
	
				 	</ul>  <!-- end #nav  -->
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
                                <li><a class="active" href="<?php echo base_url(); ?>superadmin/index">Posloprimci</a></li>
                                <li><a  href="<?php echo base_url(); ?>superadmin/company">poslodavci</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/change_image">Slika</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/change_password">Zaporka</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/change_profil">Profil</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/sending_emails">Pošalji email</a></li>
			</ul>
			<!-- end filter -->

                                            <?php
                                            if(empty($all_users)){ ?>
                                            <h5 style="color:red; padding:10px;">Nemate niti jednog posloprimca</h5>
                                            <?php }else{?>
                                            
                                            <!-- TABLE -->
				<table>
					<thead>
						<tr>
							<th>Ime posloprimca</th>
							<th>Datum pristupa </th>
                                                        <th>Status</th>
                                                        <th>Blokiraj</th>
							<th>Uredi</th>
                                                        <th>Obriši</th>
						</tr>
					</thead>
				<tbody>
                                    
                                    <?php foreach($all_users as $all):?>
					<tr>
						<td><?php echo $all->user_name . ' '. $all->last_name; ?></td>
						<td><?php echo hr_oblik_datuma($all->created_date); ?></td>
                                                <td><?php echo $all->status; ?></td>
                                                <?php if($all->status == 'active'){ ?>
                                                <td><a href="<?php echo base_url().'superadmin/block_user/'.$all->user_id.'/'.$all->type;?>">Blokiraj</a></td>
                                                <?php }else{?>
                                                <td><a href="<?php echo base_url().'superadmin/deblock_user/'.$all->user_id.'/'.$all->type;?>">Deblokiraj</a></td>
                                                <?php }?>
						<td><a href="<?php echo base_url().'superadmin/look_user/'.$all->user_id.'/'.$all->type;?>">Pregled</a></td>
						<td><a href="<?php echo base_url().'superadmin/delete_user/'.$all->user_id.'/'.$all->type;?>">Obriši</a></td>
					</tr>
                                        
                                        <?php endforeach; ?>
					
				</tbody>
			</table>		
			<!-- TABLE -->		
                                            
                                            <?php }?>
                                           

        
        
        
        		</div><!-- main-content -->

                
<?php
$this->load->view('admin_sidebar');
?>
                
</div><!-- .container -->
      
<?php
$this->load->view('admin_footer');
