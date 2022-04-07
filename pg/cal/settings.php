<?php
include_once 'cheader.cal.php';

function addLink() {
    global $con;

    $title = 'link address text';
    $link = '#';

    if (!$sql = $con->query("INSERT INTO links(link) VALUES('$link')")) {
        $msg['msg'] = 'Error: Something went wrong - code: PSx001';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
        $id = $con->insert_id;
        for ($i = 0; $i < count(langs); $i++) {
            $lang = langs[$i];
            $sql = $con->query("INSERT INTO link_detail(link_id, title, lang) VALUES('$id', '$title', '$lang')");
        }
    }

    echo json_encode($msg);
}

function loadLinks() {
    global $con;
    $l = $_SESSION['lang'];
    $row = $con->query("SELECT l.*, ld.Title FROM links l INNER JOIN (SELECT * FROM link_detail WHERE lang = '$l') ld ON ld.link_id = l.ID")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function loadSingleLink() {
    global $con;
    $id = $_POST['id'];

    $stmt = $con->prepare("SELECT ID, title, lang FROM link_detail WHERE link_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function loadSingleLinkAddress() {
    global $con;
    $id = $_POST['id'];

    $stmt = $con->prepare("SELECT ID, link FROM links WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function linkAddress() {
    global $con;

    $link = $_POST['l'];
    $id = $_POST['i'];

    if (empty($link)) {
        $link = '#';
    }

    $stmt = $con->prepare("UPDATE links SET link = ? WHERE ID = ?");
    $stmt->bind_param("si", $link, $id);

    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went wrong - code: PSx002';
        $msg['res'] = 0;
    } else {
        $msg['msg'] = 'Link updated successfully';
        $msg['res'] = 1;
    }

    echo json_encode($msg);   
}

function linkTitle() {
    global $con;

    $title = $_POST['t'];
    $id = $_POST['i'];
    $err = array();

    if (empty($title)) {
        array_push($err, 'Title is empty');
    }

    if (count($err) > 0) {
        $msg['err'] = $err;
        $msg['res'] = 2;
    } else {
        $stmt = $con->prepare("UPDATE link_detail SET title = ? WHERE ID = ?");
        $stmt->bind_param("si", $title, $id);

        if (!$stmt->execute()) {
            $msg['msg'] = 'Error: Something went wrong - code: PSx003';
            $msg['res'] = 0;
        } else {
            $msg['msg'] = 'Link updated successfully';
            $msg['res'] = 1;
        }
    }    

    echo json_encode($msg);   
}

function deleteFooterLink() {
    global $con;

    $id = $_POST['id'];

    $stmt = $con->prepare("DELETE FROM links WHERE ID = ?");
    $stmt->bind_param("i", $id);
    
    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went wrong - code: PSx004';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
    }
    
    echo json_encode($msg);
}

function loadSingleSocial() {
    global $con;
    $soc = $_POST['soc'];

    $stmt = $con->prepare("SELECT ID, Value FROM settings WHERE KeyName = ?");
    $stmt->bind_param("s", $soc);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    echo json_encode($row);
}

function socialLink() {
    global $con;
    $id = $_POST['i'];
    $link = $_POST['l'];
    
    $stmt = $con->prepare("UPDATE settings SET Value = ? WHERE ID = ?");
    $stmt->bind_param("si", $link, $id);

    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went wrong - code: PSx005';
        $msg['res'] = 0;
    } else {
        $msg['msg'] = 'Link updated successfully';
        $msg['res'] = 1;
    }
    
    echo json_encode($msg);
}

function loadEmails() {
    global $con;

    $stmt = $con->prepare("SELECT * FROM newsletter ORDER BY Date DESC");
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function loadComments() {
    global $con;

    $stmt = $con->prepare("SELECT * FROM comments ORDER BY Date DESC");
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function changePass(){
    global $con, $uid;
    $curPass = $_POST['cur-pwd'];
    $newPass = $_POST['new-pwd'];
    $renewPass = $_POST['renew-pwd'];

    $row = $con->query("SELECT pwd FROM users WHERE member_id = '$uid'")->fetch_assoc();
    if (!$result = password_verify($curPass, $row['pwd'])) {
        $msg['msg'] = "Your current password is wrong";
        $msg['res'] = 0;
    } else {
        if (mb_strlen($newPass) < 8) {
            $msg['msg'] = "Password must be at least 8 characters";
            $msg['res'] = 0;
        } else {
            if ($newPass != $renewPass) {
                $msg['msg'] = "Entered passwords do not match";
                $msg['res'] = 0;
            } else {
                $pass = password_hash($newPass, PASSWORD_DEFAULT, ['const' => 11]);
                $stmt = $con->prepare("UPDATE users SET pwd = ? WHERE ID = ?");
                $stmt->bind_param('si', $pass, $uid);
                if (!$stmt->execute()) {
                $msg['msg'] = "Error: Something went wrong - code: PSx006";
                $msg['res'] = 0;
                } else {
                $msg['msg'] = "Password changed";
                $msg['res'] = 1;
                }
            }
        }
    }

    echo json_encode($msg);
}

function loadAddress() {
    global $con;
    $l = $_SESSION['lang'];
    $row = $con->query("SELECT value FROM settings WHERE key_name = 'Address' AND lang = '$l'")->fetch_assoc();

    echo json_encode($row);
}

function loadSingleAddress() {
    global $con;
    
    $row = $con->query("SELECT ID, value, lang FROM settings WHERE key_name = 'address'")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function addPhone() {
    global $con;

    if (!$sql = $con->query("INSERT INTO settings(key_name, value, lang) VALUES('phone', '+123456789', 'all')")) {
        $msg['msg'] = 'Error: Something went wrong - code: PSx007';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
    }

    echo json_encode($msg);    
}

function loadPhones() {
    global $con;

    $row = $con->query("SELECT ID, value FROM settings WHERE key_name = 'phone'")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function loadSinglePhone() {
    global $con;
    $id = $_POST['id'];

    $stmt = $con->prepare("SELECT ID, value FROM settings WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $row = $stmt->get_result()->fetch_assoc();

    echo json_encode($row);
}

function phone() {
    global $con;
    $phone = $_POST['p'];
    $id = $_POST['i'];

    $stmt = $con->prepare("UPDATE settings SET value = ? WHERE ID = ?");
    $stmt->bind_param("si", $phone, $id);

    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went wrong - code: PSx008';
        $msg['res'] = 0;
    } else {
        $msg['msg'] = 'Phone number updated successfully';
        $msg['res'] = 1;
    }

    echo json_encode($msg);    
}

function address() {
    global $con;
    $address = $_POST['a'];
    $id = $_POST['i'];

    $stmt = $con->prepare("UPDATE settings SET value = ? WHERE ID = ?");
    $stmt->bind_param("si", $address, $id);

    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went wrong - code: PSx009';
        $msg['res'] = 0;
    } else {
        $msg['msg'] = 'Address updated successfully';
        $msg['res'] = 1;
    }

    echo json_encode($msg); 
}

function deletePhone() {
    global $con;
    $id = $_POST['id'];

    $stmt = $con->prepare("DELETE FROM settings WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function loadEmailAddress() {
    global $con;
    
    $row = $con->query("SELECT value FROM settings WHERE key_name = 'email'")->fetch_assoc();

    echo json_encode($row);
}

function emailAddress() {
    global $con;
    $address = $_POST['e'];

    $stmt = $con->prepare("UPDATE settings SET value = ? WHERE key_name = 'email'");
    $stmt->bind_param("s", $address);

    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went wrong - code: PSx010';
        $msg['res'] = 0;
    } else {
        $msg['msg'] = 'Email Address updated successfully';
        $msg['res'] = 1;
    }

    echo json_encode($msg); 
}

function changeLang() {
    $l = $_POST['l'];

    $_SESSION['lang'] = $l;
}