<?php

require '../../config/db.php';

if (isset($_POST['block'])) {
    $id = $_POST['block'];

    $sql = $conn->prepare("UPDATE users SET blacklist = 'Y' WHERE id = ?");
    $sql->bind_param('i', $id);

    if ($sql->execute()) {
        $msg = json_encode("El usuario ha sido bloqueado");
        echo trim($msg, '"');
    } else {
        echo json_encode(0);
    }
}
if (isset($_POST['unblock'])) {
    $id = $_POST['unblock'];

    $sql = $conn->prepare("UPDATE users SET blacklist = 'N' WHERE id = ?");
    $sql->bind_param('i', $id);

    if ($sql->execute()) {
        $msg = json_encode("El usuario ha sido desbloqueado");
        echo trim($msg, '"');
    } else {
        echo json_encode(0);
    }
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $q = $conn->query("SELECT * FROM users WHERE id = '$id'");
    $d = $q->fetch_array();
    
    $sql = "DELETE FROM users WHERE id = '$id'";
    $conn->query($sql);
    unlink('uploads/' . $d['image']);

}
