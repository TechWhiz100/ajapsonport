<?php
include 'config.php'; 
session_start();


if (isset($_GET['id'])) {
    $project_id = (int)$_GET['id']; 

    // Fetch the project details from the database
    $query = "SELECT * FROM projects WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $project_id, PDO::PARAM_INT);
    $stmt->execute();
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$project) {
        echo "Project not found.";
        exit;
    }
} else {
    echo "No project ID specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/views.css">
</head>
<body>
    <header class="header">

    <div id="menu-btn" class="fas fa-bars"></div>   

    <a href="#" class="logo"> <span>Aja</span>Pson </a>

    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="index.php#about">About Me</a>
        <a href="#experience">Experience</a>
        <a href="#skills">Skills</a>
        <a href="#projects">Projects</a>
        <a href="#contact">Contact</a>
    </nav>

    <div id="login-btn">
        <i class="fas fa-seedling"></i>
    </div>
    </header>

<!-- section view  -->
    <section class="project-details" style="margin-top: 10rem;">
        <img src="uploaded_images/<?php echo htmlspecialchars($project['image_filename']); ?>" alt="Project Image">
        <video src="uploaded_videos/<?php echo htmlspecialchars($project['video_filename']); ?>" type="video/mp4" controls></video>
        <h3 style="font-size:2rem;"><?php echo htmlspecialchars($project['title']); ?></h3>
        <p style="font-size:1.5rem;"><?php echo htmlspecialchars($project['description']); ?></p>

        <h4>Files:</h4>
        <ul>
            <?php if ($project['pdf_filename']): ?>
                <li>
                    <a href="uploaded_pdfs/<?php echo htmlspecialchars($project['pdf_filename']); ?>" target="_blank">View PDF File</a> |
                    <a class="btn" href="uploaded_pdfs/<?php echo htmlspecialchars($project['pdf_filename']); ?>" download>Download PDF</a>
                </li>
            <?php endif; ?>
            <?php if ($project['ppt_filename']): ?>
                <li>
                    <a href="uploaded_ppts/<?php echo htmlspecialchars($project['ppt_filename']); ?>" target="_blank">View PowerPoint File</a> |
                    <a class="btn" href="uploaded_ppts/<?php echo htmlspecialchars($project['ppt_filename']); ?>" download>Download PPT</a>
                </li>
            <?php endif; ?>
            <?php if ($project['excel_filename']): ?>
                <li>
                    <a href="uploaded_excels/<?php echo htmlspecialchars($project['excel_filename']); ?>" target="_blank">View Excel File</a> |
                    <a class="btn" href="uploaded_excels/<?php echo htmlspecialchars($project['excel_filename']); ?>" download>Download Excel</a>
                </li>
            <?php endif; ?>
            <?php if ($project['python_filename']): ?>
                <li>
                    <a href="uploaded_python/<?php echo htmlspecialchars($project['python_filename']); ?>" target="_blank">View Python File</a> |
                    <a class="btn" href="uploaded_python/<?php echo htmlspecialchars($project['python_filename']); ?>" download>Download Python File</a>
                </li>
            <?php endif; ?>
            <?php if ($project['sql_filename']): ?>
                <li>
                    <a href="uploaded_sql/<?php echo htmlspecialchars($project['sql_filename']); ?>" target="_blank">View SQL File</a> |
                    <a class="btn" href="uploaded_sql/<?php echo htmlspecialchars($project['sql_filename']); ?>" download>Download SQL File</a>
                </li>
            <?php endif; ?>
        </ul>
    </section>
    
    <style>
    .project-details {
        padding: 20px;
        max-width: 800px;
        margin: auto;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .project-details img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
    }
    .project-details ul {
        list-style-type: none;
        padding: 0;
    }
    .project-details ul li {
        margin: 5px 0;
    }
    </style>
    
    <script src="js/script.js"></script>
</body>
</html>
