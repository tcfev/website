<?php
    include_once 'cal/session.header.php';
    include_once 'cal/cheader.cal.php';
    include_once phproot.'pg/cal/lang.php';
    include_once 'inc/blog.datafetch.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $l; ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $blog['title']; ?></title>
    <?php include_once phproot.'pg/inc/head.php'; ?>
</head>
<body>
    <section id="header" class="pos-r h-100vh">
        <article class="dark">
        <?php include_once phproot.'pg/inc/menu.php' ?>
        </article>
        <article>
            <div class="container h-100v">
            </div>
        </article>
        <article class="pos-r">
            <div class="container h-100v pos-f" style="top:0;left:0;z-index:1">
                <div class="f-row jcc aic h-100v">
                    <h1 class="fs-3xsl fs-m-xxl fs-s-xl p-x-2" id="title" style="display:none"><?php echo $blog['title']; ?></h1>
                </div>
            </div>
        </article>
        <div id="scroll-point"></div>
        <div class="scroll-icon"></div>
    </section>

    <section class="bg-white pos-r" style="z-index:2">
        <section>
            <article class="p-t-10" style="min-height: 75vh">
                <div class="container-6 m-x-a p-y-10">
                    <div class="txt-j cl-grey-7 p-s-4">
                        <?php echo $blog['body']; ?>
                    </div>
                </div>
            </article>
        </section>

        <section>
            <article>
                <div class="container-6 m-x-a p-y-8">
                    <div class="w-100p ov-x-s project-gallery">
                        <div class="dsp-f w-max">
                            <?php $pg = $blog['gallery'];$j = -1;while(++$j < count($pg)) { ?>
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
    </section>
    
    <script src="<?php echo root; ?>js/var.js"></script>
    <script src="<?php echo root; ?>js/app.js"></script>
    <script src="<?php echo root; ?>js/kc.normal.js"></script>
    <script src="<?php echo root; ?>js/kc.observer.js"></script>
    <script src="<?php echo root; ?>js/scroll.vertical.js"></script>
    <script>
        const title = document.querySelector('#title');
        let elms = document.querySelectorAll('.project-gallery');
        let text = title.innerHTML;

        title.innerHTML = "";
        title.style.display = 'unset';
        console.log(Array.from(text));
        Array.from(text).forEach((elm) => {
            console.log(text);
            let s = document.createElement('span');
            s.classList.add('fancy-text');
            s.innerText = elm;
            title.appendChild(s);
        })
        const spanArray = title.querySelectorAll('.fancy-text');
        let counter = 0;
        setTimeout(() => {
            fancy(counter);
        }, 500);
        function fancy(counter) {
            spanArray[counter].classList.add('done');
            counter++;
            if (counter < spanArray.length) {
                setTimeout(() => {
                    fancy(counter);
                }, 50);
            }
        }
        window.addEventListener('scroll', (e)=>{
            scale = 1 + window.pageYOffset / 400;
            scale > 3.5 ? scale = 3.5 : scale = scale;
            title.style.transform = 'scale(' + scale + ')';
        })
        
        Array.from(elms).forEach((elm)=>{
            let scl = new VerticalScroll({target:elm});
            scl.init();
        })
    </script>
</body>
</html>