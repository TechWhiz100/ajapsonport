<?php
include 'config.php';

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    // Retrieve filenames to delete files from server
    $stmt = $conn->prepare("SELECT image_filename, pdf_filename, ppt_filename, excel_filename, python_filename, sql_filename FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($project) {
        // Delete files from server
        foreach ($project as $key => $filename) {
            if ($filename) {
                $folder = 'uploaded_' . explode('_', $key)[0] . 's/';
                unlink($folder . $filename);
            }
        }

        // Delete project from database
        $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: personal");
        exit;
    }
}
?>
