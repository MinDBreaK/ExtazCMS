<?php
/**
 * Extaz-CMS - admin_index.php
 * Coded by TristanCode
 * Created: 10/30/15 at 8:58 PM
 */
    $this->assign('title', 'Mettre à jour');
    $cms_version         = Configure::read('cms.version');
    $cms_current_version = Configure::read('cms.current_version');
?>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Change Log</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                       <?= file_get_contents("http://extaz-cms.fr/changelog.html"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
