<?php
    session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit;
}

include 'connection.php';

if (isset($_GET["update"])) {
    $task_id = $_GET["update"];

    $sql = "SELECT * FROM todo_list WHERE id = $task_id AND user_id = '" . $_SESSION['name'] . "'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $task_text = $row["task"];
    } else {
        header("Location: home.php");
        exit;
    }
}

if (isset($_POST["updateTask"])) {
    $updated_task = $_POST["updated_task"];

    $update_sql = "UPDATE todo_list SET task = '$updated_task' WHERE id = $task_id AND user_id = '" . $_SESSION['name'] . "'";
    
    if ($conn->query($update_sql) === TRUE) {
        header("Location: home.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Task</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <h2>Update Task</h2>
        <input type="text" name="updated_task" value="<?php echo $task_text; ?>" required>
        <button type="submit" name="updateTask">Update</button>
    </form>
</body>
</html>
