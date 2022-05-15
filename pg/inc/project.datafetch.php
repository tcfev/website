<?php
if (!isset($_GET['p']))
    echo '<script>window.location = '.root.';</script>';
else
    $id = $_GET['p'];
$stmt = $con->prepare("SELECT p.*, pd.title, pd.body, pd.descr FROM 
(SELECT * FROM projects WHERE ID = ?) p INNER JOIN (SELECT * FROM project_detail WHERE lang = ?) pd ON p.ID = pd.project_id");
$stmt->bind_param("is", $id, $l);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();
$project['gallery'] = $con->query("SELECT pg.ID, pg.project_id AS pID, pg.photo, pgd.ID AS pgdID, pgd.title
FROM (SELECT * FROM project_gallery WHERE project_id = '$id') pg 
INNER JOIN (SELECT * FROM project_gallery_detail WHERE lang = '$l') pgd ON pg.ID = pgd.project_gallery_id ORDER BY pg.ID DESC")->fetch_all(MYSQLI_ASSOC);
if (!isset($project['ID']))
    echo '<script>window.location = '.root.';</script>';
?>
