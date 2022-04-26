<?php
    include_once 'pg/cal/session.header.php';
    include_once 'pg/cal/cheader.cal.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $l; ?>" style="overflow: hidden">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCF</title>
    <?php include_once phproot.'pg/inc/head.php'; ?>
    <?php include_once phproot.'pg/inc/index.datafetch.php'; ?>
</head>
<body class="not-loaded">
    <section class="bg-white pos-r" id="top-part" style="z-index:4">
    <?php
        include_once phproot.'pg/inc/transition.post.php';
        include_once phproot.'pg/inc/index.simple.php';
        include_once phproot.'pg/inc/index.mainpage.php';
        include_once phproot.'pg/inc/index.article.php';
        include_once phproot.'pg/inc/index.projects.php';
        include_once phproot.'pg/inc/index.blogs.php';
    ?>
    </section>
    <section class="h-100v ov-x-h" id="join">
    <?php
        include_once phproot.'pg/inc/index.join.php';
    ?>
    </section>
    <section class="container p-t-9 pos-r main-bg-7 cl-white shdw-t" style="z-index:3" id="bottom-part">
    <?php
        include_once phproot.'pg/inc/index.members.php';
        include_once phproot.'pg/inc/index.footer.php';
    ?>
    </section>

    <script src="<?php echo root; ?>js/var.js"></script>
    <script src="<?php echo root; ?>js/app.js"></script>
    <script src="<?php echo root; ?>js/kc.normal.js"></script>
    <script src="<?php echo root; ?>js/kc.observer.js"></script>
    <script src="<?php echo root; ?>js/scroll.vertical.js"></script>

    <script>
        const borders = document.getElementById('borders');
        const text_h1 = document.querySelector('#texts h1');
        const text_p = document.querySelector('#texts p');
        const btn = document.querySelector('#fade');
        const fader = document.querySelector('#fade-circle');
        let elms = document.querySelectorAll('.project-gallery');
        let translinks = document.querySelectorAll('.trans-link');
        let timer;

        Array.from(translinks).forEach((tran) => {
            tran.addEventListener('click', function(e){
                e.preventDefault();
                let aa = this.href;
                let cl = '#' + this.getAttribute('kc-color');
                trans(aa, cl);
            })
        });

        function trans(link, color) {
            let par = document.querySelector('.transition');
            let cbtns = document.querySelectorAll('.transition-slide');
            Array.from(cbtns).forEach((cbtn)=>{
                cbtn.style.backgroundColor = color;
            })
            par.classList.add('animated');
            setTimeout(() => {
                window.location = link;
            }, 1500);
        }

        btn.addEventListener('click', ()=>{
            fader.classList.add('covering');
            setTimeout(()=>{
                borders.classList.add('hidden');
                setTimeout(() => {
                    borders.style.display = 'none';
                    document.body.classList.remove("not-loaded");
                    document.documentElement.style.overflow = 'unset';
                    document.documentElement.style.overflowX = 'hidden';
                }, 800);
            }, 900)
        })
        
        Array.from(elms).forEach((elm)=>{
            let scl = new VerticalScroll({target:elm});
            scl.init();
        })
        let oldScroll = window.scrollY;
        let isScrolling = false;
        let dir = null, oldDir = null;
        // window.addEventListener('wheel', (e)=>{
        //     let yd;
        //     // console.log(e.deltaY);
        //     yd = e.deltaY / 5;
        //     smoothYScroll(yd);
        // })

        window.addEventListener('scroll', (e)=>{
            // let yd = 10;
            // if (window.scrollY < oldScroll) {
            //     yd *= -1;
            //     dir = 'up';
            // } else if (window.scrollY > oldScroll) {
            //     dir = 'down';
            // } else if (window.scrollY == oldScroll) {
            //     yd = 0;
            // }
            // if (oldDir != dir && isScrolling) {
            //     clearTimeout(timer);
            //     isScrolling = false;
            // }
            // if (!isScrolling && yd != 0) {
            //     isScrolling = true;
            //     smoothYScroll(yd);
            // }
            // oldScroll = window.scrollY;
            // oldDir = dir;
        })

        function smoothYScroll(yd) {
            let y = window.scrollY + yd;
            window.scroll(0, y) ;
            yd = yd / 1.04;
            if (yd > 0.8 || yd < -0.8) {
                timer = setTimeout(() => {
                    smoothYScroll(yd);
                }, 15);
            } else {
                setTimeout(() => {
                    isScrolling = false;
                }, 25);
            }
        }
    </script>
</body>
</html>