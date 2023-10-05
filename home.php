<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style type="text/css">
        body, h1, h2, h3, p, ul, li {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f0f0f0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .dashboard {
      
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .profile-section {
        
            width: 50%;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .todo-section {
            margin-top: 50px;
            width: 100%;
            background-color: #fff;
            
            margin-right: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .add-todo form {
            display: flex;
            justify-content: space-between;
        }

        .add-todo input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .add-todo button {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }

        .add-todo button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        table a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }

        table a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="dashboard">
   <div class="profile-section">
      <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
            <h2>Welcome , <?php echo $_SESSION['name'];?></h2>
            <h2> Mobile No : <?php echo $_SESSION['number'];?></h2>
            <h2>Email Id: <?php echo $_SESSION['email'];?></h2>
        </div>
        </div></center>
        <div class="todo-section">
            <h2>To-Do List</h2>
            <div class="add-todo">
                <form action="" method="POST">
                    <input type="text" name="task" placeholder="Enter a new task">
                    <button type="submit" name="addTask">Add</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'connection.php';

                    if (isset($_POST["addTask"])) {
                        $task = $_POST["task"];
                        $userid= $_SESSION['name'];
                        $sql = "INSERT INTO todo_list (user_id, task) VALUES ('$userid', '$task')";
                        if ($conn->query($sql) === TRUE) {
                            header("Location: home.php");
                            exit;
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    $userid=$_SESSION['name'];
                    $sql = "SELECT * FROM todo_list WHERE user_id = '$userid'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["task"] . "</td>";
                            echo "<td><a href='complete.php?complete=" . $row["id"] . "'>Complete</a> | ";
                            echo "<a href='update.php?update=" . $row["id"] . "'>Update</a> | ";
                            echo "<a href='delete.php?delete=" . $row["id"] . "'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No tasks found.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
