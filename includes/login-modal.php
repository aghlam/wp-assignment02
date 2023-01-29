
<?php 
    $errors = [];

    if (isset($_POST["submit-login"])) {
        $errors = login($_POST);

        if (!$errors) {
            redirect('./myServices.php');

        } else {
            echo "<script src='./js/login-util.js'></script>";
            
        }
    }
    
?>


<button type=" button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#loginModal">Sign-in</button>

<!-- Modal - Sourced from bootstrap https://getbootstrap.com/docs/5.3/components/modal/ and modified-->
<div class="modal fade in" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sign-in</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" name="login-form" id="login-form">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="text" name="email-login" class="form-control" id="email-login" aria-describedby="emailHelp" 
                            placeholder="Email address" value="<?= isset($_POST["email-login"]) ? $_POST["email-login"] : ''; ?>">
                        <?php displayText($errors, "email-login") ?>
                    </div>
                    <div class="mb-3">
                        <label for="password-login" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password-login" placeholder="Password">
                        <?php displayText($errors, "password") ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit-login" id="login-submit">Sign-in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>