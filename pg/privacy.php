<?php
    include_once 'cal/session.header.php';
    include_once 'cal/cheader.cal.php';
    include_once phproot.'pg/cal/lang.php';
    include_once phproot.'pg/inc/privacy.datafetch.php';
	
?>
<!DOCTYPE html>
<html class="" lang="<?php echo $l; ?>" style="overflow-x:hidden">
<head>
    <?php include_once phproot.'pg/inc/head.php'; ?>
    <meta name="description" content="">
    <title>Privacy policy</title>
</head>
<body style="overflow-x:hidden bg-light">
	<?php include_once phproot.'pg/inc/transition.pre.php'; ?>
    <main class="main-bg p-b-6">
        <article class="light">
            <?php include_once phproot.'pg/inc/menu.php'; ?>
            <div class="container p-y-9" id="membership-container">
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
    <section id="form" class="m-b-9">
        <div class="container-7 m-x-a m-t-n5">
            <div class="f-row jcc">
                <div class="f-holder-1 brr-3 shdw-2 bg-white p-3 p-t-7 m-t-n5">
                    <?php echo $form[$l]; ?>
                </div>
            </div>
        </div>
    </section>
    <section id="footer">
        <?php 
        include_once phproot.'pg/inc/index.footer.php';
        ?>
    </section>

    <script src="<?php echo root; ?>js/var.js"></script>
    <script src="<?php echo root; ?>js/kc.normal.js"></script>
    <script src="<?php echo root; ?>js/app.js"></script>

	<script>
		let cl = getCookie("trans_color");
		if (cl)
		{
			const par = document.querySelector('.transition-pre');

			setTimeout(() => {
				par.classList.add('animated');
			}, 700);
			delCookie("trans_color");
		}
    </script>
</body>
</html>