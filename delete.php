<?php
    // include require statement
    require("includes/connect.php");

    // check if id is present
    if (!isset($_GET['id'])) {
        die("No task ID provided.");
    }

    // get id
    $id = $_GET['id'];

    // sql statement
    $sql = "DELETE FROM reviews WHERE id = :id";
    // statement to prepare sql db
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);   // bind id param
   
    // check if execute is successful for display messages
    if($stmt->execute()) {
        header("Location: admin.php?message=Task deleted successfully");
        exit();
    } else {
        echo "Error deleting task.";
    }
?>