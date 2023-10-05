<?php
session_start();

if (isset($_GET["complete"])) {
    $task_id = $_GET["complete"];

    include 'connection.php';

    // Perform an update to mark the task as completed (assuming you have a 'completed' field)
    $update_sql = "UPDATE todo_list SET completed = 1 WHERE id = $task_id AND user_id = '" . $_SESSION['name'] . "'";
    
    if ($conn->query($update_sql) === TRUE) {
        // If the update is successful, then proceed with the delete operation
        $delete_sql = "DELETE FROM todo_list WHERE id = $task_id AND user_id = '" . $_SESSION['name'] . "'";
        
        if ($conn->query($delete_sql) === TRUE) {
            header("Location: home.php");
            exit;
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
