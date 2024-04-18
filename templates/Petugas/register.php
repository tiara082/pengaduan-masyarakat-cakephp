<?php
/**
 * @var \App\View\AppView $this
 */

$this->layout = 'CakeLte.login';
?>

<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg"><?= __('Register a new membership') ?></p>

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

        <div class="row">
            <div class="col-8">
                <?= $this->Form->control('agree_terms', [
                    'label' => 'I agree to the <a href="#">terms</a>',
                    'type' => 'checkbox',
                    'custom' => true,
                    'escape' => false,
                ]) ?>
            </div>
            <div class="col-4">
                <?= $this->Form->control(__('Register'), [
                    'type' => 'submit',
                    'class' => 'btn btn-primary btn-block',
                ]) ?>
            </div>
        </div>

        <?= $this->Form->end() ?>

        <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <?= $this->Html->link(
                '<i class="fab fa-facebook-f mr-2"></i>' . __('Sign up using Facebook'),
                '#',
                ['class' => 'btn btn-block btn-primary', 'escape' => false]
            ) ?>
            <?= $this->Html->link(
                '<i class="fab fa-google mr-2"></i>' . __('Sign up using Google'),
                '#',
                ['class' => 'btn btn-block btn-danger', 'escape' => false]
            ) ?>
        </div>

        <?= $this->Html->link(__('I already have a membership'), ['action' => 'login']) ?>
    </div>
    <!-- /.register-card-body -->
</div>
