<div class="f-row aic m-t-9 m-b-5">
    <h2 class="dsp-ib">Members</h2>
    <span class="bx-btn m-x-4 bg-yellow-4 cl-white tp" kc-mode="func-btn" kc-func="addMember">+<div class="tt ttop bg-grey-7 cl-white">Add</div></span>
</div>

<div class="f-row" id="members">
    <div class="f-holder-3 dsp-f ais over-menu-holder karaco-sample-dom">
        <div class="f-holder-1 bg-white brr-2 shdw-3">
            <div class="m-b-4">
                <label class="switch small">
                    <input type="checkbox" name="act" [[active]] kc-mode="func-btn" kc-func="memberActive" kc-id="[[ID]]">
                    <span class="slider round"></span>
                </label>
            </div>

            <div class="over-menu-holder">
                <img src="<?php echo root; ?>[[avatar]]" alt="" class="w-100p h-a brr-1">
                <div class="over-menu bg-white shdw-3 middle">
                    <span class="icon-edit cl-black over-item tp hvr-cl-blue-4" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startMemberAvatar">
                        <div class="tt bg-grey-7 ttop brr-5x cl-white">Edit</div>
                    </span>
                </div>
            </div>

            <div class="over-menu-holder">
                <span class="fs-xm">[[Name]]</span>
                <div class="over-menu bg-white shdw-3 over-row top-right">
                    <span class="icon-edit cl-black over-item tp hvr-cl-blue-4" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startMemberName">
                        <div class="tt bg-grey-7 ttop brr-5x cl-white">Edit</div>
                    </span>
                </div>
            </div>

            <div class="over-menu-holder m-t-n3">
                <span class="fs-s txt-j cl-red-5">[[post]]</span>
                <div class="over-menu bg-white shdw-3 over-row top-right">
                    <span class="icon-edit cl-black over-item tp hvr-cl-blue-4" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startMemberPost">
                        <div class="tt bg-grey-7 ttop brr-5x cl-white">Edit</div>
                    </span>
                </div>
            </div>

            <div class="over-menu-holder">
                <p class="fs-s txt-j cl-grey-7">[[info]]</p>
                <div class="over-menu bg-white shdw-3 over-row top-right">
                    <span class="icon-edit cl-black over-item tp hvr-cl-blue-4" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startMemberInfo">
                        <div class="tt bg-grey-7 ttop brr-5x cl-white">Edit</div>
                    </span>
                </div>
            </div>
            
            <div class="over-menu-holder m-t-4">
                <a class="fs-m" href="[[link]]">External link</a>
                <div class="over-menu bg-white shdw-3 over-row top-right">
                    <span class="icon-edit cl-black over-item tp hvr-cl-blue-4" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startMemberLink">
                        <div class="tt bg-grey-7 ttop brr-5x cl-white">Edit</div>
                    </span>
                </div>
            </div>
        </div>
        <div class="over-menu bg-red-2 over-row top-right">
            <span class="over-item cl-white hvr-cl-blue-4 tp" kc-mode="func-btn" kc-id="[[ID]]" kc-func="deleteMemberDialog">
                X
                <div class="tt ttop bg-grey-7 brr-5px cl-white">Delete</div>
            </span>
        </div>
    </div>
</div>
