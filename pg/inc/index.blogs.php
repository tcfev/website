<div class="container p-t-8 bg-light">
    <div class="container-6 m-x-a p-s-4">
        <h2 class="fs-xl main-cl-6 righteous">Want to know more?</h2>
        <h3 class="fs-xm cl-black righteous">Here are our blog posts</h3>
    </div>
</div>
<div class="container p-b-8 p-t-3 p-x-6 p-s-x-1 m-t-7 shdw-b project-gallery ov-x-a">
    <div class="w-max dsp-f">
        <?php $i = -1;while (++$i < count($blogs)) { ?>
        <a href="blog/<?php echo $blogs[$i]['ID']; ?>" class="pos-r p-1 blog m-3 cl-grey-8 brr-3 bg-white">
            <div href="blog/<?php echo $blogs[$i]['ID']; ?>" class="dsp-f">
                <div class="f-holder-1 dsp-f f-d-col jcc p-0" style="min-height:300px">
                    <div class="blog-frame dsp-f p-2 jcc aic">
                        <h3 class="fs-xxl fs-s-xm"><?php echo $blogs[$i]['title']; ?></h3>
                        <div class="cl-grey-7 mobile container-8 txt-j blur-p">
                            <span><?php echo substr($blogs[$i]['body'], 0, 200)."... "; ?></span><span class="fs-s cl-blue-5">read more</span>
                        </div>
                    </div>
                    <div class="container blur desktop dsp-f aic jcc blog-content">
                        <div class="container-8 txt-j p-2 blur-p">
                            <?php echo substr($blogs[$i]['body'], 0, 300)."... "; ?><span class="fs-s cl-blue-5">read more</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <?php } ?>
    </div>
</div>

<script>
    const bloglinks = document.querySelectorAll('.blog-link');

    Array.from(bloglinks).forEach(elm => {
        elm.addEventListener('click', (e)=>{
            e.preventDefault();
            let tg = e.currentTarget.href;
            let par = e.currentTarget.parentElement;
            while (!par.classList.contains('blog'))
                par = par.parentElement;
            par.classList.add('active');
            setTimeout(() => {
                window.location = tg;
            }, 800);
        })
    });
</script>