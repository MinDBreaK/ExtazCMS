<!--=== Content Part ===-->
<div class="container content">
    <div class="row magazine-page">
    <?php $this->assign('playerlist', 'Liste des joueurs connectés'); ?>

        <!-- Begin Content -->
        <div class="col-md-9">
			<?php $pl = $api->call('players.online.names')[0]['success']; ?>
			<?php $total = count($pl); ?>
				
				<div class="panel panel-default">
				<?php
				if ($pl == null) { ?>
						<div class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> &nbsp;Il n'y a pas de joueurs connectés !</div> 
				<?php } else { ?>					
						<table class="table">
							<thead>
								<th>
									Emplacement
								</th>
								<th>
									Pseudo
								</th>
								<th>
									Action
								</th>
							</thead>
							<tbody>
							<?php

								for ($i=0; $i<$total; $i++) 
								{ ?>
									<tr>
										<?php
										for ($j=1; $j<=$total; $j++) 
										{ ?>		
											<td>
												<?php echo $i+1; ?>		
											</td>
											<td>
												<?php echo $pl[$i]; ?>		
											</td>
											<td>
											<?php //inserer les actions pour le joueur ?>
											</td>
										<?php } ?>
									</tr>
								<?php }
							} ?>
							</tbody>
						</table>
					</div>
	        <!-- End Content -->
	        
    	</div>
    	<?php echo $this->element('sidebar'); ?>
	</div><!--/container--> 

</div>
<!--ADD GITHUB-->
    
<!-- End Content Part -->