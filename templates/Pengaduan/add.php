<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pengaduan $pengaduan
 */
use Cake\I18n\FrozenTime;
$time = FrozenTime::now();
?>

<?php
$this->assign('title', __('Add Pengaduan'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Pengaduan'), 'url' => ['action' => 'index']],
    ['title' => __('Add')],
]);
?>

<div class="card card-primary card-outline">
    <?= $this->Form->create($pengaduan, ['valueSources' => ['query', 'context'],'type'=>'file']) ?>
    <div class="card-body">
    <?= $this->Form->control('tg_pengaduan',['value'=> $time->i18nFormat('yyyy-MM-dd HH:mm:ss'),'readonly'=>true]) ?>
        <?= $this->Form->control('isi_laporan') ?>
        <!-- <?= $this->Form->control('foto') ?> -->
        <?= $this->Form->control('images',['type'=>'file','required'=>true]) ?>
        <?= $this->Form->control('status',['type'=>'hidden','value'=>'0']) ?>

        <?= $this->Form->control('petugas_id', ['value' => $this->Identity->get('id'), 'class' => 'form-control' ,'type'=>'hidden']) ?>

                </div>
    <div class="card-footer d-flex">
        <div class="ml-auto">
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>