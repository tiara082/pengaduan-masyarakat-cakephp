<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tanggapan $tanggapan
 */
?>

<?php
$this->assign('title', __('Tanggapan'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Tanggapan'), 'url' => ['action' => 'index']],
    ['title' => __('View')],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"><?= h($tanggapan->isi_laporan) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Isi Laporan') ?></th>
                <td><?= h($tanggapan->isi_laporan) ?></td>
            </tr>
            <tr>
                <th><?= __('Petuga') ?></th>
                <td><?= $tanggapan->has('petuga') ? $this->Html->link($tanggapan->petuga->nama, ['controller' => 'Petugas', 'action' => 'view', $tanggapan->petuga->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Pengaduan') ?></th>
                <td><?= $tanggapan->has('pengaduan') ? $this->Html->link($tanggapan->pengaduan->isi_laporan, ['controller' => 'Pengaduan', 'action' => 'view', $tanggapan->pengaduan->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($tanggapan->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Tg Tanggapan') ?></th>
                <td><?= h($tanggapan->tg_tanggapan) ?></td>
            </tr>
        </table>
    </div>
    <div class="card-footer d-flex">
        <div class="mr-auto">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tanggapan->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tanggapan->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tanggapan->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
