<?php include_once 'cal/var.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogpost</title>
    <?php include_once phproot.'pg/inc/head.php'; ?>
</head>
<body>
    <section id="header">
        <article class="dark">
        <?php include_once phproot.'pg/inc/menu.php' ?>
        </article>
        <article>
            <div class="container h-100v">
            </div>
        </article>
        <article>
            <div class="container h-100v pos-f" style="top:0;left:0;z-index:1">
                <div class="f-row jcc aic h-100v">
                    <h1 class="fs-3xl" id="title">
                        BlogPost Title
                    </h1>
                </div>
            </div>
        </article>
    </section>

    <section class="bg-white pos-r" style="z-index:2">
        <section>
            <article>
                <div class="container-6 m-x-a p-y-10">
                    <p class="txt-j cl-grey-7">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, beatae magnam fuga aliquid iste perspiciatis veniam dolorum libero quae error cupiditate vero? Laudantium veritatis cum impedit ratione expedita, officiis minus?
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus illum quas, odio voluptatum ipsa molestiae reiciendis est dolores deserunt ad porro alias ipsam explicabo nisi quae cupiditate omnis veniam consequuntur?
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, repellat porro! Tempora quia illo et consequatur alias saepe maiores illum veniam minima architecto facere perferendis modi cupiditate voluptate, quidem totam?
                    </p>
                </div>
            </article>
        </section>

        <section>
            <article>
                <div class="container-6 m-x-a p-y-8">
                    <div class="w-100p ov-x-s project-gallery">
                        <div class="dsp-f w-max">
                            <img loading="lazy" src="https://source.unsplash.com/random?sig=3" alt="" class="h-300x m-x-3 scroll-effect-right">
                            <img loading="lazy" src="https://source.unsplash.com/random?sig=4" alt="" class="h-300x m-x-3 scroll-effect-right">
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
    </section>
    
    <script src="<?php echo root; ?>js/var.js"></script>
    <script src="<?php echo root; ?>js/kc.normal.js"></script>
    <script src="<?php echo root; ?>js/kc.observer.js"></script>
    <script>
        const title = document.querySelector('#title');
        let text = title.innerText;
        title.innerHTML = "";
        Array.from(text).forEach((elm) => {
            let s = document.createElement('span');
            s.classList.add('fancy-text');
            title.appendChild(s);
            s.append(elm);
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
    </script>
</body>
</html>