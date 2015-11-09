<?php $this->assign('title', 'Gestion du F.A.Q'); ?>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Ajouter une question et réponse au F.A.Q</h5>
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
                        <?php echo $this->Form->create('Faq', ['inputDefaults' => ['error' => false]]); ?>
                            <div class="form-group">
                                <?php echo $this->Form->input('question', array('type' => 'text', 'maxlength' => 255, 'placeholder' => 'Question à afficher', 'class' => 'form-control', 'label' => false, 'required' => 'required')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->input('answer', array('type' => 'text', 'maxlength' => 255, 'placeholder' => 'Réponse à afficher', 'class' => 'form-control', 'label' => false, 'required' => 'required')); ?>
                            </div>
                            <hr>
                            <button class="btn btn-w-m btn-primary pull-right" type="submit"><i class="fa fa-check"></i> Confirmer</button>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'stats']); ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Annuler</a>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>List des Questions et Réponses</h5>
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
                        <table class="table table-bordered table-hover dataTables-example dataTable dtr-inline" id="data-table">
                            <thead>
                                <tr>
                                    <th><b>Question</b></th>
                                    <th><b>Réponse</b></th>
                                    <th><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data as $d){ ?>
                                <tr>
                                    <td><?php echo $d['Faq']['question']; ?></td>
                                    <td><?php echo $d['Faq']['answer']; ?></td>
                                    <td>
                                        <a href="<?php echo $this->Html->url(['controller' => 'faq', 'action' => 'admin_delete', $d['Faq']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Supprimer</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>