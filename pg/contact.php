<?php
    include_once 'cal/session.header.php';
    include_once 'cal/cheader.cal.php';
    include_once phproot.'pg/cal/lang.php';
    include_once phproot.'pg/inc/contact.datafetch.php';
	
?>
<!DOCTYPE html>
<html class="" lang="<?php echo $l; ?>" style="overflow-x:hidden">
<head>
    <?php include_once phproot.'pg/inc/head.php'; ?>
    <meta name="description" content="">
    <title>CPanel - login</title>
</head>
<body style="overflow-x:hidden">
    <main class="main-bg h-100v">
        <article class="light">
            <?php include_once phproot.'pg/inc/menu.php'; ?>
            <div class="container p-y-9" id="contact-container">
                <div class="f-row jcc aic">
                    <div class="container-6 m-x-a">
						<h1 class="cl-white fs-xxl fs-m-xl txt-c"><?php echo $tit[$l]; ?></h1>
						<p class="txt-j cl-light p-6">
							<?php echo $txt[$l]; ?>
						</p>
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