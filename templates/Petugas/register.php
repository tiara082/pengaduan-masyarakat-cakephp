<?php
/**
 * @var \App\View\AppView $this
 */

$this->layout = 'CakeLte.login';
?>

<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg"><?= __('Daftar akun baru') ?></p>

        <?= $this->Form->create() ?>

        <?= $this->Form->hidden('level', ['value' => 'masyarakat']) ?>

        <?= $this->Form->control('nik', [
            'placeholder' => __('Nomor Induk Kependudukan'),
            'label' => false,
            'append' => '<i class="fas fa-id-card"></i>',
        ]) ?>

        <?= $this->Form->control('nama', [
            'placeholder' => __('Nama Lengkap'),
            'label' => false,
            'append' => '<i class="fas fa-user"></i>',
        ]) ?>

        <?= $this->Form->control('username', [
            'placeholder' => __('Username'),
            'label' => false,
            'append' => '<i class="fas fa-user-circle"></i>',
        ]) ?>

        <?= $this->Form->control('password', [
            'placeholder' => __('Password'),
            'label' => false,
            'append' => '<i class="fas fa-lock"></i>',
        ]) ?>

        <?= $this->Form->control('telp', [
            'placeholder' => __('No. Telpon'),
            'label' => false,
            'append' => '<i class="fas fa-phone"></i>',
        ]) ?>
<?= $this->Form->hidden('level', ['value' => 'masyarakat']) ?>

        <div class="row justify-content-center">
            <div class="col-4">
                <?= $this->Form->control(__('Register'), [
                    'type' => 'submit',
                    'class' => 'btn btn-primary btn-block',
                ]) ?>
            </div>
        </div>

        <?= $this->Form->end() ?>

        <div class="social-auth-links text-center mb-3">
         Sudah Memiliki akun? <?= $this->Html->link(__('Login akun'), ['action' => 'login']) ?>
        </div>

    </div>
    <!-- /.register-card-body -->
</div>
