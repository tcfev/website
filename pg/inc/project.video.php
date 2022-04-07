<div class="f-row aic m-t-9 m-b-5">
    <h3 class="dsp-ib">Video Gallery</h3>
    <span class="bx-btn m-x-4 bg-bright-green-6 cl-white tp" kc-mode="func-btn" kc-func="addProjectVideo" kc-id="[[ID]]">+<div class="tt ttop bg-grey-7 cl-white">Add</div></span>
</div>

<div class="f-row" kc-arr="[[$videos]]">
    <div class="f-holder-3 dsp-f ais over-menu-holder karaco-sample-dom">
        <div class="f-holder-1 p-0 brd-0 bg-bright-blue-6 brr-1 dsp-f f-d-col jcb">
            <div class="f-row">
                <div class="over-menu-holder video-container">
                    [[video]]
                    <div class="over-menu bg-white over-row top-center">
                        <span class="over-item cl-black icon-edit hvr-cl-blue-4 tp" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startProjectVideo">
                            <div class="tt ttop bg-grey-7 brr-5px cl-white">Edit</div>
                        </span>
                    </div>
                </div>
                
                <div class="f-row">
                    <div class="over-menu-holder p-2">
                        <span class="dsp-ib fs-m cl-white">[[title]]</span>
                        <div class="over-menu bg-white over-row top-right">
                            <span class="over-item cl-black icon-edit hvr-cl-blue-4 tp" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startProjectVideoTitle">
                                <div class="tt ttop bg-grey-7 brr-5px cl-white">Edit</div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="over-menu bg-red-2 over-row top-right">
            <span class="over-item cl-white hvr-cl-blue-4 tp" kc-mode="func-btn" kc-id="[[ID]]" kc-func="deleteProjectVideoDialog">
                X
                <div class="tt ttop bg-grey-7 brr-5px cl-white">Delete</div>
            </span>
        </div>
    </div>
</div>