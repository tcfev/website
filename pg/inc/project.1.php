<div class="f-row aic m-t-9 m-b-5">
    <h2 class="dsp-ib">Projects</h2>
    <span class="bx-btn m-x-4 bg-yellow-4 cl-white tp" kc-mode="func-btn" kc-func="addProject">+<div class="tt ttop bg-grey-7 cl-white">Add</div></span>
</div>

<div class="f-row jca" id="projects">
    <div class="f-holder-1 dsp-f ais over-menu-holder karaco-sample-dom">
        <div class="f-holder-1 bg-white shdw-3 brr-2 resizable [[class]]">
            <div class="m-b-4">
                <label class="switch big">
                    <input type="checkbox" name="act" [[active]] kc-mode="func-btn" kc-func="projectActive" kc-id="[[ID]]">
                    <span class="slider round"></span>
                </label>
                <span class="dsp-ib fs-m m-x-3" style="vertical-align: middle;">[[title]]</span>
            </div>

            <?php include_once 'project.main.php'; ?>
            <?php include_once 'project.gallery.php'; ?>
            <?php include_once 'project.video.php'; ?>
        </div>

        <div class="over-menu bg-red-2 over-row top-right">
            <span class="over-item cl-white hvr-cl-blue-4 tp" kc-mode="func-btn" kc-id="[[fakeID]]" kc-indx="[[Index]]" kc-func="minimizeProject">
                <strong>--</strong>
                <div class="tt ttop bg-grey-7 brr-5px cl-white">Minimize</div>
            </span>
            <span class="over-item cl-white hvr-cl-blue-4 tp" kc-mode="func-btn" kc-id="[[ID]]" kc-func="deleteProjectDialog">
                X
                <div class="tt ttop bg-grey-7 brr-5px cl-white">Delete</div>
            </span>
        </div>
    </div>
</div>

<?php include_once 'project.main.edit.php'; ?>
<?php include_once 'project.gallery.edit.php'; ?>
<?php include_once 'project.video.edit.php'; ?>
