<?php
if (!isset($_GET['b']))
    echo '<script>window.location = '.root.';</script>';
else
    $id = $_GET['b'];
$stmt = $con->prepare("SELECT b.*, bd.title, bd.body, bd.descr FROM 
(SELECT * FROM blogs WHERE link = ?) b INNER JOIN (SELECT * FROM blog_detail WHERE lang = ?) bd ON b.ID = bd.blog_id");
$stmt->bind_param("is", $id, $l);
$stmt->execute();
$blog = $stmt->get_result()->fetch_assoc();
$blog['gallery'] = $con->query("SELECT bg.ID, bg.blog_id AS pID, bg.photo, bgd.ID AS bgdID, bgd.title
FROM (SELECT * FROM blog_gallery WHERE blog_id = '$id') bg 
INNER JOIN (SELECT * FROM blog_gallery_detail WHERE lang = '$l') bgd ON bg.ID = bgd.blog_gallery_id ORDER BY bg.ID DESC")->fetch_all(MYSQLI_ASSOC);
if (!isset($blog['ID']))
    echo '<script>window.location = '.root.';</script>';
?>
