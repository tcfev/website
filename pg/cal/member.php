<?php
include_once 'cheader.cal.php';

function addMember() {
    global $con;

    $fname = 'First';
    $lname = 'Last';
    $info = 'No text yet...';
    $post = 'Member';
    $avatar = 'content/avatar/default.jpg';
    $link = '#';
    $email = 'member@tcf.org';

    if (!$sql = $con->query("INSERT INTO members(link, email, avatar) VALUES('$link', '$email', '$avatar')")) {
        $msg['msg'] = 'Error: Something went wrong - code: PMx001';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
        $id = $con->insert_id;
        for ($i = 0; $i < count(langs); $i++) {
            $lang = langs[$i];
            $f = $fname;
            $l = $lname.' - '.$lang;
            $inf = $info.' - '.$lang;
            $p = $post.' - '.$lang;
            $sql = $con->query("INSERT INTO member_detail(member_id, first_name, last_name, info, post, lang) VALUES('$id', '$f', '$l', '$inf', '$p', '$lang')");
        }
    }

    echo json_encode($msg);
}

function loadMembers() {
    global $con;
    $l = $_SESSION['lang'];
    $row = $con->query("SELECT m.ID, m.avatar, m.link, md.post, md.info, IF(m.active = 1, 'checked', 'no') AS active, 
    m.email, CONCAT(md.first_name, ' ', md.last_name) AS Name FROM
    members m INNER JOIN (SELECT * FROM member_detail WHERE lang = '$l') md ON m.ID = md.member_id ORDER BY m.ID DESC")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function memberAvatar() {
    global $con;
    $id = $_POST['i'];
    $str = getMyDate('shamsiDateTimeString');
    $file = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $path = 'content/avatar/m-'.$id.'-'.$str.'.'.$ext;
    $err = array();

    if ($size == 0) {
        array_push($err, 'No file is selected');
    }

    if (count($err) > 0) {
        $msg['res'] = 2;
        $msg['err'] = $err;
    } else {
        $upload = uploadFile($file, $tmp, $path, 'doc', $size, maxUp);

        if ($upload == 0) {
            $stmt = $con->prepare("UPDATE members SET avatar = ? WHERE ID = ?");
            $stmt->bind_param("si", $path, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PIx002';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = "Avatar updated successfully";
                $msg['res'] = 1;
            }
            
        } else {
            $msg['msg'] = $upload;
            $msg['res'] = 0;
        }
    }
    
    echo json_encode($msg);
}

function memberActive() {
    global $con;
    $act = r($_POST['act']);
    $id = r($_POST['id']);
    
    $stmt = $con->prepare("UPDATE members SET active = ? WHERE ID = ?");
    $stmt->bind_param("ii", $act, $id);

    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went wrong - code: PIx003';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
    }

    echo json_encode($msg);
}

function loadSingleMember() {
    global $con;
    $id = $_POST['i'];

    $stmt = $con->prepare("SELECT ID, member_id AS mID, first_name, last_name, info, post, lang FROM member_detail WHERE member_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function memberName() {
    global $con;
    $id = $_POST['i'];
    $fname = $_POST['n'];
    $lname = $_POST['l'];
    $err = array();

    if (mb_strlen($lname) < 2) {
        array_push($err, 'Enter members\'s lastname');
    }

    if (mb_strlen($fname) < 2) {
        array_push($err, 'Enter members\'s firstname');
    }

    if (count($err) > 0) {
        $msg['err'] = $err;
        $msg['res'] = 2;
    } else {
        $stmt = $con->prepare("UPDATE member_detail SET first_name = ?, last_name = ? WHERE ID = ?");
        $stmt->bind_param("ssi", $fname, $lname, $id);
        if (!$stmt->execute()) {
            $msg['msg'] = 'Error: Something went wrong - code: PIx004';
            $msg['res'] = 0;
        } else {
            $msg['msg'] = 'Name updated successfully';
            $msg['res'] = 1;
        }
    }

    echo json_encode($msg);
}

function memberPost() {
    global $con;
    $id = $_POST['i'];
    $post = $_POST['p'];
    $err = array();

    if (mb_strlen($post) < 2) {
        array_push($err, 'Enter members\'s Post');
    }

    if (count($err) > 0) {
        $msg['err'] = $err;
        $msg['res'] = 2;
    } else {
        $stmt = $con->prepare("UPDATE member_detail SET post = ? WHERE ID = ?");
        $stmt->bind_param("si", $post, $id);
        if (!$stmt->execute()) {
            $msg['msg'] = 'Error: Something went wrong - code: PIx004';
            $msg['res'] = 0;
        } else {
            $msg['msg'] = 'Post updated successfully';
            $msg['res'] = 1;
        }
    }

    echo json_encode($msg);
}

function memberInfo() {
    global $con;
    $id = $_POST['i'];
    $info = $_POST['inf'];
    $err = array();

    if (mb_strlen($info) < 5) {
        array_push($err, 'Descrtiption must be at least 5 characters');
    }

    if (count($err) > 0) {
        $msg['err'] = $err;
        $msg['res'] = 2;
    } else {
        $stmt = $con->prepare("UPDATE member_detail SET info = ? WHERE ID = ?");
        $stmt->bind_param("si", $info, $id);
        if (!$stmt->execute()) {
            $msg['msg'] = 'Error: Something went wrong - code: PIx004';
            $msg['res'] = 0;
        } else {
            $msg['msg'] = 'Post updated successfully';
            $msg['res'] = 1;
        }
    }

    echo json_encode($msg);
}

function loadSingleMemberLink() {
    global $con;
    $id = $_POST['i'];

    $stmt = $con->prepare("SELECT ID, link, email FROM members WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function memberLink() {
    global $con;
    $id = $_POST['i'];
    $link = $_POST['l'];

    $stmt = $con->prepare("UPDATE members SET link = ? WHERE ID = ?");
    $stmt->bind_param("si", $link, $id);

    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went wrong - code: PIx004';
        $msg['res'] = 0;
    } else {
        $msg['msg'] = 'Link updated successfully';
        $msg['res'] = 1;
    }
    
    echo json_encode($msg);
}

function memberEmail() {
    global $con;
    $id = $_POST['i'];
    $email = $_POST['e'];

    $stmt = $con->prepare("UPDATE members SET email = ? WHERE ID = ?");
    $stmt->bind_param("si", $email, $id);

    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went wrong - code: PIx004';
        $msg['res'] = 0;
    } else {
        $msg['msg'] = 'Email updated successfully';
        $msg['res'] = 1;
    }
    
    echo json_encode($msg);
}

function deleteMember() {
    global $con;
    $id = $_POST['id'];
    
    $stmt = $con->prepare("DELETE FROM members WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function loadAboutUs() {
    global $con;
    $l = $_SESSION['lang'];
    $row = $con->query("SELECT (SELECT Value FROM settings WHERE key_name = 'about_us' AND lang = '$l') AS about_us")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function loadAboutUss() {
    global $con;

    $row = $con->query("SELECT s1.Value AS about_us, s1.lang FROM
    (SELECT Value, lang FROM settings WHERE key_name = 'about_us') s1")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function aboutUsDescr() {
    global $con;
    $descr = $_POST['d'];
    $lang = $_POST['lang'];
    $err = array();    

    if (mb_strlen($descr) < 100) {
        array_push($err, 'Text must be at least 100 characters');
    }

    if (count($err) > 0) {
        $msg['err'] = $err;
        $msg['res'] = 2;
    } else {
        $stmt = $con->prepare("UPDATE settings SET Value = ? WHERE key_name = 'about_us' AND lang = ?");
        $stmt->bind_param("ss", $descr, $lang);
    
        if (!$stmt->execute()) {
            $msg['msg'] = 'Error: Something went - code: PMx002';
            $msg['res'] = 0;
        } else {
            $msg['msg'] = 'About Us text updated successfully';
            $msg['res'] = 1;
        }
    }
    
    echo json_encode($msg);
}
?>