<div class="container p-y-8 bg-white">
    <div class="container-6 m-x-a p-s-4">
        <h2 class="fs-xl main-cl-6 righteous">Want to know more?</h2>
        <h3 class="fs-xm cl-black righteous">Here are our blog posts</h3>
    </div>
</div>
<div class="container p-y-8">
    <?php $i = -1;while (++$i < count($blogs)) { ?>
    <div class="f-row pos-r blog">
        <div class="f-holder-1 txt-c bg-white blog-title">
            <!-- <h1 class="fs-xl"><?php echo $blogs[$i]['title']; ?></h1> -->
        </div>
        <div class="f-holder-1 dsp-f f-d-col jcc p-0" style="min-height:400px">
            <div class="blog-frame bg-white">
                <iframe src="blog/<?php echo $blogs[$i]['ID']; ?>" frameborder="0"></iframe>
            </div>
            <div class="container blur dsp-f jcc f-d-col aic blog-content">
                <div class="cl-grey-7 container-6 txt-j p-2 blur-p">
                    <?php echo $blogs[$i]['body']; ?>
                </div>
                <a href="blog/<?php echo $blogs[$i]['ID']; ?>" class="blog-link p-1 bg-white shdw-2 dsp-f">
                    <img src="<?php echo root;?>content/img/play-svg.svg" class="w-50x pointer" alt="">
                </a>
            </div>
        </div>
    </div>
    <?php } ?>
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