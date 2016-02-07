<ul id="nav" class="sf-menu">
                                                <li><a href="<?php echo base_url()."admin/add" ?>" style="border: 1px solid #2E21E4;" class="button cta-button">Oglas Za Posao</a></li>
                                                <?php if($this->session->userdata('type') == 0) {?>
                                                <li><a href="<?php echo base_url(); ?>admin/addHitchhiker" style="border: 1px solid #FF7E00;" class="button cta-button">Povezi Me Oglas</a></li>
                                                 <?php } ?>
						 <li><a href="<?php echo base_url().'jobs/listings'; ?>" class="button cta-button">Poslovi</a></li>
		                                 <li><a href="<?php echo base_url().'workers/listings'; ?>" class="button cta-button">Posloprimci</a></li>
                                                 <li><a style="color:#2E21E4;" href="<?php echo base_url().'drive/hitchhikers'; ?>" class="button cta-button">Povezi Me</a></li>
                                                  <li><a href="<?php echo base_url()."login/logout" ?>" class="button cta-button">Odjava</a></li>
	
				 	</ul>  <!-- end #nav  -->