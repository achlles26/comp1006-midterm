<?php
// include require statement
require("includes/connect.php");

// check if id is available
if (!isset($_GET['id'])) {
    die("No review ID provided.");
}

// var id
$id = $_GET['id'];

// check for submission type
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// sanitize data
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
    $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
    $review_text = filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_SPECIAL_CHARS);

    // sql statement
    $sql = "UPDATE reviews
                SET title = :title,
                    author = :author,
                    rating = :rating,
                    review_text = :review_text
                WHERE id = :id";

// prepare
    $stmt = $pdo->prepare($sql);

    // bind parameters
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':review_text', $review_text);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // check if execute successful for display messages
    if ($stmt->execute()) {
        header("Location: admin.php?message=Review updated successfully");
        exit(); // exit script after redirect
    } else {
        echo "Error updating review.";
    }
}

// sql statement
$sql = "SELECT * FROM reviews WHERE id = :id";
$stmt = $pdo->prepare($sql); // prepare
$stmt->bindParam(':id', $idM_INT);   // bind param
$stmt->execute();   // execute
$review = $stmt->fetch();

?>
<main>
<!-- Display information to be updated as old values-->
    <h2>Do you really wish to update this review?</h2>

    <form method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($review['title']); ?>" required><br>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value="<?= htmlspecialchars($review['author']); ?>" required><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" id="rating" name="rating" min="1" max="5" value="<?= htmlspecialchars($review['rating']); ?>" required><br>

        <label for="review_text">Review:</label><br>
        <textarea id="review_text" name="review_text" rows="4" cols="50" required><?= htmlspecialchars($review['review_text']); ?></textarea><br>

        <button type="submit">Update Review</button>
    </form>
</main>