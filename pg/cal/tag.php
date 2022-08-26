<?php
include_once 'cheader.cal.php';

function loadTags() {
	global $con;
    $l = $_SESSION['lang'];

	$row = $con->query("SELECT tg.ID, tgd.ID AS tgID, tgd.tag FROM tags tg INNER JOIN 
	(SELECT * FROM tag_detail WHERE lang = '$l') tgd ON tgd.tag_id = tg.ID
	ORDER BY tgd.tag ASC")->fetch_all((MYSQLI_ASSOC));

	echo json_encode($row);
}

function loadSingleTag() {
	global $con;
	$id = $_POST['id'];

	$stmt = $con->prepare("SELECT * FROM tag_detail WHERE tag_id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

	echo json_encode($row);
}

function addTag() {
    global $con;

    $tag = 'Tab label text';

    if (!$con->query("INSERT INTO tags(Checked) VALUES('0')")) {
        $msg['msg'] = 'Error: Something went wrong - code: PTx001';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
        $id = $con->insert_id;
        for ($i = 0; $i < count(langs); $i++) {
            $lang = langs[$i];
            $con->query("INSERT INTO tag_detail(tag_id, tag, lang) VALUES('$id', '$tag', '$lang')");
        }
    }

    echo json_encode($msg);
}

function tagLabel() {
	global $con;
	$tag = $_POST['n'];
	$id = $_POST['i'];
	$err = array();

	if (mb_strlen($tag) < 2) {
		array_push($err, 'Tag label shoud be at least 2 characters long');
	}
	if (count($err) > 0) {
		$msg['res'] = 2;
		$msg['err'] = $err;
	} else {
		$stmt = $con->prepare("UPDATE tag_detail SET tag = ? WHERE ID = ?");
		$stmt->bind_param("si", $tag, $id);
		if (!$stmt->execute()) {
			$msg['res'] = 0;
			$msg['msg'] = 'Error: Something went wrong - code: PTx002';
		} else {
			$msg['msg'] = 'Tag label updated successfully';
			$msg['res'] = 1;
		}
	}
	
	echo json_encode($msg);
}

function deleteTag() {
	global $con;
	$id = $_POST['i'];

	$stmt = $con->prepare("DELETE FROM tags WHERE ID = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
}
?>