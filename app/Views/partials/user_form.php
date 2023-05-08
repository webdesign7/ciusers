<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $field => $error): ?>
            <p><?= esc($error) ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>


<?= form_open(
    isset($data['id']) && !empty($data['id']) ? 'users/update' : 'users/store',
    array('novalidate' => true, 'class' => 'needs-validation', 'id' => 'userForm')
);
?>

<div class="form-group">
    <?= form_label('First Name', 'first_name'); ?>
    <?= form_input(['type' => 'text', 'name' => 'first_name', 'class' => 'form-control', 'id' => 'first_name', 'aria-describedby' => 'First name', 'placeholder' => "First name here", 'required' => true], $data['first_name'] ?? '') ?>
    <div class="invalid-feedback">Please enter a first name</div>
</div>

<div class="form-group">
    <?= form_label('Last Name', 'last_name'); ?>
    <?= form_input(['type' => 'text', 'name' => 'last_name', 'class' => 'form-control', 'id' => 'last_name', 'aria-describedby' => 'Last name', 'placeholder' => "Last name here", 'required' => true], $data['last_name'] ?? '') ?>
    <div class="invalid-feedback">Please enter a last name</div>
</div>

<div class="form-group">
    <?= form_label('Email Address', 'email'); ?>
    <?= form_input(['type' => 'email', 'name' => 'email', 'class' => 'form-control', 'id' => 'email', 'aria-describedby' => 'Email address', 'placeholder' => "Email address here", 'required' => true], $data['email'] ?? '') ?>
    <div class="invalid-feedback">Please enter a valid email address</div>
</div>


<div class="form-group">
    <?= form_label('Password', 'password'); ?>
    <?= form_password(['class' => 'form-control', 'name' => 'password', 'id' => 'password', 'aria-describedby' => 'Password', 'minlength' => "6", 'placeholder' => "Password here", 'required' => true]) ?>
    <div class="invalid-feedback">Please enter a password with minimum 6 length</div>
</div>

<?= form_hidden('id', $data['id'] ?? ''); ?>

<?= form_submit('submit', 'Submit', ['class' => 'btn btn-primary']); ?>

<?= form_button('submit', 'Cancel', [
    'class' => 'btn btn-default',
    'onclick' => "window.location='/'"
]);
?>

<?= form_close(); ?>