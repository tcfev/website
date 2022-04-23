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
if (!isset($project['ID']))
    echo '<script>window.location = '.root.';</script>';
?>
