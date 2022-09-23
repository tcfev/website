<?php 
    include_once 'cal/session.header.php';
    include_once 'cal/cheader.cal.php';
    include_once phproot.'pg/cal/lang.php';
    $sel = array(
        'landing' => '',
        'projects' => '',
        'investors' => '',
        'blogs' => '',
        'tags' => '',
        'members' => '',
        'preferences' => 'selected'
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
    <title>CPanel Preferences</title>
</head>
<body>
    <div class="bg-light container m-h-100v">
        <?php include_once phproot.'pg/inc/menu.side.php'; ?>

        <div class="container-7 m-a p-y-8" style="direction: <?php echo $langs['ind'][$lang]['dir']; ?>">
			<?php include_once phproot.'pg/inc/changelang.php'; ?>
            <div class="f-row m-t-9">
                <?php include_once phproot.'pg/inc/settings.links.php'; ?>
                <!-- <?php include_once phproot.'pg/inc/settings.social.php'; ?> -->
                <?php include_once phproot.'pg/inc/settings.pass.php'; ?>
                <!-- <?php include_once phproot.'pg/inc/settings.emails.php'; ?> -->
            </div>
            <div class="f-row">
                <?php include_once phproot.'pg/inc/settings.address.php'; ?>
                <?php include_once phproot.'pg/inc/settings.phone.php'; ?>
            </div>
            <div class="f-row">
            <!-- <?php include_once phproot.'pg/inc/settings.comments.php'; ?> -->
            </div>
            
        </div>
    </div>

    <script src="<?php echo root; ?>js/var.js?v=<?php echo ver; ?>"></script>
    <script src="<?php echo root; ?>js/kc.normal.js?v=<?php echo ver; ?>"></script>
    <script src="<?php echo root; ?>js/app.js?v=<?php echo ver; ?>"></script>

    <script>
        loadLinks(setLinks);
        loadAddress(setAddress);
        loadEmailAddress(setEmailAddress);
        loadPhones(setPhones);
    </script>
</body>
</html>