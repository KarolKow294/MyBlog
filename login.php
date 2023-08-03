<?php

require 'includes/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = require 'includes/db.php';

    if (User::authenticate($conn, $_POST['username'], $_POST['password'])) {
        
        Auth::login();

        Url::redirect('/');

    } else {
        
        $error = "login incorrect";

    }
}

?>
<?php require 'includes/header.php'; ?>

<div class="form-center">
    <div class="form">
        <h2>Login</h2>

        <?php if (! empty($error)) : ?>
            <p><?= $error ?></p>
        <?php endif; ?>

        <form method="post">

            <div class="form-group">
                <label for="username">Username</label>
                <input name="username" id="username" class="form-control" placeholder="Username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </div>

            <div class="button-to-submit">
                <button class="btn">Log in</button>
            </div>

        </form>
    </div>
</div>

<?php require 'includes/footer.php'; ?>
