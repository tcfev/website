<?php

include_once 'cheader.cal.php';

function loadBlogs() {
    global $con;
    $l = $_SESSION['lang'];

    $stmt = $con->prepare("SELECT b.*, bd.descr, bd.body, bd.title, IF(b.active = 1, 'checked', 'no') AS active FROM blogs b INNER JOIN
    (SELECT * FROM blog_detail WHERE lang = ?) bd ON b.ID = bd.blog_id ORDER BY b.ID DESC");
    $stmt->bind_param("s", $l);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    for ($i=0; $i < count($row); $i++) { 
        $id = $row[$i]['ID'];
        $row[$i]['gallery'] = $con->query("SELECT bd.ID, bd.blog_id AS pID, bd.photo, bgd.ID AS bgdID, bgd.title
        FROM (SELECT * FROM blog_gallery WHERE blog_id = '$id') bd 
        INNER JOIN (SELECT * FROM blog_gallery_detail WHERE lang = '$l') bgd ON bd.ID = bgd.blog_gallery_id")->fetch_all(MYSQLI_ASSOC);
        
        $row[$i]['videos'] = $con->query("SELECT bv.ID, bv.blog_id AS pID, bvd.video, bvd.ID AS bvdID, bvd.title
        FROM (SELECT * FROM blog_video WHERE blog_id = '$id') bv 
        INNER JOIN (SELECT * FROM blog_video_detail WHERE lang = '$l') bvd ON bv.ID = bvd.blog_video_id")->fetch_all(MYSQLI_ASSOC);

		$row[$i]['projects'] = $con->query("SELECT '$id' AS bID, p.ID, pd.title, IF(bp.ID, 1, 0) AS selected FROM projects p
		INNER JOIN (SELECT * FROM project_detail WHERE lang = '$l') pd ON p.ID = pd.project_id
		LEFT JOIN (SELECT * FROM blog_projects WHERE blog_id = '$id') bp ON p.ID = bp.project_id ORDER BY selected DESC, pd.title ASC, p.ID DESC")-> fetch_all(MYSQLI_ASSOC);

		$row[$i]['tags'] = $con->query("SELECT '$id' AS bID, tg.ID, tgd.tag, IF(bp.ID, 1, 0) AS selected FROM tags tg
		INNER JOIN (SELECT * FROM tag_detail WHERE lang = '$l') tgd ON tg.ID = tgd.tag_id
		LEFT JOIN (SELECT * FROM blog_tags WHERE blog_id = '$id') bp ON tg.ID = bp.tag_id ORDER BY selected DESC, tgd.tag ASC, tg.ID DESC")-> fetch_all(MYSQLI_ASSOC);
    }

    echo json_encode($row);
}

function loadBlogsByTag() {
	global $con;
	$id = $_POST['id'];
    $l = $_SESSION['lang'];

	if ($id == 0) {
		$stmt = $con->prepare("SELECT b.*, bd.title, bd.body, bd.descr FROM 
		blogs b INNER JOIN (SELECT * FROM blog_detail WHERE lang = ?) bd ON b.ID = bd.blog_id ORDER BY b.ID DESC");
		$stmt->bind_param("s", $l);
		$stmt->execute();
		$blogs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	} else {
		$stmt = $con->prepare("SELECT b.*, bd.title, bd.body, bd.descr FROM 
		blogs b INNER JOIN (SELECT * FROM blog_detail WHERE lang = ?) bd ON b.ID = bd.blog_id
		INNER JOIN (SELECT * FROM blog_tags WHERE tag_id = ?) bt ON b.ID = bt.blog_id
		ORDER BY b.ID DESC");
		$stmt->bind_param("si", $l, $id);
		$stmt->execute();
		$blogs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	}

	echo json_encode($blogs);
}

function addBlog() {
    global $con;
    $title = 'Title';
    $text = 'Description';
    $seo = 'SEO Description';
    $date = getMyDate('dateTime');

    if (!$con->query("INSERT INTO blogs(views, date, project_id, active) VALUES('0', '$date', '0', '0')")) {
        $msg['msg'] = 'Error: Something went - code: PPx001';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
        $id = $con->insert_id;
		$con->query("UPDATE blogs SET link = '$id' WHERE ID = '$id'");
        for ($i = 0; $i < count(langs); $i++) {
            $lang = langs[$i];
            $b = $text.' - '.$lang;
            $t = $title.' - '.$lang;
            $s = $seo.' - '.$lang;
            $con->query("INSERT INTO blog_detail(blog_id, descr, title, body, lang) VALUES('$id', '$s', '$t', '$b', '$lang')");
        }
    }

    echo json_encode($msg);
}

function loadSingleBlog() {
    global $con;
    $id = $_POST['i'];

    $row = $con->query("SELECT bd.ID, '$id' AS uID, bd.title, bd.descr, bd.body, bd.lang FROM  blog_detail bd WHERE bd.blog_id = '$id'")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function blogActive() {
    global $con;
    $act = r($_POST['act']);
    $id = r($_POST['id']);
    
    $stmt = $con->prepare("UPDATE blogs SET active = ? WHERE ID = ?");
    $stmt->bind_param("ii", $act, $id);

    if (!$stmt->execute()) {
        $msg['msg'] = 'Error: Something went wrong - code: PPx006';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
    }

    echo json_encode($msg);
}

function blogTitle() {
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
            $stmt = $con->prepare("UPDATE blog_detail SET title = ? WHERE ID = ?");
            $stmt->bind_param('si', $title, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PPx009';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Title ubdated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function blogDescr() {
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
            $stmt = $con->prepare("UPDATE blog_detail SET body = ? WHERE ID = ?");
            $stmt->bind_param('si', $text, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went wrong - code: PPx011';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Text updated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function blogLink() {
	global $con;
	$id = $_POST['i'];
	$link = str_replace(' ', '+', $_POST['l']);
	$err = array();

	if (empty($id)) {
        $msg['res'] = 0;
        $msg['msg'] = 'Error: Unidentified request - code: PPx018';
	} else {
		if (empty($link)) {
			array_push($err, 'Link is empty');
		}
		if (count($err) > 0) {
            $msg['err'] = $err;
            $msg['res'] = 2;
        } else {
			$stmt = $con->prepare("SELECT ID FROM blogs WHERE link = ?");
			$stmt->bind_param("s", $link);
			$stmt->execute();
			$rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			if (count($rows) > 0) {
				$msg['msg'] = 'This link address already exists - code: PPx020';
				$msg['res'] = 0;
			} else {
				$stmt = $con->prepare("UPDATE blogs SET link = ? WHERE ID = ?");
				$stmt->bind_param('si', $link, $id);
				if (!$stmt->execute()) {
					$msg['msg'] = 'Error: Something went wrong - code: PPx019';
					$msg['res'] = 0;
				} else {
					$msg['msg'] = 'Link updated successfully';
					$msg['res'] = 1;
				}
			}
        }
	}
    echo json_encode($msg);
}

function blogExp() {
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
            $stmt = $con->prepare("UPDATE blog_detail SET descr = ? WHERE ID = ?");
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

function deleteBlog() {
    global $con;

    $id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM blogs WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function addBlogImage() {
    global $con;
    $id = $_POST['id'];
    $title = 'Blog Photo Title';
    $photo = 'content/blogs/temp.jpg';

    if (!$sql = $con->query("INSERT INTO blog_gallery(blog_id, photo) VALUES('$id', '$photo')")) {
        $msg['msg'] = 'Error: Something went - code: PPx002';
        $msg['res'] = 0;
    } else {
        $msg['res'] = 1;
        $id = $con->insert_id;
        for ($i = 0; $i < count(langs); $i++) {
            $lang = langs[$i];
            $t = $title.' - '.$lang;
            $sql = $con->query("INSERT INTO blog_gallery_detail(blog_gallery_id, title, lang) VALUES('$id', '$t', '$lang')");
        }
    }

    echo json_encode($msg);
}

function blogImage() {
    global $con;
    $id = $_POST['i'];
    $str = getMyDate('shamsiDateTimeString');
    $file = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $path = 'content/blogs/gallery/p-image-'.$id.'-'.$str.'.'.$ext;
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
            $stmt = $con->prepare("UPDATE blog_gallery set photo = ? WHERE ID = ?");
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

function loadSingleBlogImage() {
    global $con;

    $id = $_POST['i'];

    $stmt = $con->prepare("SELECT ID, blog_gallery_id AS bdID, title, lang FROM blog_gallery_detail WHERE blog_gallery_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function blogImageTitle() {
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
            $stmt = $con->prepare("UPDATE blog_gallery_detail SET title = ? WHERE ID = ?");
            $stmt->bind_param('si', $title, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PPx024';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Title ubdated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function deleteBlogImage() {
    global $con;

    $id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM blog_gallery WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function addBlogVideo() {
    global $con;
    $id = $_POST['id'];
    $video = '<iframe width="560" height="315" src="https://www.youtube.com/embed/1tj7Y3PR16s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    $title = 'Video Title';
    $views = 0;
    
    $stmt = $con->prepare("INSERT INTO blog_video(blog_id, views) VALUES(?,?)");
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
            $sql = $con->query("INSERT INTO blog_video_detail(blog_video_id, video, title, lang) VALUES('$id', '$video', '$t', '$lang')");
        }
    }
    
    echo json_encode($msg);
    
}

function loadSingleBlogVideo() {
    global $con;
    $id = $_POST['i'];

    $stmt = $con->prepare("SELECT ID, blog_video_id AS bvID, title, video, lang FROM blog_video_detail WHERE blog_video_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function loadBlogLink() {
    global $con;
    $id = $_POST['i'];

    $stmt = $con->prepare("SELECT ID, link FROM blogs WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode($row);
}

function blogVideo() {
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
            $stmt = $con->prepare("UPDATE blog_video_detail SET video = ? WHERE ID = ?");
            $stmt->bind_param('si', $video, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PPx056';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Video ubdated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function blogVideoTitle() {
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
            $stmt = $con->prepare("UPDATE blog_video_detail SET title = ? WHERE ID = ?");
            $stmt->bind_param('si', $title, $id);
            if (!$stmt->execute()) {
                $msg['msg'] = 'Error: Something went - code: PPx058';
                $msg['res'] = 0;
            } else {
                $msg['msg'] = 'Title ubdated successfully';
                $msg['res'] = 1;
            }
        }
    }

    echo json_encode($msg);
}

function deleteBlogVideo() {
    global $con;

    $id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM blog_video WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function addBlogProject() {
	global $con;

	$id = $_POST['id'];
	$pid = $_POST['pid'];
	$stmt = $con->prepare("INSERT INTO blog_projects(project_id, blog_id) VALUES(?,?)");
	$stmt->bind_param("ii", $pid, $id);
	$stmt->execute();

	echo $stmt->error;
}

function deleteBlogProject() {
	global $con;

	$id = $_POST['id'];
	$pid = $_POST['pid'];
	$stmt = $con->prepare("DELETE FROM blog_projects WHERE project_id = ? AND blog_id = ?");
	$stmt->bind_param("ii", $pid, $id);
	$stmt->execute();
}

function addBlogTag() {
	global $con;

	$id = $_POST['id'];
	$pid = $_POST['pid'];
	$stmt = $con->prepare("INSERT INTO blog_tags(tag_id, blog_id) VALUES(?,?)");
	$stmt->bind_param("ii", $pid, $id);
	$stmt->execute();

	echo $stmt->error;
}

function deleteBlogTag() {
	global $con;

	$id = $_POST['id'];
	$pid = $_POST['pid'];
	$stmt = $con->prepare("DELETE FROM blog_tags WHERE tag_id = ? AND blog_id = ?");
	$stmt->bind_param("ii", $pid, $id);
	$stmt->execute();
}