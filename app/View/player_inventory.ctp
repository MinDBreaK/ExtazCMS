<div class="container content">
    <div class="row magazine-page">
	<?php $this->assign('title', 'Infos Joueur'); ?>
        <!-- Begin Content -->
        <div class="col-md-9">
        	<?php
        	if (isset($_GET['player'])) {
        		$player = $_GET['player'];
         	} else {
         		$player = "";
         	}
         	
         	if ($player != "" and $role > 0) {
        		$playerinfo = $api->call('players.name', [$player]);

        	} elseif (isset($username)) {
        		$playerinfo = $api->call('players.name', [$username]);

        	} else { ?>
        		<div class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> &nbsp;Vous devez être connecté pour accéder à cette fonctionnalité</div> 

        	<?php }
        	
        	$stylediv = "margin-left:25px;outline-style:dashed;outline-width:1px";

        	if ($role > 0) { ?>
        		<h1><i class="fa fa-terminal"></i>&nbsp;Administration</h1>
	        	<div>
	        		<form method="GET" action="<?php echo $this->Html->url('/pages/player_inventory'); ?>">
	        			<p>
	        				<label>Pseudo d'un joueur connecté : &nbsp;</label><input type="text" name="player" />
	        				<input type="submit" value="Vérifier" />
	        			</p>
	        		</form>
	        	</div>
	        <?php }
			        	
        	if (isset($playerinfo))
        	{
	        	if ($playerinfo[0]['result'] == 'success' and $playerinfo[0]['success'] != NULL)
	        	{
	        		?>

	        		<h2><i class="fa fa-info-circle"></i> Statut du Joueur</h2>

	        		<div style=<?php echo $stylediv; ?> >

	        		<?php 
	        		if ($playerinfo[0]['success']['op'] == 1){ ?>
	        			&nbsp;<i class='fa fa-check'></i> Vous êtes op sur le serveur.<br><?php
	        		} else {?>
	        			&nbsp;<i class='fa fa-male'></i> Vous êtes un joueur normal.<br><?php
	        		} 

	        		if ($playerinfo[0]['success']['sleeping'] == 1) { ?>
	        			&nbsp;<i class='fa fa-hotel'></i>&nbsp;Vous êtes en train de vous reposer.<br> <?php
	        		} else { ?>
	        			&nbsp;<i class='fa fa-male'></i>&nbsp;Vous êtes bien réveillé !<br> <?php
	        		}

	        		if ($playerinfo[0]['success']['sneaking'] == false){ ?>
	        			&nbsp;<i class='fa fa-male'></i>&nbsp; Vous vous tenez bien droit. C'est bien !<br> <?php
	        		} else { ?>
	        			&nbsp;<i class='fa fa-wheelchair'> A force d'être accroupi, vous allez avoir des problèmes de dos !<br> <?php
	        		}
					
					if ($playerinfo[0]['success']['gameMode'] == 0){ ?>
						&nbsp;<i class='fa fa-male'></i>&nbsp;Vous êtes en survie !<br><?php
					}
					elseif ($playerinfo[0]['success']['gameMode'] == 1){ ?>
						&nbsp;<i class='fa fa-male'></i>&nbsp;Vous êtes en créatif !<br><?php
					}
					elseif ($playerinfo[0]['success']['gameMode'] == 2){ ?>
						&nbsp;<i class='fa fa-male'></i>&nbsp;Vous êtes en mode Aventure !<br><?php
					}
					else { ?>
						&nbsp;<i class='fa fa-male'></i> Impossible de déterminer votre mode de jeu !<br><?php
					} ?>

					&nbsp;<i class="fa fa-clock-o"></i> Votre dernière connection remonte au <?php echo date('d/m/Y', $playerinfo[0]['success']['lastPlayed']); ?> &agrave; <?php echo date('H:i:s', $playerinfo[0]['success']['lastPlayed']); ?>
						<br>
						&nbsp;<i class="fa fa-clock-o"></i> Tandis que vous jouez sur le serveur depuis le : <?php echo date('d/m/Y', $playerinfo[0]['success']['firstPlayed']); ?> &agrave; <?php echo date('H:i:s', $playerinfo[0]['success']['firstPlayed']); ?>
	        		</div>
	        		<br>
	        		<br>

	        		<h2><i class="fa fa-map-marker"></i> Position Joueur</h2>
					
					<div style=<?php echo $stylediv; ?> >
					
						&nbsp;<i class="fa fa-angle-double-right"></i> X : <?php echo $playerinfo[0]['success']['location']['x'];  ?><br>
						&nbsp;<i class="fa fa-angle-double-right"></i> Y : <?php echo $playerinfo[0]['success']['location']['y'];  ?><br>
						&nbsp;<i class="fa fa-angle-double-right"></i> Z : <?php echo $playerinfo[0]['success']['location']['z'];  ?><br>
						<?php 

						$playerinfo[0]['success']['location']['yaw'] = $playerinfo[0]['success']['location']['yaw'] % 360 + ($playerinfo[0]['success']['location']['yaw'] < 0 ? 360 : 0);

						if ($playerinfo[0]['success']['location']['yaw'] > -20  and $playerinfo[0]['success']['location']['yaw'] < 20)  {$cardinal = " (Sud)";}
						elseif ($playerinfo[0]['success']['location']['yaw'] > 20   and $playerinfo[0]['success']['location']['yaw'] < 70)  {$cardinal = " (Sud-Ouest)";}
						elseif ($playerinfo[0]['success']['location']['yaw'] > 70   and $playerinfo[0]['success']['location']['yaw'] < 110) {$cardinal = " (Ouest)";}
						elseif ($playerinfo[0]['success']['location']['yaw'] > 110  and $playerinfo[0]['success']['location']['yaw'] < 160) {$cardinal = " (Nord-Ouest)";}
						elseif ($playerinfo[0]['success']['location']['yaw'] > 160  and $playerinfo[0]['success']['location']['yaw'] < 200) {$cardinal = " (Nord)";}
						elseif ($playerinfo[0]['success']['location']['yaw'] > 200  and $playerinfo[0]['success']['location']['yaw'] < 250)  {$cardinal = " (Nord-Est)";}
						elseif ($playerinfo[0]['success']['location']['yaw'] > 250  and $playerinfo[0]['success']['location']['yaw'] < 290) {$cardinal = " (Est)";}
						elseif ($playerinfo[0]['success']['location']['yaw'] > 290  and $playerinfo[0]['success']['location']['yaw'] < 360) {$cardinal = " (Sud-Est)";}
						else {$cardinal = null;}
						?>
						
						&nbsp;<i class="fa fa-compass"></i><?php echo $playerinfo[0]['success']['location']['yaw'] . $cardinal; ?><br>

						<?php
						if ($playerinfo[0]['success']['location']['pitch'] < 91  and $playerinfo[0]['success']['location']['pitch'] >= 75)  {$head = "Regarde ses pieds";}
						if ($playerinfo[0]['success']['location']['pitch'] < 75  and $playerinfo[0]['success']['location']['pitch'] >= 45)  {$head = "Regarde le sol devant lui.";}
						if ($playerinfo[0]['success']['location']['pitch'] < 45  and $playerinfo[0]['success']['location']['pitch'] >= -40)  {$head = "Regarde devant lui.";}
						if ($playerinfo[0]['success']['location']['pitch'] < -40 and $playerinfo[0]['success']['location']['pitch'] >= -90)  {$head = "Regarde les nuages (ou le plafond).";}
						?>
						&nbsp;<i class="fa fa-arrows-v"></i>&nbsp;&nbsp;Pitch : <?php echo $playerinfo[0]['success']['location']['pitch'] . ' (' . $head; ?>)<br>
						
						<?php $maplink = '/dynmap/?playername=' . $playerinfo[0]['success']['name']; ?>	
											
						<i class="fa fa-location-arrow"></i><a href =<?php echo $this->Html->url($maplink); ?> target="blank"> Afficher sur la carte</a>

					</div>
					<br>
					<br>

					<h2><i class="fa fa-shield"></i> Armure Joueur</h2>

					<?php
					$JSON =       file_get_contents('http://' . $_SERVER['HTTP_HOST'] . $this->webroot . 'img/items/items.json');			
					$erreurimg =  'http://' . $_SERVER['HTTP_HOST'] . $this->webroot . 'img/items/0-0.png';
					$pathitem =   'http://' . $_SERVER['HTTP_HOST'] . $this->webroot . 'img/items/';
					$itemList =   json_decode($JSON, true);

					$inventory =  $playerinfo[0]['success']['inventory'];
					$armure =     $playerinfo[0]['success']['inventory']['armor'];

					$Durability = array(
									'310' => '364',
									'311' => '529',
									'312' => '496',
									'313' => '430',
									'302' => '166',
									'303' => '241',
									'304' => '226',
									'305' => '196',
									'298' => '56',
									'299' => '81',
									'300' => '76',
									'301' => '66',
									'306' => '166',
									'307' => '241',
									'308' => '226',
									'309' => '196',
									'314' => '78',
									'315' => '113',
									'316' => '106',
									'317' => '92',
									'' => ''
									);

					if ($armure['helmet']['type'] == 0 and $armure['chestplate']['type'] == 0 and $armure['leggings']['type'] == 0 and $armure['boots']['type'] == 0){ ?>
									<div class="alert alert-info" role="alert">Ce joueur n'a pas d'armure !</div> <?php
						
					} else { ?>
						<div class="panel panel-default">
						
							<table class="table">
								<thead>
									<th>
										Armure
									</th>
									<th>
										Nom
									</th>
									<th>
										Usage Restant
									</th>
								</thead>

								<?php
								if ($armure['helmet']['type'] != 0){
								$img = $pathitem . $armure['helmet']['type'] . '-0.png'; ?>
									<tr>
										<td>
											<?php
											if (substr(get_headers($img)[0], 9, 3) == '200'){ ?>
												<img data-original-title="Helmet" data-placement="right" src="<?php echo $img; ?>" height="30" width="30"><?php
											} else { ?>
												<img data-original-title="Unknown" data-placement="right" src="<?php echo $erreurimg; ?>" height="30" width="30"><?php
											} ?>
										</td>
										<td><?php 
											foreach($itemList as $item){
												if ($item['type'] == $armure['helmet']['type'] and $item['meta'] == $armure['helmet']['dataValue']){
													echo $item['name'];
													break;
												}
											} ?>
										</td>
										<td>
											<div class="progress progress-u progress-sm">
												<?php $pourcentage = (($Durability[$armure["helmet"]["type"]] - $armure["helmet"]["durability"]) * 100) / ($Durability[$armure["helmet"]["type"]]); ?>
												<div class="progress-bar progress-bar-dark" role="progressbar" aria-valuenow=<?php echo $armure["helmet"]["durability"]; ?> aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $pourcentage; ?>%"></div>
											</div>
										</td>
									</tr><?php
								} 

								if ($armure['chestplate']['type'] != 0){
								$img = $pathitem . $armure['chestplate']['type'] . '-0.png'; ?>
									<tr>
										<td>
											<?php
											if (substr(get_headers($img)[0], 9, 3) == '200'){ ?>
												<img data-original-title="Chestplate" data-placement="right" src="<?php echo $img; ?>" height="30" width="30"><?php
											} else { ?>
												<img data-original-title="Unknown" data-placement="right" src="<?php echo $erreurimg; ?>" height="30" width="30"><?php
											} ?>
										</td>
										<td><?php 
											foreach($itemList as $item){
												if ($item['type'] == $armure['chestplate']['type'] and $item['meta'] == $armure['chestplate']['dataValue']){
													echo $item['name'];
													break;
												}
											} ?>
										</td>
										<td>
											<div class="progress progress-u progress-sm">
												<?php $pourcentage = (($Durability[$armure["chestplate"]["type"]] - $armure["chestplate"]["durability"]) * 100) / ($Durability[$armure["chestplate"]["type"]]); ?>
												<div class="progress-bar progress-bar-dark" role="progressbar" aria-valuenow=<?php echo $armure["chestplate"]["durability"]; ?> aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $pourcentage; ?>%"></div>
											</div>
										</td>
									</tr><?php
								} 

								if ($armure['leggings']['type'] != 0){
								$img = $pathitem . $armure['leggings']['type'] . '-0.png'; ?>
									<tr>
										<td>
											<?php
											if (substr(get_headers($img)[0], 9, 3) == '200'){ ?>
												<img data-original-title="Leggings" data-placement="right" src="<?php echo $img; ?>" height="30" width="30"><?php
											} else { ?>
												<img data-original-title="Unknown" data-placement="right" src="<?php echo $erreurimg; ?>" height="30" width="30"><?php
											} ?>
										</td>
										<td><?php 
											foreach($itemList as $item){
												if ($item['type'] == $armure['leggings']['type'] and $item['meta'] == $armure['leggings']['dataValue']){
													echo $item['name'];
													break;
												}
											} ?>
										</td>
										<td>
											<div class="progress progress-u progress-sm">
												<?php $pourcentage = (($Durability[$armure["leggings"]["type"]] - $armure["leggings"]["durability"]) * 100) / ($Durability[$armure["leggings"]["type"]]); ?>
												<div class="progress-bar progress-bar-dark" role="progressbar" aria-valuenow=<?php echo $armure["leggings"]["durability"]; ?> aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $pourcentage; ?>%"></div>
											</div>
										</td>
									</tr><?php
								} 

								if ($armure['boots']['type'] != 0){
								$img = $pathitem . $armure['boots']['type'] . '-0.png'; ?>
									<tr>
										<td>
											<?php
											if (substr(get_headers($img)[0], 9, 3) == '200'){ ?>
												<img data-original-title="Boots" data-placement="right" src="<?php echo $img; ?>" height="30" width="30"><?php
											} else { ?>
												<img data-original-title="Unknown" data-placement="right" src="<?php echo $erreurimg; ?>" height="30" width="30"><?php
											} ?>
										</td>
										<td><?php 
											foreach($itemList as $item){
												if ($item['type'] == $armure['boots']['type'] and $item['meta'] == $armure['boots']['dataValue']){
													echo $item['name'];
													break;
												}
											} ?>
										</td>
										<td>
											<div class="progress progress-u progress-sm">
												<?php $pourcentage = (($Durability[$armure["boots"]["type"]] - $armure["boots"]["durability"]) * 100) / ($Durability[$armure["boots"]["type"]]); ?>
												<div class="progress-bar progress-bar-dark" role="progressbar" aria-valuenow=<?php echo $armure["boots"]["durability"]; ?> aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $pourcentage; ?>%"></div>
											</div>
										</td>
									</tr><?php
								} ?>
							</table>
						</div><?php
					} ?>

					<h2><i class="fa fa-suitcase"></i> Inventaire Joueur</h2>
					<div class="panel panel-default">
						<table class="table">
							<thead>
								<th>
									Item
								</th>
								<th>
									Quantité
								</th>
								<th>
									Nom
								</th>
							</thead>
							
							<?php
							foreach($inventory['inventory'] as $slot){
								if ($slot != null){ ?>
									<tr>
										<td><?php
											$img = $pathitem . $slot['type'] . '-' . $slot['dataValue'] .'.png';
											if (substr(get_headers($img)[0], 9, 3) == '200'){
												$img = $pathitem . $slot['type'] . '-' . $slot['dataValue'] . '.png'; ?>
												<img data-original-title="Item" data-placement="right" src="<?php echo $img; ?>" height="30" width="30">
											<?php } ?>
										</td>
										
										<td>
											<?php echo $slot['amount']; ?>
										</td>
										
										<td>
											<?php
											foreach($itemList as $item){
												if ($item['type'] == $slot['type'] and $item['meta'] == $slot['dataValue']){
													$name = $item['name'];
													break;
												}
											}
											echo $name; ?>
										</td>
									</tr><?php
								}
							} ?>
						</table>
					</div>

					<h2><i class="fa fa-suitcase"></i> Enderchest Joueur</h2>

					<div class="panel panel-default">

					<?php 
					$inventory = $playerinfo[0]['success']['enderchest']; ?>
						
						<table class="table">
							<thead>
								<th>
									Item
								</th>
								<th>
									Quantité
								</th>
								<th>
									Nom
								</th>
							</thead>
							
							<?php
							foreach($inventory as $slot){
								if ($slot != null){ ?>
									<tr>
										<td>
											<?php
											$img = $pathitem . $slot['type'] . '-' . $slot['dataValue'] .'.png';
											if (substr(get_headers($img)[0], 9, 3) == '200'){
												$img = $pathitem . $slot['type'] . '-' . $slot['dataValue'] . '.png'; ?>
												<img data-original-title="Item" data-placement="right" src="' . $img . '" height="30" width="30"> 
											<?php } ?>
										</td>
										
										<td>
											<?php echo $slot['amount']; ?>
										</td>
										
										<td>
											<?php
											foreach($itemList as $item){
												if ($item['type'] == $slot['type'] and $item['meta'] == $slot['dataValue']){
													$name = $item['name'];
													break;
												}
											}
											echo $name; ?>
										</td>
									</tr>
								<?php }
							} ?>
						</table>
					</div>
	        	<?php } elseif (isset($playerinfo)) { ?>
				<div class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> &nbsp;Le joueur est hors-ligne !</div>
			<?php } 
		} ?>
        </div>
        <?php echo $this->element('sidebar'); ?>
    </div>
</div>