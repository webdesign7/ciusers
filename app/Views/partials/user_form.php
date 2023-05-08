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
    <?= form_label("First Name", "first_name") ?>
    <?= form_input(
        [
            "type" => "text",
            "name" => "first_name",
            "class" => "form-control",
            "id" => "first_name",
            "aria-describedby" => "First name",
            "placeholder" => "eg. Bob",
            "required" => true,
        ],
        $data["first_name"] ?? ""
    ) ?>
</div>

<div class="form-group">
    <?= form_label("Last Name", "last_name") ?>
    <?= form_input(
        [
            "type" => "text",
            "name" => "last_name",
            "class" => "form-control",
            "id" => "last_name",
            "aria-describedby" => "Last name",
            "placeholder" => "Last name here",
            "required" => true,
        ],
        $data["last_name"] ?? ""
    ) ?>
</div>

<div class="form-group">
    <?= form_label("Email Address", "email") ?>
    <?= form_input(
        [
            "type" => "email",
            "name" => "email",
            "class" => "form-control",
            "id" => "email",
            "aria-describedby" => "Email address",
            "placeholder" => "Email address here",
            "required" => true,
        ],
        $data["email"] ?? ""
    ) ?>
</div>

<div class="form-group">
    <?= form_label("Mobile ", "mobile") ?>
    <?= form_input(
        [
            "type" => "number",
            "name" => "mobile",
            "class" => "form-control",
            "id" => "mobile",
            "minlength" => "8",
            "maxlength" => "11",
            "aria-describedby" => "Mobile Number",
            "placeholder" => "eg. 087654234",
            "required" => true,
        ],
        $data["mobile"] ?? ""
    ) ?>
</div>

<div class="form-group">
    <?= form_label("Username", "username") ?>
    <?= form_input(
        [
            "type" => "text",
            "name" => "username",
            "class" => "form-control",
            "id" => "username",
            "aria-describedby" => "Username",
            "minlength" => "6",
            "placeholder" => "eg. superman",
            "required" => true,
        ],
        $data["username"] ?? ""
    ) ?>
</div>

<div class="form-group">
    <?= form_label("Strong password", "password") ?>
    <?= form_password([
        "class" => "form-control",
        "name" => "password",
        "id" => "password",
        "aria-describedby" => "Password",
        "minlength" => "6",
        "placeholder" => "678*&^YTGHRTGVdPO",
        "required" => true,
    ]) ?>
</div>

<?= form_hidden('id', $data['id'] ?? ''); ?>

<?= form_submit('submit', 'Submit', ['class' => 'btn btn-primary']); ?>

<?= form_button('submit', 'Cancel', [
    'class' => 'btn btn-default',
    'onclick' => "window.location='/'"
]);
?>

<?= form_close(); ?>