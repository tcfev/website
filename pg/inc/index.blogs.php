<div class="container p-t-8 bg-white">
    <div class="container-6 m-x-a p-s-4">
        <h2 class="fs-xl main-cl-6 righteous">Want to know more?</h2>
        <h3 class="fs-xm cl-black righteous">Here are our blog posts</h3>
    </div>
</div>
<div class="container p-b-8 p-t-3 p-x-6 p-s-x-1 shdw-b project-gallery ov-x-a">
    <div class="w-max dsp-f">
        <?php $i = -1;while (++$i < count($blogs)) { ?>
        <div href="blog/<?php echo $blogs[$i]['ID']; ?>" class="pos-r p-7 blog m-3 brr-2">
            <div href="blog/<?php echo $blogs[$i]['ID']; ?>" class="dsp-f">
                <div class="f-holder-1 dsp-f f-d-col jcc p-0" style="min-height:300px">
                    <div class="blog-frame bg-white">
                        <iframe scrolling="no" loading="lazy" src="blog/<?php echo $blogs[$i]['ID']; ?>" frameborder="0"></iframe>
                    </div>
                    <div class="container blur dsp-f aic jcc blog-content">
                        <div class="cl-grey-7 container-8 txt-j p-2 blur-p">
                            <?php echo substr($blogs[$i]['body'], 0, 230)."..."; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-9 blur-a m-x-a txt-r m-t-4">
                <a href="blog/<?php echo $blogs[$i]['ID']; ?>" class="blog-link p-4 main-cl-6">
                    See more
                </a>
            </div>
        </div>
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