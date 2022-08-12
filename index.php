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
    <style>
        #tcf_typo svg path{
            fill: #ddd !important;
            stroke: #ddd !important;
        }
    </style>
</head>
<body  <?php if (!isset($_COOKIE['is_seen']) || $_COOKIE['is_seen'] != "true") {?>class="not-loaded"<?php } ?>>
    <section class="bg-light pos-r" id="top-part" style="z-index:4">
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
    
    <section class="container h-100v ov-h p-b-10" style="z-index:0;" id="bottom-part">
    <section class="ov-x-h" id="join">
        <?php
            include_once phproot.'pg/inc/index.join.php';
        ?>
        </section>
        <div class="container-8 brr-2 pos-r m-x-a m-b-6 p-t-8 main-bg-7 cl-white shdw-t" style="pointer-events: all;z-index:2;" id="hidden-part">
            <div class="pullup">
				<div class="icon">

				</div>
			</div>
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
    <script src="<?php echo root; ?>js/side.anim.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.9.4/lottie.min.js" integrity="sha512-ilxj730331yM7NbrJAICVJcRmPFErDqQhXJcn+PLbkXdE031JJbcK87Wt4VbAK+YY6/67L+N8p7KdzGoaRjsTg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        window.addEventListener('hashchange',(e) => {
            if (location.hash === '#bottom-part') {
                hidden_part.style.transform = 'translateY(100px)';
                hidden_part.parentElement.style.height = 'auto';
                is_hidden = false;
                isDrag = false;
            }
        })
        var animation = bodymovin.loadAnimation({
            container: document.getElementById('tcf_typo'),
            path: root + 'content/json/tcf_typo.json',
            renderer: 'svg',
            loop: false,
            autoplay: false
        })
        animation.setSpeed(1.8);
        if (getCookie("is_seen") == "true")
            animation.play();

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
                    animation.play();
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
				setCookie("trans_color", cl, 90);
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
        let isDrag = false;
        let mousePos = {x:null, y:null};
        let is_hidden = true;let deltaY = 0;
        hidden_part.addEventListener("mousedown", (e)=>{
            isDrag = true;
            mousePos = {x:e.clientX, y:e.clientY};
        })
        window.addEventListener("mouseup", (e)=>{
            isDrag = false;
            mousePos = {x:null, y:null};
        })
        window.addEventListener("mousemove", (e)=>{
            if (isDrag)
            {
                if (is_hidden) {
                    deltaY = mousePos.y - e.clientY;
                    hidden_part.style.transform = 'translateY('+ (window.innerHeight - (55 + deltaY * 4)) + 'px)';
                    if (deltaY > 300) {
                        hidden_part.style.transform = 'translateY(100px)';
                        hidden_part.parentElement.style.height = 'auto';
                        is_hidden = false;
                        isDrag = false;
                    }
                    setTimeout(()=>{
                        if (deltaY < 301)
                        {
                            hidden_part.style.transform = 'translateY('+ (window.innerHeight - 55) + 'px)';
                            deltaY = 0;
                            isDrag = false;
                            removeHash();
                        }
                    }, 600)
                }
            }
        })
        function removeHash () { 
            history.pushState("", document.title, window.location.pathname + window.location.search);
        }
        hidden_part.querySelector('.pullup').addEventListener("click", ()=>{
            if (hidden_part.querySelector('.pullup .icon').classList.contains('active'))
				hide_about();
			else
				show_about();
        })
        window.addEventListener('wheel', (e)=>{
            console.log();
            if (is_hidden) {
                // if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {
                //     wheel_count += e.deltaY;
                //     hidden_part.style.transform = 'translateY('+ (window.innerHeight - (55 + wheel_count / 8)) + 'px)';
                //     if (wheel_count > 500) {
                //         hidden_part.style.transform = 'translateY(100px)';
                //         hidden_part.parentElement.style.height = 'auto';
                //         is_hidden = false;
                //     }
                //     setTimeout(()=>{
                //         if (wheel_count < 600)
                //         {
                //             hidden_part.style.transform = 'translateY('+ (window.innerHeight - 55) + 'px)';
                //             wheel_count = 0;
                //         }
                //     }, 200)
                // }
            } else {
                if (e.deltaY < 0 && hidden_part.getBoundingClientRect().top > -400)
                {
                    hide_about();
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
                // if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight && yDiff > 0) {
                //     hidden_part.style.transform = 'translateY('+ (window.innerHeight - (55 + yDiff * 3)) + 'px)';
                //     if (yDiff > 11) {
                //         hidden_part.style.transform = 'translateY(100px)';
                //         hidden_part.parentElement.style.height = 'auto';
                //         is_hidden = false;
                //     }
                //     setTimeout(()=>{
                //         if (yDiff < 12)
                //         {
                //             hidden_part.style.transform = 'translateY('+ (window.innerHeight - 55) + 'px)';
                //             yDiff = 0;
                //         }
                //     }, 200)
                // }
            } else {
                if (hidden_part.getBoundingClientRect().top > -400 && yDiff < 0)
                {
                    hide_about();
                }
            }

            yDown = null;
        }, {passive: true});

		function show_about() {
			hidden_part.style.transform = 'translateY(100px)';
            hidden_part.parentElement.style.height = 'auto';
			hidden_part.querySelector('.pullup .icon').classList.add('active');
            is_hidden = false;
		}

		function hide_about() {
			hidden_part.style.transform = 'translateY('+ (window.innerHeight - 55) + 'px)';
			hidden_part.parentElement.style.height = window.innerHeight + 'px';
			hidden_part.querySelector('.pullup .icon').classList.remove('active');
			is_hidden = true;
			removeHash();
			wheel_count = 0;
			yDiff = 0;
		}

        window.addEventListener('touchstart', (e)=>{
            const firstTouch = getTouches(e)[0];
            yDown = firstTouch.clientY;
        }, {passive: true})
    </script>
</body>
</html>