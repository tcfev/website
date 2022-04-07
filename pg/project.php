<?php include_once 'cal/var.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <?php include_once phproot.'pg/inc/head.php'; ?>
</head>
<body>
    <?php include_once phproot.'pg/inc/transition.pre.php'; ?>
    <section id="header">
        <article class="container dark">
            <?php include_once phproot.'pg/inc/menu.php' ?>
            <div class="f-row jcc aic h-100v">
                <div class="container-8 m-x-a dsp-f">
                    <div class="header-top-border"></div>
                    <div class="header-title">
                        <h1 class="fs-3xl">
                            Project One Title
                        </h1>
                    </div>
                    <div class="header-side-border"></div>
                </div>
            </div>
        </article>
    </section>

    <section id="body">
        <article>
            <div class="container-6 m-x-a p-b-9">
                <p class="txt-j cl-grey-7">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia temporibus, maiores sapiente error id et corrupti doloribus! Voluptatem, officiis veritatis laboriosam iusto modi autem libero, iure, vel pariatur at amet?
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa cum blanditiis dolorum voluptas aperiam sit fugit id eaque quia. Itaque consequuntur facilis eveniet ea amet similique reprehenderit repellendus nulla perferendis.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore dolorem corrupti laudantium aspernatur officia modi excepturi nesciunt iure unde illo ipsum, culpa pariatur facere accusamus doloribus ut hic suscipit ea!
                    <br>
                    <br>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure molestiae eum reiciendis harum, architecto fuga ut facere unde fugiat voluptate natus deserunt magni earum laudantium veritatis odio tenetur velit quam?
                </p>
            </div>
        </article>

        <article>
            <div class="container-6 m-x-a p-y-6">
                <div class="w-100p ov-x-s project-gallery">
                    <div class="dsp-f w-max">
                        <img loading="lazy" src="https://source.unsplash.com/random?sig=5" alt="" class="h-300x m-x-3 scroll-effect-right">
                        <img loading="lazy" src="https://source.unsplash.com/random?sig=6" alt="" class="h-300x m-x-3 scroll-effect-right">
                        <img loading="lazy" src="https://source.unsplash.com/random?sig=7" alt="" class="h-300x m-x-3 scroll-effect-right">
                        <img loading="lazy" src="https://source.unsplash.com/random?sig=8" alt="" class="h-300x m-x-3 scroll-effect-right">
                        <img loading="lazy" src="https://source.unsplash.com/random?sig=9" alt="" class="h-300x m-x-3 scroll-effect-right">
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
    <script src="<?php echo root; ?>js/kc.normal.js"></script>
    <script src="<?php echo root; ?>js/kc.observer.js"></script>

    <script>
        const mainpage = document.querySelector('#header .f-row');
        const par = document.querySelector('.transition-pre');
        setTimeout(() => {
            par.classList.add('animated');
            setTimeout(() => {
                mainpage.classList.add('active');
            }, 1200);
        }, 700);
    </script>
    
</body>
</html>