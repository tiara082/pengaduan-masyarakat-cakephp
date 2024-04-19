<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tanggapan[]|\Cake\Collection\CollectionInterface $tanggapan
 */
?>
<?php
// Ambil level pengguna dari Identity
$userLevel = $this->Identity->get('level');
$userId = $this->Identity->get('id');
?>
<?php
$this->assign('title', __('Tanggapan'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Tanggapan')],
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

            <?php if ($userLevel == 'admin' || $userLevel == 'petugas' ) : ?>
                <?= $this->Html->link(__('New Tanggapan'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm ml-2']) ?>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('tg_tanggapan') ?></th>
                    <th><?= $this->Paginator->sort('isi_laporan') ?></th>
                    <th><?= $this->Paginator->sort('petugas_id') ?></th>
                    <th><?= $this->Paginator->sort('pengaduan_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tanggapan as $tanggapan) : ?>
                    <tr>
                        <td><?= $this->Number->format($tanggapan->id) ?></td>
                        <td><?= h($tanggapan->tg_tanggapan) ?></td>
                        <td><?= h($tanggapan->isi_laporan) ?></td>
                        <td><?= $tanggapan->has('petuga') ? $this->Html->link($tanggapan->petuga->nama, ['controller' => 'Petugas', 'action' => 'view', $tanggapan->petuga->id]) : '' ?></td>
                        <td><?= $tanggapan->has('pengaduan') ? $this->Html->link($tanggapan->pengaduan->isi_laporan, ['controller' => 'Pengaduan', 'action' => 'view', $tanggapan->pengaduan->id]) : '' ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $tanggapan->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tanggapan->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tanggapan->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $tanggapan->id)]) ?>
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