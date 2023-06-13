<?php

class PostsController extends Controller
{

    /**
     * @throws Exception
     */

    public function createPostView(): void
    {
        $this->view('createPost');
    }

    /**
     * @throws Exception
     */
    public function create(): void
    {
        $post = new Post;

        $validator = new Validator();

        $validator->setAttributes([
            'title' => "Title",
            'content' => 'Content',
            'image' => "Image",
        ]);

        $validations = $validator->check($_POST, [
            'title' => ['required' => true, 'min' => 3, 'max' => 255],
            'content' => ['required' => true, 'min' => 3],
        ]);


        if (!$validations->passed() || !$_FILES['image']['name']) {
            $this->view('createPost', ['errors' =>
                $validations->errors() + ['image' => 'Image is required']
            ]);
            return;
        }

        $image = $_FILES['image'];

        if (!$filePath = File::upload($image['name'], $image['tmp_name'], $image['type'], $image['size'])) {
            $this->view('createPost', ['errors' => File::$errors]);
            return;
        }

        $post->create([
            'title' => Input::get('title'),
            'content' => Input::get('content'),
            'image' => $filePath,
            'user_id' => (new user)->data()->id,
        ]);
        Redirect::to('/profile');
    }
}