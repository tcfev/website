<?php

include_once 'cheader.cal.php';

function loadProjects() {
    global $con;
    $l = $_SESSION['lang'];

    $stmt = $con->prepare("SELECT p.*, pd.descr, pd.body, pd.title, IF(p.active = 1, 'checked', 'no') AS active FROM projects p INNER JOIN
    (SELECT * FROM project_detail WHERE lang = ?) pd ON p.ID = pd.project_id");
    $stmt->bind_param("s", $l);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    for ($i=0; $i < count($row); $i++) { 
        $id = $row[$i]['ID'];
        $row[$i]['gallery'] = $con->query("SELECT pg.ID, pg.project_id AS pID, pg.photo, pgd.ID AS pgdID, pgd.title
        FROM (SELECT * FROM project_gallery WHERE project_id = '$id') pg 
        INNER JOIN (SELECT * FROM project_gallery_detail WHERE lang = '$l') pgd ON pg.ID = pgd.project_gallery_id")->fetch_all(MYSQLI_ASSOC);

        $row[$i]['videos'] = $con->query("SELECT pv.ID, pv.project_id AS pID, pvd.video, pvd.ID AS pvdID, pvd.title
        FROM (SELECT * FROM project_video WHERE project_id = '$id') pv 
        INNER JOIN (SELECT * FROM project_video_detail WHERE lang = '$l') pvd ON pv.ID = pvd.project_video_id")->fetch_all(MYSQLI_ASSOC);
    }

    echo json_encode($row);
}

function addProject() {
    global $con;
    $title = 'Title';
    $text = 'Description';
    $seo = 'SEO Description';

    if (!$sql = $con->query("INSERT INTO projects(views) VALUES('0')")) {
        $msg['msg'] = 'Error: Something went - code: PPx001';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
        $id = $con->insert_id;
        for ($i = 0; $i < count(langs); $i++) {
            $lang = langs[$i];
            $b = $text.' - '.$lang;
            $t = $title.' - '.$lang;
            $s = $seo.' - '.$lang;
            $sql = $con->query("INSERT INTO project_detail(project_id, descr, title, body, lang) VALUES('$id', '$s', '$t', '$b', '$lang')");
        }
    }

    echo json_encode($msg);
}

function loadSingleProject() {
    global $con;
    $id = $_POST['i'];

    $row = $con->query("SELECT pd.ID, '$id' AS uID, pd.title, pd.descr, pd.body, pd.lang FROM  project_detail pd WHERE pd.project_id = '$id'")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function projectActive() {
    global $con;
    $act = r($_POST['act']);
    $id = r($_POST['id']);
    
    $stmt = $con->prepare("UPDATE projects SET active = ? WHERE ID = ?");
    $stmt->bind_param("ii", $act, $id);

    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went wrong - code: PPx006';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
    }

    echo json_encode($msg);
}

function projectTitle() {
    global $con;
    $title = r($_POST['t']);
    $id = $_POST['i'];
    $err = array();

    if (empty($id)) {
        $msg['res'] = 0;
        $msg['msg'] = 'Error: Unidentified request - code: PPx008';
    } else {
        if (mb_strlen($title) < 1) {
            array_push($err, 'Title is too short');
        }

        if (count($err) > 0) {
            $msg['err'] = $err;
            $msg['res'] = 2;
        } else {
            $stmt = $con->prepare("UPDATE project_detail SET title = ? WHERE ID = ?");
            $stmt->bind_param('si', $title, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PPx009';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Title updated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function projectDescr() {
    global $con;
    $text = $_POST['d'];
    $id = $_POST['i'];
    $err = array();

    if (empty($id)) {
        $msg['res'] = 0;
        $msg['msg'] = 'Error: Unidentified request - code: PPx010';
    } else {
        if (mb_strlen($text) < 10) {
            array_push($err, 'Text is too short');
        }

        if (count($err) > 0) {
            $msg['err'] = $err;
            $msg['res'] = 2;
        } else {
            $stmt = $con->prepare("UPDATE project_detail SET body = ? WHERE ID = ?");
            $stmt->bind_param('si', $text, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PPx011';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Text updated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function projectExp() {
    global $con;
    $text = $_POST['e'];
    $id = $_POST['i'];
    $err = array();

    if (empty($id)) {
        $msg['res'] = 0;
        $msg['msg'] = 'Error: Unidentified request - code: PPx061';
    } else {
        if (mb_strlen($text) < 10) {
            array_push($err, 'Text is too short');
        }

        if (count($err) > 0) {
            $msg['err'] = $err;
            $msg['res'] = 2;
        } else {
            $stmt = $con->prepare("UPDATE project_detail SET descr = ? WHERE ID = ?");
            $stmt->bind_param('si', $text, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PPx062';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Explanation updated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function deleteProject() {
    global $con;

    $id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM projects WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function addProjectImage() {
    global $con;
    $id = $_POST['id'];
    $title = 'Project Photo Title';
    $photo = 'content/projects/temp.jpg';

    if (!$sql = $con->query("INSERT INTO project_gallery(project_id, photo) VALUES('$id', '$photo')")) {
        $msg['msg'] = 'Error: Something went - code: PPx002';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
        $id = $con->insert_id;
        for ($i = 0; $i < count(langs); $i++) {
            $lang = langs[$i];
            $t = $title.' - '.$lang;
            $sql = $con->query("INSERT INTO project_gallery_detail(project_gallery_id, title, lang) VALUES('$id', '$t', '$lang')");
        }
    }

    echo json_encode($msg);
}

function projectImage() {
    global $con;
    $id = $_POST['i'];
    $str = getMyDate('shamsiDateTimeString');
    $file = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $path = 'content/projects/gallery/p-image-'.$id.'-'.$str.'.'.$ext;
    $err = array();

    if ($size == 0) {
        array_push($err, 'No file is selected');
    }

    if (count($err) > 0) {
        $msg['res'] = 2;
        $msg['err'] = $err;
    } else {
        $upload = uploadImageCrop($file, $tmp, $path, $size, maxUp, 0, 1000);
        if ($upload == 0) {
            $stmt = $con->prepare("UPDATE project_gallery set photo = ? WHERE ID = ?");
            $stmt->bind_param("si", $path, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = "Error: Something went wrong - code: PPx022";
                $msg['res'] = 0;
                unlink(phproot.$path);
            } else {
                $msg['msg'] = "Image Uploaded Successfully";
                $msg['res'] = 1;
            }
        } else {
            $msg['msg'] = $upload;
            $msg['res'] = 0;
        }
    }

    echo json_encode($msg);
}

function loadSingleProjectImage() {
    global $con;

    $id = $_POST['i'];

    $stmt = $con->prepare("SELECT ID, project_gallery_id AS pgID, title, lang FROM project_gallery_detail WHERE project_gallery_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function projectImageTitle() {
    global $con;
    $title = r($_POST['t']);
    $id = $_POST['i'];
    $err = array();

    if (empty($id)) {
        $msg['res'] = 0;
        $msg['msg'] = 'Error: Unidentified request - code: PPx023';
    } else {
        if (mb_strlen($title) < 1) {
            array_push($err, 'Title is too short');
        }

        if (count($err) > 0) {
            $msg['err'] = $err;
            $msg['res'] = 2;
        } else {
            $stmt = $con->prepare("UPDATE project_gallery_detail SET title = ? WHERE ID = ?");
            $stmt->bind_param('si', $title, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PPx024';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Title updated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function deleteProjectImage() {
    global $con;

    $id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM project_gallery WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function addProjectVideo() {
    global $con;
    $id = $_POST['id'];
    $video = '<iframe width="560" height="315" src="https://www.youtube.com/embed/1tj7Y3PR16s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    $title = 'Video Title';
    $views = 0;
    
    $stmt = $con->prepare("INSERT INTO project_video(project_id, views) VALUES(?,?)");
    $stmt->bind_param("ii", $id, $views);
    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went - code: PPx054';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
        $id = $stmt->insert_id;
        for ($i = 0; $i < count(langs); $i++) {
            $lang = langs[$i];
            $t = $title.' - '.$lang;
            $sql = $con->query("INSERT INTO project_video_detail(project_video_id, video, title, lang) VALUES('$id', '$video', '$t', '$lang')");
        }
    }
    
    echo json_encode($msg);
    
}

function loadSingleProjectVideo() {
    global $con;
    $id = $_POST['i'];

    $stmt = $con->prepare("SELECT ID, project_video_id AS pvID, title, video, lang FROM project_video_detail WHERE project_video_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function projectVideo() {
    global $con;
    $video = $_POST['v'];
    $id = $_POST['i'];
    $err = array();

    if (empty($id)) {
        $msg['res'] = 0;
        $msg['msg'] = 'Error: Unidentified request - code: PPx055';
    } else {
        if (empty($video)) {
            array_push($err, 'Embed code is empty');
        }

        if (count($err) > 0) {
            $msg['err'] = $err;
            $msg['res'] = 2;
        } else {
            $stmt = $con->prepare("UPDATE project_video_detail SET video = ? WHERE ID = ?");
            $stmt->bind_param('si', $video, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PPx056';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Video updated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function projectVideoTitle() {
    global $con;
    $title = r($_POST['t']);
    $id = $_POST['i'];
    $err = array();

    if (empty($id)) {
        $msg['res'] = 0;
        $msg['msg'] = 'Error: Unidentified request - code: PPx057';
    } else {
        if (mb_strlen($title) < 1) {
            array_push($err, 'Title is too short');
        }

        if (count($err) > 0) {
            $msg['err'] = $err;
            $msg['res'] = 2;
        } else {
            $stmt = $con->prepare("UPDATE project_video_detail SET title = ? WHERE ID = ?");
            $stmt->bind_param('si', $title, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PPx058';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Title updated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function deleteProjectVideo() {
    global $con;

    $id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM project_video WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}