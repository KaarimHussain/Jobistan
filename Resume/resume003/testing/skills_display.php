<?php



$skills = isset($_GET['chutiya']) ? $_GET['chutiya'] : '';

//$form_skills = isset($_GET['form_skills']) ? $_GET['form_skills'] : '';
// Normalize all line breaks to \n
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills Preview</title>
</head>

<body>
    <p>the list will be added here</p>
    <?php
    $skills_array = explode("\r\n", $skills);
    ?>

    <ul id="preview_skills">
        <?php foreach ($skills_array as $skill): ?>
            <li><?php echo htmlspecialchars($skill); ?></li>
        <?php endforeach; ?>
    </ul>

</body>

</html>