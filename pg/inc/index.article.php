<div class="container-6 m-x-a m-y-10 p-y-9 dsp-f aic" id="article-title">
    <div class="f-row p-4">
        <!-- <h2 class="fs-xxl fs-s-xl scroll-effect-scale"><span class="main-cl-5"><?php echo substr($article[0]['title'], 0, 1); ?></span><?php echo substr($article[0]['title'], 1); ?></h2> -->
        <h2 class="fs-xxl fs-s-xl scroll-effect-scale"><?php echo $article[0]['title']; ?></h2>
        <div class="txt-j scroll-effect-fade">
            <?php echo $article[0]['about']; ?>
        </div>
    </div>
</div>

<script>
    const par = document.querySelector('.scroll-effect-scale');
    const items = Array.from(par.innerHTML);
    const itemsJSON = new Array;
    par.innerHTML = '';
    items.forEach((elm, i) => {
        let s = document.createElement('span');
        s.classList.add('dsp-ib');
        if (i == 0)
            s.classList.add('main-cl-5');
        let sc = (Math.random() * 4.5 + 1.5);
        let x = (i * 50 - 300);
        let y = (Math.random() * 400 - 300);
        s.innerText = elm;
        s.style.transform = 'scale(' + sc + ') translate(' + x + 'px, ' + y + 'px)';
        s.style.opacity = '0';
        par.appendChild(s);
        itemsJSON[i] = {s, sc, x, y};
    });
    const anim_start = 0.2 * (window.pageYOffset + document.querySelector('#article-title').getBoundingClientRect().top);
    const anim_end = 0.9 * (window.pageYOffset + document.querySelector('#article-title').getBoundingClientRect().top);
    window.addEventListener('scroll', ()=>{
        if (window.pageYOffset > anim_start) {
            itemsJSON.forEach((elm, i) => {
                let r = (window.pageYOffset - anim_start) / (anim_end - anim_start);
                let sc = elm.sc - ((elm.sc - 1) * r);
                let o;
                sc < 1 ? sc = 1 : sc = sc;
                let x = elm.x - (elm.x * r);
                if (elm.x < 0)
                    x > 0 ? x = 0 : x = x;
                else
                    x < 0 ? x = 0 : x = x;
                let y = elm.y - (elm.y * r);
                if (elm.y < 0)
                    y > 0 ? y = 0 : y = y;
                else
                    y < 0 ? y = 0 : y = y;
                r > 1 ? o = 1 : o = r;
                console.log(sc, x, y);
                elm.s.style.transform = 'scale(' + sc + ') translate(' + x + 'px, ' + y + 'px)';
                elm.s.style.opacity = o;
            })
        }
    })
</script>