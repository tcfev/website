<div class="side-bar fs-mx side-bar-left bg-blue-7 cl-white" id="side-bar">
    <ul>
        <a href="<?php echo root.$_SESSION['lang']; ?>">
            <li class="hvr-bg-blue-6"><span class="icon icon-home"></span><label class="label">Website</label></li>
        </a>
        <a href="<?php echo root; ?>panel/landingpage">
            <li class="hvr-bg-blue-6 <?php echo $sel['landing']; ?>"><span class="icon icon-website"></span><label>Landing Page</label></li>
        </a>
        <a href="<?php echo root; ?>panel/blogs">
            <li class="hvr-bg-blue-6 <?php echo $sel['blogs']; ?>"><span class="icon icon-align-left"></span><label>Blogposts</label></li>
        </a>
        <a href="<?php echo root; ?>panel/projects">
            <li class="hvr-bg-blue-6 <?php echo $sel['projects']; ?>"><span class="icon icon-columns"></span><label>Projects</label></li>
        </a>
        <a href="<?php echo root; ?>panel/members">
            <li class="hvr-bg-blue-6 <?php echo $sel['members']; ?>"><span class="icon icon-user"></span><label>Members</label></li>
        </a>
        <a href="<?php echo root; ?>panel/preferences">
            <li class="hvr-bg-blue-6 <?php echo $sel['preferences']; ?>"><span class="icon icon-settings1"></span><label>Preferences</label></li>
        </a>
        <a kc-mode="func-btn" kc-func="logout">
            <li class="hvr-bg-blue-6"><span class="icon icon-enter"></span><label>Logout</label></li>
        </a>
    </ul>
</div>