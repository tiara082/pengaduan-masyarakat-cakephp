<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Petuga $petuga
 */
?>

<?php
$this->assign('title', __('Petuga'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Petugas'), 'url' => ['action' => 'index']],
    ['title' => __('View')],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"><?= h($petuga->nama) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Nik') ?></th>
                <td><?= h($petuga->nik) ?></td>
            </tr>
            <tr>
                <th><?= __('Nama') ?></th>
                <td><?= h($petuga->nama) ?></td>
            </tr>
            <tr>
                <th><?= __('Username') ?></th>
                <td><?= h($petuga->username) ?></td>
            </tr>
            <tr>
                <th><?= __('Telp') ?></th>
                <td><?= h($petuga->telp) ?></td>
            </tr>
            <tr>
                <th><?= __('Level') ?></th>
                <td><?= h($petuga->level) ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($petuga->id) ?></td>
            </tr>
        </table>
    </div>
    <div class="card-footer d-flex">
        <div class="mr-auto">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $petuga->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $petuga->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $petuga->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
