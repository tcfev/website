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
$stmt = $con->prepare("SELECT b.ID, bd.title, bd.body FROM 
(SELECT tmp.* FROM blogs tmp INNER JOIN (SELECT blog_id FROM blog_projects WHERE project_id = ?) bp ON bp.blog_id = tmp.ID) b
INNER JOIN (SELECT * FROM blog_detail WHERE lang = ?) bd ON b.ID = bd.blog_id");
$stmt->bind_param("is", $id, $l);
$stmt->execute();
$blogs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
