<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit;
}



if (isset($_GET["delete"])) {
    $task_id = $_GET["delete"];

    include 'connection.php';

    // Perform a delete operation for the specified task_id
    $sql = "DELETE FROM todo_list WHERE id = $task_id AND user_id = '" . $_SESSION['name'] . "'";
    if ($conn->query($sql) === TRUE) {
        header("Location: home.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>
