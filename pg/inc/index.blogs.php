<div class="container-8 m-x-a p-b-2 p-t-8 dsp-f jca blog-tag-scroll">
	<div class="scroll-left-btn"></div>
	<div class="f-row jcl blog-tag-holder" id="blog-tag-holder">
		<span class="m-r-2 dsp-f aic main-bg-5 cl-white hvr-cl-bright-blue-3 pointer blog-tag p-x-3 p-y-1 brr-2" kc-mode="func-btn" kc-func="loadBlogsByTag" kc-id="0"><?php echo $langs['ind'][$l]['all'];?></span>
		<?php for ($i = 0; $i < count($blogTags); $i++) { $bt = $blogTags[$i];?>
			<span class="m-x-2 dsp-f aic hvr-cl-bright-blue-3 pointer blog-tag p-x-2 p-y-1 brr-2" kc-mode="func-btn" kc-func="loadBlogsByTag" kc-id="<?php echo $bt['ID']; ?>"><?php echo $bt['tag']; ?></span>
		<?php } ?>
	</div>
	<div class="scroll-right-btn"></div>
</div>
<div class="container p-b-8 p-x-6 p-s-x-1 m-t-4 shdw-b project-gallery ov-x-a">
    <div class="w-max dsp-f" id="blog-holder">
		<a href="blog/[[link]]" class="pos-r p-1 blog m-3 cl-grey-8 brr-3 bg-white karaco-sample-dom">
            <div class="dsp-f">
                <div class="f-holder-1 dsp-f f-d-col jcc p-0" style="min-height:300px">
                    <div class="blog-frame dsp-f p-2 jcc aic">
                        <h3 class="fs-xl fs-s-m">[[title]]</h3>
                        <div class="cl-grey-7 mobile container-8 txt-j blur-p">
                            <span>[[body]]</span><span class="fs-s cl-blue-5">read more</span>
                        </div>
                    </div>
                    <div class="container blur desktop dsp-f aic jcc blog-content">
                        <div class="container-8 txt-j p-2 blur-p">
                            [[body]]<span class="fs-s cl-blue-5">read more</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <?php $i = -1;while (++$i < count($blogs)) { ?>
        <a href="blog/<?php echo $blogs[$i]['link']; ?>" class="pos-r p-1 blog m-3 cl-grey-8 brr-3 bg-white">
            <div class="dsp-f">
                <div class="f-holder-1 dsp-f f-d-col jcc p-0" style="min-height:300px">
                    <div class="blog-frame dsp-f p-2 jcc aic">
                        <h3 class="fs-l fs-s-m"><?php echo $blogs[$i]['title']; ?></h3>
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
    const blogTags = document.querySelectorAll('.blog-tag');
	const btLeftScroll = document.querySelector('.blog-tag-scroll .scroll-left-btn');
	const btRightScroll = document.querySelector('.blog-tag-scroll .scroll-right-btn');
	const btScrollItem = document.querySelector('.blog-tag-scroll .blog-tag-holder');

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

	function plScroll(val) {
		btScrollItem.scrollLeft += val;
	}

	btLeftScroll.addEventListener('click', () => {
		let val = btScrollItem.getBoundingClientRect().width * 0.8;
		plScroll(-val);
	})

	btRightScroll.addEventListener('click', () => {
		let val = btScrollItem.getBoundingClientRect().width * 0.8;
		plScroll(val);
	})

	function loadBlogsByTag(obj) {
		resetTagActive();
		obj.classList.add('main-bg-5');
		obj.classList.add('cl-white');
		let id = obj.getAttribute('kc-id');
		let page = root + 'pg/cal/blog.php';
		let f = new FormData();
		f.append('f', 'loadBlogsByTag');
		f.append('id', id);

		let request = new XMLHttpRequest();

		request.open('post', page);
		request.send(f);

		request.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200) {
				let data = JSON.parse(request.responseText);
				setBlogsByTag(data);
			}
		};
	}

	function setBlogsByTag(data) {
		innerDom('blog-holder', data, 'tag', null, false, false, 220);
	}

	function resetTagActive() {
		Array.from(blogTags).forEach(bt => {
			bt.classList.remove('main-bg-5');
			bt.classList.remove('cl-white');
		})
	}
</script>