<div class="container h-100v main-bg light jcb dsp-f f-d-col p-b-7">
    <?php include_once phproot.'pg/inc/menu.php' ?>
    <div class="f-row jcc">
		<div class="w-100p dsp-f" style="max-width: 2600px">
			<div class="tile-3-2 p-x-5" id="tcf_typo">
			</div>
			<div class="f-holder-3 p-0">
				<canvas id="canvas">
				</canvas>
			</div>
		</div>
    </div>
    <div class="f-row jca">
		<div class="project-link-scroll">
			<div class="scroll-left-btn"></div>
			<div class="project-link-holder">
				<?php $i = -1;while (++$i < count($projects)) {
					?>
					<a href="#p-<?php echo $projects[$i]['ID']; ?>" class="cl-white hvr-cl-black project-link"><?php echo $projects[$i]['title']; ?></a>
				<?php } ?>
			</div>
			<div class="scroll-right-btn"></div>
		</div>
    </div>
</div>

<script>
	const plLeftScroll = document.querySelector('.project-link-scroll .scroll-left-btn');
	const plRightScroll = document.querySelector('.project-link-scroll .scroll-right-btn');
	const plScrollItem = document.querySelector('.project-link-scroll .project-link-holder');

	function plScroll(val) {
		plScrollItem.scrollLeft += val;
	}

	plLeftScroll.addEventListener('click', () => {
		let val = plScrollItem.getBoundingClientRect().width * 0.8;
		plScroll(-val);
	})

	plRightScroll.addEventListener('click', () => {
		let val = plScrollItem.getBoundingClientRect().width * 0.8;
		plScroll(val);
	})
</script>