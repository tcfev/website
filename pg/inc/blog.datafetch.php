<?php
if (!isset($_GET['b']))
    echo '<script>window.location = '.root.';</script>';
else
    $id = $_GET['b'];
$stmt = $con->prepare("SELECT b.*, bd.title, bd.body, bd.descr FROM 
(SELECT * FROM blogs WHERE ID = ?) b INNER JOIN (SELECT * FROM blog_detail WHERE lang = ?) bd ON b.ID = bd.blog_id");
$stmt->bind_param("is", $id, $l);
$stmt->execute();
$blog = $stmt->get_result()->fetch_assoc();
if (!isset($blog['ID']))
    echo '<script>window.location = '.root.';</script>';
?>
