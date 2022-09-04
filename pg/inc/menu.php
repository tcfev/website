<nav class="f-row menu">
	<div class="f-holder-4 f-l-holder-4 f-m-holder-1 dsp-f jcl jcc-m p-l-4"><a href="<?php echo root.$l; ?>/"><img class="w-30x" src="<?php echo root; ?>content/img/tcf_light.svg" alt=""></a></div>
	<div class="nowrap tile-4-3 f-s-holder-1">
	<div class="scroll-left-btn"></div>
		<div class="menu-items">
			<ul class="dsp-f aic jcb jcb-s fs-s-s w-100p">
				<li><a href="<?php echo root.$l ?>/#bottom-part"><?php echo $langs['menu'][$l]['about']; ?></a></li>
				<li><a href="<?php echo root.$l ?>/membership"><?php echo $langs['menu'][$l]['membership']; ?></a></li>
				<li><a href="<?php echo root.$l ?>/contact"><?php echo $langs['menu'][$l]['contact']; ?></a></li>
				<li><a href="<?php echo root.$l ?>/supprot-request"><?php echo $langs['menu'][$l]['forms']; ?></a></li>
				<li><a href="<?php echo root.$l ?>/blog/28"><?php echo $langs['menu'][$l]['donation']; ?></a></li>
			</ul>
		</div>
		<div class="dsp-f jcl jcc-s">
			<select name="lang" id="lang" class="p-x-2 p-y-1" onchange="changeURL.call(this);">
				<option value="en" <?php echo $langs['ind'][$l]['selected']['en'];?>>En</option>
				<option value="de" <?php echo $langs['ind'][$l]['selected']['de'];?>>De</option>
				<option value="ar" <?php echo $langs['ind'][$l]['selected']['ar'];?>>Ar</option>
				<option value="fa" <?php echo $langs['ind'][$l]['selected']['fa'];?>>Fa</option>
				<option value="ku" <?php echo $langs['ind'][$l]['selected']['ku'];?>>Ku</option>
			</select>
		</div>
		<div class="scroll-right-btn"></div>
	</div>
</nav>

<script>
	const leftScroll = document.querySelector('.nowrap .scroll-left-btn');
	const rightScroll = document.querySelector('.nowrap .scroll-right-btn');
	const scrollItem = document.querySelector('.nowrap .menu-items');

	function menuScroll(val) {
		scrollItem.scrollLeft += val;
	}

	leftScroll.addEventListener('click', () => {
		let val = scrollItem.getBoundingClientRect().width * 0.8;
		menuScroll(-val);
	})

	rightScroll.addEventListener('click', () => {
		let val = scrollItem.getBoundingClientRect().width * 0.8;
		menuScroll(val);
	})
</script>