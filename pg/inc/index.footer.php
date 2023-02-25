<?php
	$phones = $con->query("SELECT value FROM settings WHERE key_name = 'phone'")->fetch_array(MYSQLI_ASSOC);
?>
<hr style="border-top:1px solid #52b69a" class="container-6 m-w-90p">
<div class="container">
    <div class="container-6 m-x-a p-y-7">
        <div class="f-row">
            <div class="f-holder-2 dsp-f f-d-col fs-s">
                <span class="m-b-4">Transnational Community Federation e.V. - VR 725308</span>
                <span class="m-b-4">
					<a class="cl-bright-blue-3 m-b-5" href="<?php echo root.$l?>/blog/64">Privacy Policy</a></br>
                    <a class="cl-bright-blue-3 m-b-5" href="mailto:hello@transcf.org">e-mail us</a>
                </span>
				<span>
					<?php echo join(" - ", $phones); ?>
				</span>
            </div>
            <div class="f-holder-2 dsp-f jcr jcc-s aic">
                <img src="<?php echo root; ?>content/img/tcf_light.svg" class="w-100p" style="max-width:50px" alt="">
            </div>
        </div>
    </div>
</div>