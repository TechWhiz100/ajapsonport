<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$project) {
        echo "Project not found!";
        exit;
    }
}

if (isset($_POST['update'])) {
    // Handle update logic here, similar to your insert logic but using UPDATE SQL statement
    // Don't forget to move the uploaded files if they are replaced, or keep the existing ones
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Project</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="admin">
    <form action="" method="POST" enctype="multipart/form-data">
        <h3>Update Project</h3>
        <input type="text" class="box" placeholder="Enter project title" name="title" value="<?= htmlspecialchars($project['title']) ?>" required>
        <input type="text" class="box" placeholder="Enter project description" name="description" value="<?= htmlspecialchars($project['description']) ?>" required>
        <!-- Add file inputs here, similar to the original form, pre-filling the values -->
        <input type="submit" class="btn" name="update" value="Update">
    </form>
</section>

<script src="js/script.js"></script>
</body>
</html>
