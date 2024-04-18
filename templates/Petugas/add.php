<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Petuga $petuga
 */
?>


<?php
$this->assign('title', __('Add Petuga'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Petugas'), 'url' => ['action' => 'index']],
    ['title' => __('Add')],
]);
?>


<div class="card card-primary card-outline">
    <?= $this->Form->create($petuga, ['valueSources' => ['query', 'context']]) ?>
    <div class="card-body">
        <?php $isi=$this->Identity->get('level');
            if ($isi=='admin') {
                $level=['masyarakat'=>'Masyarakat','petugas'=>'Petugas','admin'=>'Admin'];
            } else if ($isi=='petugas') {
                $level=['masyarakat'=>'Masyarakat','petugas'=>'Petugas'];
            } else {
                $level=['masyarakat'=>'Masyarakat'];
            }
            
            echo $this->Form->control('nik');
            echo $this->Form->control('nama');
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('telp');
            echo $this->Form->control('level',['options' => $level]);
        ?>
    </div>
    <div class="card-footer d-flex">
        <div class="ml-auto">
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
