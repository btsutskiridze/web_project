<link href="src/css/postPopup.css" rel="stylesheet">
<script async src="src/js/postPopup.js"></script>
<div class="popup-background hide">
    <div class="popup-box">
        <h1 class="popup-heading">Create new post</h1>
        <form action="/create-post">
            <div class="input-box">
                <label for="title">Title</label>
                <input type="text" id='title' name="title">
            </div>

            <div class="input-box">
                <label for="image">Image</label>
                <input type="file" id='image' name="image">
            </div>

            <div class="input-box">
                <label for="content">Share what you think</label>
                <textarea name="content" id="content" placeholder="" rows="8"></textarea>
            </div>

            <input type="submit" value="Create" class="popup-button">

        </form>

    </div>
</div>
