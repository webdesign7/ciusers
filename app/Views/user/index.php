<?= $this->extend('layout/default') ?>

<?= $this->section('extra-styles') ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-sm">
        <h1>Users</h1>
    </div>
    <div class="col-sm">
        <a class="btn btn-warning float-right mt-2" href="<?= url_to('UserController::create') ?>" role="button">Add new user</a>
    </div>
</div>

<hr>

<?php if (! empty($users) && is_array($users)) {  ?>

<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Date Created</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($users as $user){ ?>
        <tr>
            <td><?php echo esc($user['first_name']) . ' ' . esc($user['last_name']) ; ?></td>
            <td><?php echo esc($user['email']); ?></td>
            <td><?php echo date("d F Y", strtotime($user['created_at'])); ?></td>
            <td>
                <a class="btn btn-primary btn-sm" href="<?= url_to('UserController::edit', $user['id']) ?>" role="button">
                    Edit
                </a>
                <a onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-sm" href="<?= url_to('UserController::delete', $user['id']) ?>" role="button">
                    Remove
                </a>
            </td>
        </tr>
    <?php } ?>

    </tbody>
    <tfoot>
    <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Date Created</th>
        <th>Actions</th>
    </tr>
    </tfoot>
</table>

<?php } else { ?>

<h3>No Users Yet</h3>
<p>Unable to find any news for you. Please <a href="<?= url_to('UserController::create') ?>">add</a> a new User.</p>

<?php } ?>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <?php
        $script = ['src' => 'js/users.js', 'defer' => 'defer'];
        echo script_tag($script);
    ?>
<?= $this->endSection() ?>
