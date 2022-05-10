<?php
include_once 'cheader.cal.php';

function loadAbout() {
    global $con;
    $l = $_SESSION['lang'];
    $row = $con->query("SELECT (SELECT Value FROM settings WHERE key_name = 'about' AND lang = '$l') AS about, 
    (SELECT Value FROM settings WHERE key_name = 'title' AND lang = '$l') AS title")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function loadMain() {
    global $con;
    $l = $_SESSION['lang'];
    $row = $con->query("SELECT (SELECT Value FROM settings WHERE key_name = 'descr' AND lang = '$l') AS descr, 
    (SELECT Value FROM settings WHERE key_name = 'header' AND lang = '$l') AS header")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function loadAbouts() {
    global $con;

    $row = $con->query("SELECT s1.Value AS about, s2.Value AS title, s1.lang FROM
    (SELECT Value, lang FROM settings WHERE key_name = 'about') s1 INNER JOIN
    (SELECT Value, lang FROM settings WHERE key_name = 'title') s2 ON s1.lang = s2.lang")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function loadMains() {
    global $con;

    $row = $con->query("SELECT s1.Value AS descr, s2.Value AS header, s1.lang FROM
    (SELECT Value, lang FROM settings WHERE key_name = 'descr') s1 INNER JOIN
    (SELECT Value, lang FROM settings WHERE key_name = 'header') s2 ON s1.lang = s2.lang")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function aboutTitle() {
    global $con;
    $title = $_POST['t'];
    $lang = $_POST['lang'];
    $err = array();    

    if (mb_strlen($title) < 3) {
        array_push($err, 'Title must be at least 3 characters');
    }

    if (count($err) > 0) {
        $msg['err'] = $err;
        $msg['res'] = 2;
    } else {
        $stmt = $con->prepare("UPDATE settings SET Value = ? WHERE key_name = 'title' AND lang = ?");
        $stmt->bind_param("ss", $title, $lang);
    
        if (!$stmt->execute()) {
            $msg['msg'] = 'Error: Something went - code: PLx016';
            $msg['res'] = 0;
        } else {
            $msg['msg'] = 'Title updated successfully';
            $msg['res'] = 1;
        }
    }
    
    echo json_encode($msg);
}

function mainTitle() {
    global $con;
    $title = $_POST['t'];
    $lang = $_POST['lang'];
    $err = array();    

    if (mb_strlen($title) < 3) {
        array_push($err, 'Title must be at least 3 characters');
    }

    if (count($err) > 0) {
        $msg['err'] = $err;
        $msg['res'] = 2;
    } else {
        $stmt = $con->prepare("UPDATE settings SET Value = ? WHERE key_name = 'header' AND lang = ?");
        $stmt->bind_param("ss", $title, $lang);
    
        if (!$stmt->execute()) {
            $msg['msg'] = 'Error: Something went - code: PLx016';
            $msg['res'] = 0;
        } else {
            $msg['msg'] = 'Title updated successfully';
            $msg['res'] = 1;
        }
    }
    
    echo json_encode($msg);
}

function aboutDescr() {
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
        $stmt = $con->prepare("UPDATE settings SET Value = ? WHERE key_name = 'about' AND lang = ?");
        $stmt->bind_param("ss", $descr, $lang);
    
        if (!$stmt->execute()) {
            $msg['msg'] = 'Error: Something went - code: PLx017';
            $msg['res'] = 0;
        } else {
            $msg['msg'] = 'About text updated successfully';
            $msg['res'] = 1;
        }
    }
    
    echo json_encode($msg);
}

function mainDescr() {
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
        $stmt = $con->prepare("UPDATE settings SET Value = ? WHERE key_name = 'descr' AND lang = ?");
        $stmt->bind_param("ss", $descr, $lang);
    
        if (!$stmt->execute()) {
            $msg['msg'] = 'Error: Something went - code: PLx017';
            $msg['res'] = 0;
        } else {
            $msg['msg'] = 'Description updated successfully';
            $msg['res'] = 1;
        }
    }
    
    echo json_encode($msg);
}




// *********************** QUOTE ***********************

function addQuote() {
    global $con;
    $title = 'Quote Title';
    $date = getMyDate('date');
    $text = 'Add a few sentences here...';

    if (!$sql = $con->query("INSERT INTO quotes(Date) VALUES('$date')")) {
        $msg['msg'] = 'Error: Something went - code: PLx010 - '.$con->error;
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
        $id = $con->insert_id;
        for ($i = 0; $i < count(langs); $i++) {
            $lang = langs[$i];
            $sql = $con->query("INSERT INTO quote_detail(qtID, Title, Descr, Lang) VALUES('$id', '$title', '$text', '$lang')");
        }
    }

    echo json_encode($msg);
}

function loadQuotes() {
    global $con;
    $l = $_SESSION['lang'];
    $row = $con->query("SELECT q.ID, qd.Title, qd.Descr, q.Date, IF(q.Active = 1, 'checked', 'no') AS active FROM quotes q 
    LEFT JOIN (SELECT * FROM quote_detail WHERE Lang = '$l') qd ON q.ID = qd.qtID ORDER BY active ASC, q.ID DESC")->fetch_all(MYSQLI_ASSOC);
    
    echo json_encode($row);
}


function loadSingleQuote() {
    global $con;
    $id = $_POST['i'];
    $stmt = $con->prepare("SELECT qd.ID, q.ID AS uID, q.Date, qd.Descr, qd.Title, qd.Lang FROM
    quotes q LEFT JOIN quote_detail qd ON qd.qtID = q.ID WHERE q.ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function quoteActive() {
    global $con;
    $act = r($_POST['act']);
    $id = r($_POST['id']);
    
    $stmt = $con->prepare("UPDATE quotes SET Active = ? WHERE ID = ?");
    $stmt->bind_param("ii", $act, $id);

    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went wrong - code: PLx011';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
    }

    echo json_encode($msg);
}


function quoteDescr() {
    global $con;
    $descr = r($_POST['d']);
    $id = $_POST['i'];
    $err = array();

    if (empty($id)) {
        $msg['res'] = 0;
        $msg['msg'] = 'Error: Unidentified request - code: PLx012';
    } else {
        if (mb_strlen($descr) < 10) {
            array_push($err, 'Text is too short');
        }

        if (count($err) > 0) {
            $msg['err'] = $err;
            $msg['res'] = 2;
        } else {
            $stmt = $con->prepare("UPDATE quote_detail SET Descr = ? WHERE ID = ?");
            $stmt->bind_param('si', $descr, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PLx013';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Text updated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function quoteTitle() {
    global $con;
    $title = r($_POST['t']);
    $id = $_POST['i'];
    $err = array();

    if (empty($id)) {
        $msg['res'] = 0;
        $msg['msg'] = 'Error: Unidentified request - code: PLx014';
    } else {
        if (mb_strlen($title) < 1) {
            array_push($err, 'Title is too short');
        }

        if (count($err) > 0) {
            $msg['err'] = $err;
            $msg['res'] = 2;
        } else {
            $stmt = $con->prepare("UPDATE quote_detail SET Title = ? WHERE ID = ?");
            $stmt->bind_param('si', $title, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PLx015';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Title updated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function deleteQuote() {
    global $con;
    $id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM quotes WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
?>