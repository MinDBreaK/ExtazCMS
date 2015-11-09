<div class="container content">
    <div class="row magazine-page">
	<?php $this->assign('title', 'Infos Joueur'); ?>
        <!-- Begin Content -->
        <div class="col-md-9">
        	<?php $playerinfo = $api->call('player.name', [$username])
        	if ($playerinfo[0]['result'] == 'success')
        	{

        		echo var_dump($playerinfo[0]['success']);




































        	}

        </div>
    </div>
</div>