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
                                <li><a href="<?php echo base_url(); ?>superadmin/index">Posloprimci</a></li>
                                <li><a  href="<?php echo base_url(); ?>superadmin/company">poslodavci</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/change_image">Slika</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/change_password">Zaporka</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/change_profil">Profil</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/sending_emails">Pošalji email</a></li>
			</ul>
			<!-- end filter -->

                                            <?php
                                            if(empty($one_user)){ ?>
                                            <h5 style="color:red; padding:10px;">Vi ste super administrator</h5>
                                            <?php }else{?>
                                            
                                            <!-- TABLE -->
				<table>
					<thead>
						<tr>
							<th>Ime</th>
							<th>Adresa </th>
                                                        <th>Email</th>
                                                        <th>telefon</th>
                                                        <th>Blokiraj</th>
                                                        <th>Obriši</th>
						</tr>
					</thead>
				<tbody>
                                    
                                    
                                   
					<tr>
						<td><?php echo $one_user->user_name;?></td>
						<td><?php echo $one_user->location; ?></td>
                                                <td><a href="mailto:<?php echo $one_user->email; ?>"><?php echo $one_user->email; ?></a></td>
                                                <td><?php echo $one_user->tel; ?></td>
                                                <?php 
                                                $user_company_id = ($one_user->type == '0') ? 'user_id' : 'company_id';
                                                if($one_user->status == 'active'){?>
                                                <td><a href="<?php echo base_url().'superadmin/block_user/'.$one_user->$user_company_id.'/'.$one_user->type;?>">Blokiraj</a></td>
                                                <?php }else{?>
                                                <td><a href="<?php echo base_url().'superadmin/deblock_user/'.$one_user->$user_company_id.'/'.$one_user->type;?>">Deblokiraj</a></td>
                                                <?php }?>
						<td><a href="<?php echo base_url().'superadmin/delete_user/'.$one_user->$user_company_id.'/'.$one_user->type;?>">Obriši</a></td>
					</tr>
                                        
                                  
					
				</tbody>
			</table>		
			<!-- TABLE -->		
                                            
                                            <?php } // kraj korisnika i početak događaja?>
                        <div class="divider-page-1px"></div>	
                        <h5>Oglasi:</h5>
                        
                         <?php 
                                            if(empty($user_advertisements)){ ?>
                                            <h5 style="color:red; padding:10px;">Korisnik nema niti jedan oglasS</h5>
                                            <?php }else{?>
                                            
                                            <!-- TABLE -->
				<table>
					<thead>
						<tr>
							<th>Title</th>
							<th>Datum isteka </th>
                                                        <th>Status</th>
                                                        <th>Blokiraj</th>
                                                        <th>Obriši</th>
						</tr>
					</thead>
				<tbody>
                                    
                                    <?php foreach($user_advertisements as $all):?>
					<tr>
						<td><?php echo $all['title']; ?></td>
						<td><?php echo hr_oblik_datuma($all['date_expires']); ?></td>
                                                <td><?php echo $all['status']; ?></td>
                                                <?php if($all['status'] == 'active'){ ?>
                                                <td><a href="<?php echo base_url().'superadmin/block_advertisement/'.$all['id'].'/'.$one_user->type;?>">Blokiraj</a></td>
                                                <?php }else{?>
                                                <td><a href="<?php echo base_url().'superadmin/deblock_advertisement/'.$all['id'].'/'.$one_user->type;?>">Deblokiraj</a></td>
                                                <?php }?>
						<td><a href="<?php echo base_url().'superadmin/delete_advertisement/'.$all['id'].'/'.$one_user->type;?>">Obriši</a></td>
					</tr>
                                        
                                        <?php endforeach; ?>
					
				</tbody>
			</table>		
			<!-- TABLE -->		
                                            
                                            <?php } // kraj događaja?>
                        
                        
                        
                         <?php 
                        if(empty($user_hitchhiker)){ ?>
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
                                    
                                    <?php foreach($user_hitchhiker as $hitch):?>
					<tr>
						<td><?php echo $hitch['from']; ?></td>
                                                <td><?php echo $hitch['to']; ?></td>
						<td><?php echo hr_oblik_datuma($hitch['date_hitchhiking']); ?> u <?php echo $hitch['at_what_time']; ?></td>
						<td><a href="<?php echo base_url().'superadmin/delete_hitchhiking/'.$hitch['id'];?>">Obriši</a></td>
					</tr>
                                        
                                        <?php endforeach; ?>
					
				</tbody>
			</table>		
			<!-- TABLE -->		
                                            
                                            <?php } ?>
                                           

        
        
        
        		</div><!-- main-content -->

                
<?php
$this->load->view('admin_sidebar');
?>
                
</div><!-- .container -->
      
<?php
$this->load->view('admin_footer');
