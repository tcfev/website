<?php
    include_once 'cal/session.header.php';
    include_once 'cal/cheader.cal.php';
    include_once phproot.'pg/cal/lang.php';
    $sel = array(
        'landing' => '',
        'projects' => '',
        'members' => 'selected',
        'blogs' => '',
        'tags' => '',
        'preferences' => ''
    );
    
    if (!isset($_SESSION['u_upost'])) {
        echo '<script>window.location = "'.root.'login"</script>';
        die();
    } else {
        if ($_SESSION['u_upost'] != 'admn') {
            echo '<script>window.location = "'.root.'login"</script>';
            die();
        } else {
            if (!isset($_SESSION['lang'])) {
                $_SESSION['lang'] = 'en';
            }
            $lang = $_SESSION['lang'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once phproot.'pg/inc/head.php'; ?>
    <title>CPanel Investors</title>
</head>
<body>
    <div class="bg-light container m-h-100v">
        <?php include_once phproot.'pg/inc/menu.side.php'; ?>

        <div class="container-7 m-x-a p-y-8" style="direction: <?php echo $langs['ind'][$lang]['dir']; ?>">
            
            <?php
            include_once phproot.'pg/inc/changelang.php';
            include_once phproot.'pg/inc/members.info.php'; 
            include_once phproot.'pg/inc/members.user.php'; 
            include_once phproot.'pg/inc/members.user.edit.php'; 
            ?>
        </div>
    </div>

    <script src="<?php echo root; ?>js/var.js?v=<?php echo ver; ?>"></script>
    <script src="<?php echo root; ?>js/kc.normal.js?v=<?php echo ver; ?>"></script>
    <script src="<?php echo root; ?>js/app.js?v=<?php echo ver; ?>"></script>
    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <script>
        loadMembers(setMembers);
        loadAboutUs(setAboutUs);
    </script>
</body>
</html>