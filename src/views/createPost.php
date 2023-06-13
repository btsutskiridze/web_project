<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new post</title>
    <link href="src/css/createPost.css" rel="stylesheet">
</head>
<body>
<div class="popup-box">
    <h1 class="popup-heading">Create new post</h1>
    <form action="/create-post" method="post" enctype="multipart/form-data">
        <div class="input-box">
            <label for="title">Title</label>
            <input type="text" id='title' name="title" value="<?= Input::get('title') ?>">
            <?php if (isset($errors['title'])): ?>
                <span class="error-message"><?= $errors['title'] ?></span>
            <?php endif; ?>
        </div>


        <div class="input-box">
            <label for="image">Image</label>
            <input type="file" id='image' name="image" value="<?= Input::get('image') ?>">
            <?php if (isset($errors['image'])): ?>
                <span class="error-message"><?= $errors['image'] ?></span>
            <?php endif; ?>
        </div>

        <div class="input-box">
            <label for="content">Share what you think</label>
            <textarea name="content" id="content" placeholder="" rows="8"><?= Input::get('content') ?></textarea>
            <?php if (isset($errors['content'])): ?>
                <span class="error-message"><?= $errors['content'] ?></span>
            <?php endif; ?>
        </div>

        <input type="submit" value="Create" class="popup-button">

    </form>

</div>

</body>
</html>