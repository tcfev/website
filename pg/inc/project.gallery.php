<div class="f-row aic m-t-9 m-b-5">
    <h3 class="dsp-ib">Photo Gallery</h3>
    <span class="bx-btn m-x-4 bg-bright-green-6 cl-white tp" kc-mode="func-btn" kc-func="addProjectImage" kc-id="[[ID]]">+<div class="tt ttop bg-grey-7 cl-white">Add</div></span>
</div>

<div class="f-row" kc-arr="[[$gallery]]">
    <div class="f-holder-3 dsp-f ais over-menu-holder karaco-sample-dom">
        <div class="f-holder-1 p-0 bg-yellow-3 brr-1 dsp-f f-d-col jcb">
            <div class="f-row">
                <div class="over-menu-holder">
                    <img class="w-100p brr-1" src="<?php echo root; ?>[[photo]]" alt="">
                    <div class="over-menu bg-white over-row middle">
                        <span class="over-item cl-black icon-edit hvr-cl-blue-4 tp" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startProjectImage">
                            <div class="tt ttop bg-grey-7 brr-5px cl-white">Edit</div>
                        </span>
                    </div>
                </div>
                

                <div class="over-menu-holder p-2">
                    <span class="dsp-ib fs-m">[[title]]</span>
                    <div class="over-menu bg-white over-row top-right">
                        <span class="over-item cl-black icon-edit hvr-cl-blue-4 tp" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startProjectImageTitle">
                            <div class="tt ttop bg-grey-7 brr-5px cl-white">Edit</div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="over-menu bg-red-2 over-row top-right">
            <span class="over-item cl-white hvr-cl-blue-4 tp" kc-mode="func-btn" kc-id="[[ID]]" kc-func="deleteProjectImageDialog">
                X
                <div class="tt ttop bg-grey-7 brr-5px cl-white">Delete</div>
            </span>
        </div>
    </div>
</div>