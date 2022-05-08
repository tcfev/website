<?php
    include_once 'pg/cal/session.header.php';
    include_once 'pg/cal/cheader.cal.php';
    include_once phproot.'pg/cal/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $l; ?>" <?php if (!isset($_COOKIE['is_seen']) || $_COOKIE['is_seen'] != "true") {?>style="overflow: hidden"<?php } ?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCF</title>
    <?php include_once phproot.'pg/inc/head.php'; ?>
    <?php include_once phproot.'pg/inc/index.datafetch.php'; ?>
</head>
<body  <?php if (!isset($_COOKIE['is_seen']) || $_COOKIE['is_seen'] != "true") {?>class="not-loaded"<?php } ?>>
    <section class="bg-white pos-r" id="top-part" style="z-index:4">
    <?php
        include_once phproot.'pg/inc/transition.post.php';
        if (!isset($_COOKIE['is_seen']) || $_COOKIE['is_seen'] != "true")
            include_once phproot.'pg/inc/index.simple.php';
        include_once phproot.'pg/inc/index.mainpage.php';
        include_once phproot.'pg/inc/index.article.php';
        include_once phproot.'pg/inc/index.projects.php';
        include_once phproot.'pg/inc/index.blogs.php';
    ?>
    </section>
    <section class="ov-x-h" id="join">
    <?php
        include_once phproot.'pg/inc/index.join.php';
    ?>
    </section>
    <section class="container h-100v ov-h p-b-10" style="z-index:3" id="bottom-part">
        <div class="container-8 brr-2 m-x-a m-b-6 p-t-8 pos-r main-bg-7 cl-white shdw-t" id="hidden-part">
        <div class="pullup-icon"></div>
        <?php
            include_once phproot.'pg/inc/index.members.php';
            include_once phproot.'pg/inc/index.footer.php';
        ?>
        </div>
    </section>
    

    <script src="<?php echo root; ?>js/var.js"></script>
    <script src="<?php echo root; ?>js/app.js"></script>
    <script src="<?php echo root; ?>js/kc.normal.js"></script>
    <script src="<?php echo root; ?>js/kc.observer.js"></script>
    <script src="<?php echo root; ?>js/scroll.vertical.js"></script>

    <script>
        if (getCookie("is_seen") == "") {
            const borders = document.getElementById('borders');
            const btn = document.querySelector('#fade');
            const fader = document.querySelector('#fade-circle');

            btn.addEventListener('click', ()=>{
            fader.classList.add('covering');
            setCookie("is_seen", "true", 90);
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
        }
        const text_h1 = document.querySelector('#texts h1');
        const text_p = document.querySelector('#texts p');
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
        
        Array.from(elms).forEach((elm)=>{
            let scl = new VerticalScroll({target:elm});
            scl.init();
        })

        let yDown = null, yUp = null;
        let wheel_count = 0, yDiff = 0;
        const hidden_part = document.querySelector('#hidden-part');
        let is_hidden = true;

        window.addEventListener('wheel', (e)=>{
            if (is_hidden) {
                if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {
                    wheel_count++;
                    hidden_part.style.transform = 'translateY('+ (window.innerHeight - (55 + wheel_count * 30)) + 'px)';
                    if (wheel_count > 5) {
                        hidden_part.style.transform = 'translateY(100px)';
                        hidden_part.parentElement.style.height = 'auto';
                        is_hidden = false;
                    }
                    setTimeout(()=>{
                        if (wheel_count < 6)
                        {
                            hidden_part.style.transform = 'translateY('+ (window.innerHeight - 55) + 'px)';
                            wheel_count = 0;
                        }
                    }, 200)
                }
            } else {
                if (hidden_part.getBoundingClientRect().top > -400 && e.deltaY < 0)
                {
                    hidden_part.style.transform = 'translateY('+ (window.innerHeight - 55) + 'px)';
                    hidden_part.parentElement.style.height = window.innerHeight + 'px';
                    is_hidden = true;
                    wheel_count = 0;
                }
            }
        })

        window.addEventListener('touchmove', (e)=>{
            if (!yDown) {
                return;
            }
            yUp = e.touches[0].clientY;
        
            yDiff = yDown - yUp;
            
            if (is_hidden) {
                if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight && yDiff > 0) {
                    hidden_part.style.transform = 'translateY('+ (window.innerHeight - (55 + yDiff * 3)) + 'px)';
                    if (yDiff > 11) {
                        hidden_part.style.transform = 'translateY(100px)';
                        hidden_part.parentElement.style.height = 'auto';
                        is_hidden = false;
                    }
                    setTimeout(()=>{
                        if (yDiff < 12)
                        {
                            hidden_part.style.transform = 'translateY('+ (window.innerHeight - 55) + 'px)';
                            yDiff = 0;
                        }
                    }, 200)
                }
            } else {
                if (hidden_part.getBoundingClientRect().top > -400 && yDiff < 0)
                {
                    hidden_part.style.transform = 'translateY('+ (window.innerHeight - 55) + 'px)';
                    hidden_part.parentElement.style.height = window.innerHeight + 'px';
                    is_hidden = true;
                    yDiff = 0;
                }
            }

            yDown = null;
        }, {passive: true});

        window.addEventListener('touchstart', (e)=>{
            const firstTouch = getTouches(e)[0];
            yDown = firstTouch.clientY;
        }, {passive: true})

    </script>
</body>
</html>