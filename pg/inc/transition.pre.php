<?php if (isset($_COOKIE["trans_color"])) { $cl = $_COOKIE["trans_color"]; ?>
<div class="transition-pre">
    <div class="transition-slide" id="tr-1" style="background-color:<?php echo $cl; ?>"></div>
    <div class="transition-slide dsp-f aic jcc" id="tr-2" style="background-color:<?php echo $cl; ?>">
        <img src="<?php echo root;?>content/img/tcf_brd.svg" class="w-50x" alt="">
    </div>
    <div class="transition-slide" id="tr-3" style="background-color:<?php echo $cl; ?>"></div>
</div>
<?php } ?>