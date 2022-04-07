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

<div class="container-7 m-a popup" id="member-avatar-dialog">
    <form kc-mode="form-submit" kc-func="submitMemberAvatar">
        <h4 class="cl-grey-8 m-b-4">Image file - 1:1</h4>
        <div class="fake-input rounded">
            <div class="fake">
                <input type="text" class="label" placeholder="choose a file...">
                <button type="button" class="bg-green-3 hvr-bg-green-2 cl-white">Browse</button>
                <input type="file" class="fake-file" name="file">
            </div>
        </div>
        <input type="hidden" name="i" value="">
        <button type="submit" class="p-1 m-t-5">Upload</button>
    </form>
</div>

<div class="container-7 m-a popup" id="member-name-dialog" kc-mode="kc-slider">
    <h4 class="cl-grey-8 m-b-4">Edit member name</h4>
    <div id="member-name-dialog-holder">
        <div class="karaco-sample-dom m-1" kc-mode="kc-slide" kc-ord="[[Row]]" kc-label="[[lang]]">
            <form kc-mode="form-submit" kc-func="memberName">
                <span>Name - [[lang]]</span></br>
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="n" placeholder="Firstname - [[lang]]" value="[[first_name]]">
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="l" placeholder="Lastname - [[lang]]" value="[[last_name]]">
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

<div class="container-7 m-a popup" id="member-link-dialog">
    <h4 class="cl-grey-8 m-b-4">Edit link</h4>
    <div id="member-link-dialog-holder">
        <div class="karaco-sample-dom m-1">
            <form kc-mode="form-submit" kc-func="memberLink">
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="l" placeholder="link" value="[[link]]">
                <input type="hidden" name="i" value="[[ID]]">
                <button type="submit" class="p-1 m-t-1 m-b-3">Submit</button>
            </form>
        </div>
    </div>
</div>

<div class="container-7 m-a popup" id="member-email-dialog">
    <h4 class="cl-grey-8 m-b-4">Edit email</h4>
    <div id="member-email-dialog-holder">
        <div class="karaco-sample-dom m-1">
            <form kc-mode="form-submit" kc-func="memberEmail">
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="e" placeholder="email" value="[[email]]">
                <input type="hidden" name="i" value="[[ID]]">
                <button type="submit" class="p-1 m-t-1 m-b-3">Submit</button>
            </form>
        </div>
    </div>
</div>

<div class="container-7 m-a popup" id="member-post-dialog" kc-mode="kc-slider">
    <h4 class="cl-grey-8 m-b-4">Edit member post</h4>
    <div id="member-post-dialog-holder">
        <div class="karaco-sample-dom m-1" kc-mode="kc-slide" kc-ord="[[Row]]" kc-label="[[lang]]">
            <form kc-mode="form-submit" kc-func="memberPost">
                <span>Post - [[lang]]</span></br>
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="p" placeholder="Post - [[lang]]" value="[[post]]">
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

<div class="container-7 m-a popup" id="member-info-dialog" kc-mode="kc-slider">
    <h4 class="cl-grey-8 m-b-4">Edit member info</h4>
    <div id="member-info-dialog-holder">
        <div class="karaco-sample-dom m-1" kc-mode="kc-slide" kc-ord="[[Row]]" kc-label="[[lang]]">
            <form kc-mode="form-submit" kc-func="memberInfo">
                <span>Info - [[lang]]</span></br>
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="inf" placeholder="Info - [[lang]]" value="[[info]]">
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