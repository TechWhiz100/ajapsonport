<?php

        include 'config.php';
        session_start();

            
        $admin_id = $_SESSION['admin_id'];

        if(!isset($admin_id)){
            header('location: login');
        }
        // zBKvLGN7DWnD

    $stmt = $conn->prepare("SELECT * FROM projects");
    $stmt->execute();
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);



    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
    
        $title = filter_var($title, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
    
        $files = [
            'image' => ['folder' => 'uploaded_images/', 'size' => 'image_size'],
            'pdf' => ['folder' => 'uploaded_pdfs/', 'size' => 'pdf_size'],
            'ppt' => ['folder' => 'uploaded_ppts/', 'size' => 'ppt_size'],
            'excel' => ['folder' => 'uploaded_excels/', 'size' => 'excel_size'],
            'python' => ['folder' => 'uploaded_python/', 'size' => 'python_size'],
            'sql' => ['folder' => 'uploaded_sql/', 'size' => 'sql_size'],
            'video' => ['folder' => 'uploaded_videos/', 'size' => 'video_size'] // Added for video files
        ];
    
        $file_data = [];
        foreach ($files as $key => $file_info) {
            if (isset($_FILES[$key])) {
                $file = $_FILES[$key];
                $filename = $file['name'];
                $folder = $file_info['folder'];
                $size_key = $file_info['size'];
                $file_data[$key] = $filename;
                $file_data[$size_key] = $file['size'];
    
                if (move_uploaded_file($file['tmp_name'], $folder . $filename)) {
                    
                } else {
                    $message[] = "Error uploading " . $key;
                }
            } else {
                $file_data[$key] = null;
                $file_data[$size_key] = null;
            }
        }
    
        $stmt = $conn->prepare("INSERT INTO projects (title, description, image_filename, pdf_filename, ppt_filename, excel_filename, python_filename, sql_filename, video_filename, image_size, pdf_size, ppt_size, excel_size, python_size, sql_size, video_size) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
    
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $file_data['image']);
        $stmt->bindParam(4, $file_data['pdf']);
        $stmt->bindParam(5, $file_data['ppt']);
        $stmt->bindParam(6, $file_data['excel']);
        $stmt->bindParam(7, $file_data['python']);
        $stmt->bindParam(8, $file_data['sql']);
        $stmt->bindParam(9, $file_data['video']);
        $stmt->bindParam(10, $file_data['image_size'], PDO::PARAM_INT);
        $stmt->bindParam(11, $file_data['pdf_size'], PDO::PARAM_INT);
        $stmt->bindParam(12, $file_data['ppt_size'], PDO::PARAM_INT);
        $stmt->bindParam(13, $file_data['excel_size'], PDO::PARAM_INT);
        $stmt->bindParam(14, $file_data['python_size'], PDO::PARAM_INT);
        $stmt->bindParam(15, $file_data['sql_size'], PDO::PARAM_INT);
        $stmt->bindParam(16, $file_data['video_size'], PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            $message[] = "Project added successfully.";
        } else {
            $message[] = "Error: " . $stmt->errorInfo()[2];
        }
    }
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajapson</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/views.css">
</head>
<body>

        <header class="header">

        <div id="menu-btn" class="fas fa-bars"></div>

        <a href="#" class="logo"> <span>Aja</span>Pson </a>

        <nav class="navbar">
            <a href="#home"></a>
            <a href="#about"></a>
            <a href="#experience"></a>
            <a href="#skills"></a>
            <a href="#projects"></a>
            <!-- <a href="#contact">Admin</a> -->
        </nav>
        <!-- <a href="logout" class="btn" onclick="return confirmLogout();">Logout</a>
                <script>
        function confirmLogout() {
            return confirm('Are you sure you want to logout?');
        }
        </script> -->

        <div id="login-btn">
            <i class="fas fa-seedling"></i>
        </div>
        </header> 

    
    
    <section class="admin"> 
        <form action="" method="POST" enctype="multipart/form-data">
        <?php
            if(isset($message)){
                foreach($message as $msg){
                    echo '<div class="message">'.$msg.'</div>';
                }
            }
            ?>
            <h3>Upload files</h3>
            <label for="title">Title</label>
            <input type="text" class="box" placeholder="Enter project title" name="title" required>
            <label for="title">Description</label>
            <input type="text" class="box" placeholder="Enter project description" name="description" required>
            <label for="title">Image</label>
            <input type="file" class="box" name="image" accept="image/*" required> 
            <label for="title">PDF File</label>  
            <input type="file" class="box" name="pdf" accept=".pdf" required>
            <label for="title">PowerPoint File</label>
            <input type="file" class="box" name="ppt" accept=".ppt,.pptx" required>
            <label for="title">Excel File</label>
            <input type="file" class="box" name="excel" accept=".xls,.xlsx" required>
            <label for="title">Phyton File</label>
            <input type="file" class="box" name="python" accept=".html" required>
            <label for="title">SQL File</label>
            <input type="file" class="box" name="sql" accept=".sql" required>
            <label for="title">Video</label>
            <input type="file" class="box" name="video" accept="video/mp4, video/avi, video/mov" required>
            <input type="submit" class="btn" name="submit" value="Upload">
        </form>
    </section>

    <section class="projects-display">
    <h3>Uploaded Projects</h3>
    <?php foreach ($projects as $project): ?>
        <div class="project-item">
            <?php if ($project['image_filename']): ?>
                <img src="uploaded_images/<?= htmlspecialchars($project['image_filename']) ?>" alt="Project Image" width="100">
            <?php endif; ?>
            <?php if ($project['video_filename']): ?>
                <video src="uploaded_videos/<?= htmlspecialchars($project['video_filename']) ?>" width="320" height="240" controls></video>
            <?php endif; ?>
            <h4><?= htmlspecialchars($project['title']) ?></h4>
            <p><?= htmlspecialchars($project['description']) ?></p>
            <div class="project-links">
                <a href="uploaded_pdfs/<?= htmlspecialchars($project['pdf_filename']) ?>" target="_blank">View PDF</a>
                <a href="uploaded_ppts/<?= htmlspecialchars($project['ppt_filename']) ?>" target="_blank">View PPT</a>
                <a href="uploaded_excels/<?= htmlspecialchars($project['excel_filename']) ?>" target="_blank">View Excel</a>
                <a href="uploaded_python/<?= htmlspecialchars($project['python_filename']) ?>" target="_blank">View Python</a>
                <a href="uploaded_sql/<?= htmlspecialchars($project['sql_filename']) ?>" target="_blank">View SQL</a>
                <!-- <a href="update_project.php?id=<?= htmlspecialchars($project['id']) ?>">Update</a> -->
                <form action="delete_project.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($project['id']) ?>">
                    <input class="btn" type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete this project?');">
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<!-- ajapson100$ -->
 <!-- osenaja_ajape -->
 <!-- osenaja_ajapsondb -->




    <style>
        
.message{
        margin: 5px 0;
        width: 100%;
        border-radius: 5px;
        padding: 10px;
        text-align: center;
        background-color: var(--yellow);
        color: var(--black);
        font-size: 20px;
}

label{
    font-size: 1.2rem;
    color: #130f40;
    margin-left: 3rem;
}


    </style>


    <script src="js/script.js"></script>
</body>
</html>