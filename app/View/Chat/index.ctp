<?php $this->assign('title', 'Chat en jeu'); ?>
<!--=== Content Part ===-->
<div class="container content">
    <div class="row">
        <!-- Left Sidebar -->
        <div class="col-md-9">
            <div class="header"> <h4 style="margin-top: 0;">Chat en jeu</h4></div>
                <div class="ibox-content">
                    <div class="chat-messages">
                        <?php
                            $messages = $api->call('streams.chat.latest', [$chat_nb_messages])[0]['success'];
                            if (count($messages) >= $chat_nb_messages) {
                                foreach ($messages as $m) {
                                    if (empty($m['player'])) {
                                        $explode = explode(']', $m['message']);
                                        $explode = str_replace('[', '', $explode);
                                        $player = $explode[0];
                                        $message = $explode[1];
                                    } else {
                                        $player = $m['player'];
                                        $message = $m['message'];
                                        $avatar = "<img src='http://cravatar.eu/helmavatar/$player' style='width:20px;height:20px;border-radius:3px;'/>";
                                    }
                                    echo '<small>[' . date('H:i:s', $m['time']) . ']</small> <b class="player" id="' . $player . '">' . $avatar . ' ' . $player . '</b> ' . $message . '<br>';
                                }
                            } else {
                                echo '<div class="alert alert-warning alert-dismissable"><small>Désolé mais il n\'y a pas assez de messages pour afficher le chat (minimum ' . $chat_nb_messages . ')</small></div>';
                            }
                        ?>
                    </div>
                    <hr>
                </div>
        </div>
        <!-- End Left Sidebar -->
        <?php echo $this->element('sidebar'); ?>
    </div><!--/row-->
</div><!--/container-->
<!--=== End Content Part ===-->