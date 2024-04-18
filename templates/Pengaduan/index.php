<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pengaduan[]|\Cake\Collection\CollectionInterface $pengaduan
 */
?>

<?php
// Ambil level pengguna dari Identity
$userLevel = $this->Identity->get('level');
$userId = $this->Identity->get('id');
?>

<?php
$this->assign('title', __('Pengaduan'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Pengaduan')],
]);
?>


<div class="card card-primary card-outline">
    <div class="card-header d-flex flex-column flex-md-row">
        <h2 class="card-title">
            <!-- -->
        </h2>
        <div class="d-flex ml-auto">
            <?= $this->Paginator->limitControl([], null, [
                'label' => false,
                'class' => 'form-control form-control-sm',
                'templates' => ['inputContainer' => '{{content}}']
            ]); ?>
            <?php if ($userLevel == 'masyarakat') : ?>
                <?= $this->Html->link(__('New Pengaduan'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm ml-2']) ?>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('tg_pengaduan') ?></th>
                    <th><?= $this->Paginator->sort('isi_laporan') ?></th>
                    <th><?= $this->Paginator->sort('foto') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('petugas_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $status=['0'=>'Baru','proses'=>'Proses','selesai'=>'Selesai'];?>
                <?php foreach ($pengaduan as $pengaduan) : ?>
                    <tr>
                        <td><?= $this->Number->format($pengaduan->id) ?></td>
                        <td><?= h($pengaduan->tg_pengaduan) ?></td>
                        <td><?= h($pengaduan->isi_laporan) ?></td>
                        <td><?= $this->Html->image('pengaduan/'.$pengaduan->foto,['height'=>'100px']) ?></td>
                        <td><?= h($status[$pengaduan->status]) ?></td>
                        <td><?= $pengaduan->has('petuga') ? $this->Html->link($pengaduan->petuga->nama, ['controller' => 'Petugas', 'action' => 'view', $pengaduan->petuga->id]) : '' ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $pengaduan->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pengaduan->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pengaduan->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $pengaduan->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer d-flex flex-column flex-md-row">
        <div class="text-muted">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </div>
        <ul class="pagination pagination-sm mb-0 ml-auto">
            <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
        </ul>
    </div>
    <!-- /.card-footer -->
</div>
