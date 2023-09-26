<?php
session_start();
include '../db_config.php';

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Messages Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Users Messages Management</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Sent_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();

                // Checking the connection 
                if ($connect->connect_error) {
                    die("Connection failed: " . $connect->connect_error);
                }

                // Read all rows from database table
                $sql = "SELECT * FROM users_feedback";
                $result = $connect->query($sql);

                // Checking if the query execution was successful
                if (!$result) {
                    die("Invalid query: " . $connect->error);
                }

                // Read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['message']}</td>
                        <td>{$row['Sent_at']}</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='edituser.php?id={$row['id']}'>Edit</a> <!-- Edits the user -->
                            <a class='btn btn-danger btn-sm' href='delete-user_message.php?id={$row['id']}'>Delete</a> <!-- Deletes the user -->
                        </td>
                    </tr>";
                }

                // Close the connection
                $connect->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
