<?php

    // require statment
    require("includes/connect.php");

    // sql statement
    $sql = "SELECT * FROM reviews ORDER BY created_at DESC";

    // prepare sql
    $stmt = $pdo->prepare($sql);
    $stmt->execute();   // execute
    $reviews = $stmt->fetchAll(); // fetch all results
?>
<main>
<!-- Check if there are reviews-->
    <?php if (empty($reviews)): ?>
        <p>No reviews yet.</p>
    <?php else: ?>

        <div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Rating</th>
                        <th>Review</th>
                    </tr>
                </thead>

                <tbody>
    <!--Loop over existing content-->
                    <?php foreach ($reviews as $review): ?>
                        <tr>
                            <td><?= htmlspecialchars($review['id']); ?></td>
                            <td><?= htmlspecialchars($review['title']); ?></td>
                            <td><?= htmlspecialchars($review['author']); ?></td>
                            <td><?= htmlspecialchars($review['rating']); ?></td>
                            <td><?= htmlspecialchars($review['review_text']); ?></td>
                            <td><form action="update.php?id=<?= htmlspecialchars($review['id']); ?>" method="post"><button type="submit">Update</button></form></td>
                            <td><form action="delete.php?id=<?= htmlspecialchars($review['id']); ?>" method="post"><button type="submit" id="delete-button">Delete</button></form></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>

    <?php endif; ?>

</main>
