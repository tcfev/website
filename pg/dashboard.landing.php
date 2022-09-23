<?php 
    include_once 'cal/session.header.php';
    include_once 'cal/cheader.cal.php';
    include_once phproot.'pg/cal/lang.php';
    $sel = array(
        'landing' => 'selected',
        'projects' => '',
        'members' => '',
        'tags' => '',
        'blogs' => '',
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
<html lang="en" class="ov-x-h">
<head>
    <?php include_once phproot.'pg/inc/head.php'; ?>
    <title>CPanel Landing Page</title>
</head>
<body>
    <div class="container bg-light m-h-100v">
        <?php include_once phproot.'pg/inc/menu.side.php'; ?>

        <div class="container-7 m-a p-y-8" style="direction: <?php echo $langs['ind'][$lang]['dir']; ?>">
            <?php 
				include_once phproot.'pg/inc/changelang.php';
				include_once phproot.'pg/inc/landing.about.php';
			?>
            <?php include_once phproot.'pg/inc/landing.main.php'; ?>
            <!-- <?php include_once phproot.'pg/inc/landing.quotes.php'; ?> -->
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
        loadAbout(setAbout);
        loadMain(setMain);
        // loadQuotes(setQuotes);
    </script>
</body>
</html>