<div class="f-holder-2 ais dsp-f">
    <div class="f-holder-1 bg-white jca shdw-3 brr-2" id="address">
        <div class="f-holder-1">
            <img class="m-x-2 va-sub w-20x" src="<?php echo root;?>content/img/address.svg" alt="">
            <span class="fs-m">Address</span>
            <div class="over-menu-holder m-t-5">
                <p class="fs-s txt-j" id="address-holder">

                </p>
                <div class="over-menu over-row bg-white brr-1 top-right-base">
                    <span class="over-item icon-edit tp" kc-mode="func-btn" kc-func="startAddress"><span class="tt ttop bg-grey-7 cl-white">Edit</span></span>
                </div>
            </div>
        </div>

        <div class="f-holder-1">
            <img class="m-x-2 va-sub w-20x" src="<?php echo root;?>content/img/arroba.svg" alt="">
            <span class="fs-m">Email</span>
            <div class="over-menu-holder m-t-5">
                <p class="fs-s txt-j" id="email-address-holder">

                </p>
                <div class="over-menu over-row bg-white brr-1 top-right-base">
                    <span class="over-item icon-edit tp" kc-mode="func-btn" kc-func="startEmailAddress"><span class="tt ttop bg-grey-7 cl-white">Edit</span></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-7 m-a popup" id="address-dialog" kc-mode="kc-slider">
    <h4 class="cl-grey-8 m-b-4">Edit link text</h4>
    <div id="address-dialog-holder">
        <div class="karaco-sample-dom m-1" kc-mode="kc-slide" kc-ord="[[Row]]" kc-label="[[lang]]">
            <form kc-mode="form-submit" kc-func="address">
                <span>Address - [[lang]]</span></br>
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="a" placeholder="Address - [[lang]]" value="[[value]]">
                <input type="hidden" name="i" value="[[ID]]">
                <button type="submit" class="p-1 m-t-1 m-b-3">Submit</button>
            </form>
        </div>
    </div>
    <div class="txt-c f-row jcc">
        <span class="bx-btn bg-white cl-blue-6 m-1" kc-mode="kc-slider-prev"><</span>
        <span class="bx-btn cl-white bg-blue-6 m-1" kc-mode="kc-slider-label">0</span>
        <span class="bx-btn bg-white cl-blue-6 m-1" kc-mode="kc-slider-next">></span>
    </div>
</div>

<div class="container-7 m-a popup" id="email-address-dialog">
    <h4 class="cl-grey-8 m-b-4">Edit email address</h4>
    <div id="email-address-dialog-holder">
        <div class="m-1">
            <form kc-mode="form-submit" kc-func="emailAddress">
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="e" placeholder="link" value="">
                <button type="submit" class="p-1 m-t-1 m-b-3">Submit</button>
            </form>
        </div>
    </div>
</div>