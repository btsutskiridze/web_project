<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile | <?= $user->username ?></title>
    <link href="src/css/app.css" rel="stylesheet">
    <link href="src/css/profile.css" rel="stylesheet">
    <script src="src/js/profile.js" defer></script>
    <!--    <script src="https://cdn.tailwindcss.com"></script>-->
</head>
<body>
<div class="header">
    <h1 class="title">User Profile</h1>
    <nav class="navigation">
        <a href="#" class="nav-link">News feed</a>
        <a href="/logout" class="nav-link">Logout</a>
    </nav>
</div>

<div class="profile-container">
    <div class="profile">
        <div class="profile-info">
            <div class="profile-image">
                <div id="profile-image-upload-div">
                    <span>Upload photo</span>
                </div>
                <img src="src/assets/avatar.png" id="profile-imagee" alt="Profile Image">
            </div>
            <form action="/update-avatar" id="avatar-upload-form">
                <input type="file" id="profile-image-upload-input" accept="image/*">
                <button type="submit" class="profile-upload-btn hidden">Upload</button>
                <button type="button" class="profile-close-btn hidden">close</button>
            </form>
            <h2 class=" profile-name"><?= $user->username ?></h2>
            <p class="profile-email"><?= $user->email ?></p>
        </div>
        <div>
            <a href="/create-post" class="add-post-button">Add New Post</a>
        </div>
    </div>

    <div class="posts-container">
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <div class="post-header">
                    <img src="src/assets/avatar.png" alt="avatar" class="post-avatar">
                    <div>
                        <h2 class="post-username"><?= $user->username ?></h2>
                        <p class="post-date"><?= date('H:i, j F Y', strtotime($user->date)) ?></p>
                    </div>
                </div>
                <div class="post-description">
                    <?= $post->content ?>
                </div>
                <!--https://loremflickr.com/600/600-->
                <div>
                    <img src="<?= $post->image ?>" class="post-image" alt="">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>