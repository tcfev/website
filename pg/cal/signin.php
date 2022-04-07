<?php
  include_once 'cheader.cal.php';

  function login(){
    global $con;
    $args = func_get_args();
    if (count($args) > 0) {
      $username = $args[0];
      $pwd = $args[1];
    } else {
      $username = $con->real_escape_string($_POST['username']);
      $pwd = $_POST['pwd'];
    }

    if (empty($username) || empty($pwd)) {
      $msg['msg'] = 'Enter the username and password';
      $msg['res'] = 0;
    } else {
      $stmt = $con->prepare("SELECT * FROM users WHERE user_name = ?");
      $stmt->bind_param('s', $username);
      if (!$stmt->execute()) {
        session_unset();
        session_destroy();
        $msg['msg'] = 'Error: Something went wrong - code: LIx001';
        $msg['res'] = 0;
      } else {
        $row = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($row) < 1) {
          session_unset();
          session_destroy();
          $msg['msg'] = 'Username or passwrod is wrong';
          $msg['res'] = 0;
        } else {
          if (!$result = password_verify($pwd, $row[0]['pwd'])) {
            session_unset();
            session_destroy();
            $msg['msg'] = 'Username or passwrod is wrong';
            $msg['res'] = 0;
          } else {
            $_SESSION['u_upost'] = $row[0]['role'];
            $_SESSION['u_uid'] = $row[0]['member_id'];
            if (isset($_POST['isMobile']) || isset($args[2])) {
              $_SESSION['isMobile'] = true;
            }
            $msg['msg'] = 'Welcome';
            $msg['res'] = 1;
          }
        }
      }
    }

    if (count($args) == 0) {
      echo json_encode($msg);
    }
  }

  function logout(){
    global $con, $uid;
    if (isset($_SESSION['isMobile'])) {
      if ($sql = $con->query("UPDATE users SET Token = '0' WHERE ID = '$uid'")) {
        session_unset();
        session_destroy();
        $msg['res'] = 1;
      } else {
        $msg['res'] = 0;
      }
    } else {
      session_unset();
      session_destroy();
      $msg['res'] = 2;
    }
    echo json_encode($msg);
  }

?>
