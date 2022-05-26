<?php
    include_once 'cal/session.header.php';
    include_once 'cal/cheader.cal.php';
    include_once phproot.'pg/cal/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $l; ?>" <?php if (!isset($_COOKIE['is_seen']) || $_COOKIE['is_seen'] != "true") {?>style="overflow: hidden"<?php } ?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCF</title>
    <?php include_once phproot.'pg/inc/head.php'; ?>
</head>
<body>
    <canvas id="canvas">

    </canvas>
    <script src="<?php echo root; ?>js/var.js"></script>
    <script src="<?php echo root; ?>js/app.js"></script>
    <script src="<?php echo root; ?>js/kc.normal.js"></script>
    <script src="<?php echo root; ?>js/kc.observer.js"></script>
    <script src="<?php echo root; ?>js/scroll.vertical.js"></script>
    <script src="<?php echo root; ?>js/side.anim.js"></script>
</body>
</html>