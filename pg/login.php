<?php
    include_once 'cal/var.php';
    include_once phproot.'pg/cal/lang.php';
    include_once phproot.'pg/cal/cheader.cal.php';
    
    if (isset($_SESSION['u_upost'])) {
        if ($_SESSION['u_upost'] == 'admin') {
            echo '<script>window.location = "'.root.'panel"</script>';
        }
    }
    $lang = 'en';
    $_SESSION['lang'] = $lang;
    $pg = 'log';
?>
<!DOCTYPE html>
<html class="" lang="<?php echo $lang; ?>" style="overflow-x:hidden">
<head>
    <?php include_once phproot.'pg/inc/head.php'; ?>
    <meta name="description" content="">
    <title>CPanel - login</title>
</head>
<body style="overflow-x:hidden">
    <main class="main-bg h-100v">
        <article class="light">
            <?php include_once phproot.'pg/inc/menu.php'; ?>
            <div class="container p-y-9" id="login-container">
                <div class="f-row jcc">
                    <div class="f-holder-1 bg-white shdw-1 p-6" style="max-width:450px;min-width:unset">
                        <h1 class="m-b-3">Login</h1>
                        <form kc-mode="form-submit" kc-func="login">
                            <input class="p-1 m-y-2" type="text" name="username" required placeholder="Username">
                            <div class="password m-b-3"><input class="p-1 m-y-2" type="password" required name="pwd" placeholder="Password"><span class="show icon-eye hvr-cl-blue-3"></span></div>
                            <button class="p-x-2 p-y-1 m-y-2" type="submit" value="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </main>

    <script src="<?php echo root; ?>js/var.js"></script>
    <script src="<?php echo root; ?>js/kc.normal.js"></script>
    <script src="<?php echo root; ?>js/app.js"></script>

    <script>
    </script>
</body>
</html>