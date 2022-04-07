<?php
$l = $_SESSION['lang'];

$article = $con->query("SELECT (SELECT Value FROM settings WHERE key_name = 'about' AND lang = '$l') AS about, 
(SELECT Value FROM settings WHERE key_name = 'title' AND lang = '$l') AS title")->fetch_all(MYSQLI_ASSOC);

$stmt = $con->prepare("SELECT p.*, pd.descr, pd.body, pd.title, IF(p.active = 1, 'checked', 'no') AS active FROM projects p INNER JOIN
(SELECT * FROM project_detail WHERE lang = ?) pd ON p.ID = pd.project_id ORDER BY p.ID DESC");
$stmt->bind_param("s", $l);
$stmt->execute();
$projects = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

for ($i=0; $i < count($projects); $i++) { 
    $id = $projects[$i]['ID'];
    $projects[$i]['gallery'] = $con->query("SELECT pg.ID, pg.project_id AS pID, pg.photo, pgd.ID AS pgdID, pgd.title
    FROM (SELECT * FROM project_gallery WHERE project_id = '$id') pg 
    INNER JOIN (SELECT * FROM project_gallery_detail WHERE lang = '$l') pgd ON pg.ID = pgd.project_gallery_id ORDER BY pg.ID DESC")->fetch_all(MYSQLI_ASSOC);
}

$members = $con->query("SELECT m.ID, m.avatar, m.link, md.post, md.info, IF(m.active = 1, 'checked', 'no') AS active, 
    m.email, CONCAT(md.first_name, ' ', md.last_name) AS Name FROM
    members m INNER JOIN (SELECT * FROM member_detail WHERE lang = '$l') md ON m.ID = md.member_id ORDER BY m.ID DESC")->fetch_all(MYSQLI_ASSOC);


?>