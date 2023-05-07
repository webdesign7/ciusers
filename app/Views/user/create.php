<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 text-center mt-1">
                        <h2>Add new user</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $this->include('partials/user_form') ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>

    <script>
        if ($("#userForm").length > 0) {
            $("#userForm").validate({
                rules: {
                    first_name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        maxlength: 60,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 6,
                    },
                },
                messages: {
                    first_name: {
                        required: "First name is required.",
                    },
                    last_name: {
                        required: "Last name is required.",
                    },
                    password: {
                        required: "Password is required.",
                        minlength: "Password should not be less than 6 characters",
                    },
                    email: {
                        required: "Email is required.",
                        email: "It does not seem to be a valid email.",
                        maxlength: "The email should be or equal to 60 chars.",
                    },
                },
            })
        }
    </script>

<?= $this->endSection() ?>
