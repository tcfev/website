<?php
    include_once 'cal/session.header.php';
    include_once 'cal/cheader.cal.php';
    include_once phproot.'pg/cal/lang.php';
    include_once 'inc/project.datafetch.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $l; ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $project['title']; ?></title>
    <?php include_once phproot.'pg/inc/head.php'; ?>
</head>
<body>
    <?php include_once phproot.'pg/inc/transition.pre.php'; ?>
    <section id="header" class="pos-r h-100v">
        <article class="container dark">
            <?php include_once phproot.'pg/inc/menu.php' ?>
            <div class="f-row jcc m-t-9 pos-r" id="header-title">
                <div class="container-8 m-x-a dsp-f">
                    <div class="header-top-border"></div>
                    <div class="header-title">
                        <h1 class="fs-3xl fs-l-3xsl fs-s-xl">
                            <?php echo $project['title']; ?>
                        </h1>
                    </div>
                    <div class="header-side-border"></div>
                </div>
            </div>
        </article>
        <div class="scroll-icon"></div>
    </section>

    <section id="body">
        <article>
            <div class="container-6 m-x-a p-b-9">
                <div class="txt-j cl-grey-7 p-s-x-4 m-r-5">
                    <?php echo $project['body']; ?>
                </div>
            </div>
        </article>

        <article>
            <div class="container-6 m-x-a p-y-6">
                <div class="w-100p ov-x-s project-gallery">
                    <div class="dsp-f w-max">
                        <?php $pg = $project['gallery'];$j = -1;while(++$j < count($pg)) { ?>
                            <img loading="lazy" src="<?php echo root.$pg[$j]['photo']; ?>" alt="" class="h-300x m-x-3 scroll-effect-right">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </article>
    </section>

    <section id="footer">
        <?php 
        include_once phproot.'pg/inc/index.footer.php';
        ?>
    </section>
    <script src="<?php echo root; ?>js/var.js"></script>
    <script src="<?php echo root; ?>js/app.js"></script>
    <script src="<?php echo root; ?>js/kc.normal.js"></script>
    <script src="<?php echo root; ?>js/kc.observer.js"></script>
    <script src="<?php echo root; ?>js/scroll.vertical.js"></script>

    <script>
        const mainpage = document.querySelector('#header-title');
        let elms = document.querySelectorAll('.project-gallery');
		
		let cl = getCookie("trans_color");
		if (cl)
		{
			const par = document.querySelector('.transition-pre');
			setTimeout(() => {
				par.classList.add('animated');
				setTimeout(() => {
                	mainpage.classList.add('active');
				}, 1200);
			}, 700);
			delCookie("trans_color");
		}
		else
		{
			mainpage.classList.add('active');
		}
        

        Array.from(elms).forEach((elm)=>{
            let scl = new VerticalScroll({target:elm});
            scl.init();
        })
    </script>
    
</body>
</html>