<?php
$simple = $con->query("SELECT (SELECT Value FROM settings WHERE key_name = 'about' AND lang = '$l') AS about, 
(SELECT Value FROM settings WHERE key_name = 'title' AND lang = '$l') AS title")->fetch_assoc();

$article = $con->query("SELECT (SELECT Value FROM settings WHERE key_name = 'descr' AND lang = '$l') AS about, 
(SELECT Value FROM settings WHERE key_name = 'header' AND lang = '$l') AS title")->fetch_all(MYSQLI_ASSOC);

$stmt = $con->prepare("SELECT p.*, pd.descr, pd.body, pd.title, IF(p.active = 1, 'checked', 'no') AS active FROM projects p INNER JOIN
(SELECT * FROM project_detail WHERE lang = ?) pd ON p.ID = pd.project_id WHERE p.active = 1 ORDER BY p.ID DESC");
$stmt->bind_param("s", $l);
$stmt->execute();
$projects = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

for ($i=0; $i < count($projects); $i++) { 
    $id = $projects[$i]['ID'];
    $projects[$i]['gallery'] = $con->query("SELECT pg.ID, pg.project_id AS pID, pg.photo, pgd.ID AS pgdID, pgd.title
    FROM (SELECT * FROM project_gallery WHERE project_id = '$id') pg 
    INNER JOIN (SELECT * FROM project_gallery_detail WHERE lang = '$l') pgd ON pg.ID = pgd.project_gallery_id ORDER BY pg.ID DESC")->fetch_all(MYSQLI_ASSOC);
}

$stmt = $con->prepare("SELECT tg.ID, tgd.tag FROM tags tg INNER JOIN (SELECT * FROM tag_detail WHERE lang = ?) tgd
ON tgd.tag_id = tg.ID INNER JOIN blog_tags btg ON tg.ID = btg.tag_id ORDER BY tgd.tag ASC, tg.ID ASC");
$stmt->bind_param("s", $l);
$stmt->execute();
$blogTags = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$stmt = $con->prepare("SELECT b.*, bd.title, bd.body, bd.descr FROM 
blogs b INNER JOIN (SELECT * FROM blog_detail WHERE lang = ?) bd ON b.ID = bd.blog_id ORDER BY b.ID DESC");
$stmt->bind_param("s", $l);
$stmt->execute();
$blogs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$members = $con->query("SELECT m.ID, m.avatar, m.link, md.post, md.info, m.email, CONCAT(md.first_name, ' ', md.last_name) AS Name
	FROM members m INNER JOIN (SELECT * FROM member_detail WHERE lang = '$l') md ON m.ID = md.member_id WHERE m.active = '1' ORDER BY m.ID DESC")->fetch_all(MYSQLI_ASSOC);

$aboutInfo = $con->query("SELECT value AS about_us FROM settings WHERE key_name = 'about_us' AND lang = '$l'")->fetch_assoc();

?>