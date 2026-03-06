<?php
// include require statement
    require("includes/connect.php");

    // sanitize data
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
    $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
    $review = filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_SPECIAL_CHARS);

    // sql statement
    $sql = "INSERT INTO reviews (title, author, rating, review_text) VALUES (:title, :author, :rating, :review_text)";

    // prepare
    $stmt = $pdo->prepare($sql);

    // bind parameters
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':review_text', $review);


    // check if execute successful for display messages
    if ($stmt->execute()) {
        header("Location: index.php?message=Review submitted successfully");
        exit(); // exit script after redirect
    } else {
        echo "Error submitting review.";
    }
?>