<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //post page
    public function index()
    {
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.index', compact('category', 'post'));
    }

    // Post Create
    public function postCreate(Request $request)
    {
        $this->postValidationCheck($request);

        if (!empty($request->postImage)) {
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);
            $data = $this->getPostDate($request, $fileName);
        } else {
            $data = $this->getPostDate($request, null);
        }

        Post::create($data);
        return back();
    }

    // Post Delete
    public function postDelete($id)
    {
        $postData = Post::where('post_id', $id)->first();
        $dbImageName = $postData->image;

        Post::where('post_id', $id)->delete();

        if (File::exists(public_path() . '/postImage/' . $dbImageName)) {
            File::delete(public_path() . '/postImage/' . $dbImageName);
        }

        return back();
    }

    // Post Edit Page
    public function postEditPage($id)
    {
        $category = Category::get();
        $post = Post::get();
        $editPost = Post::where('post_id', $id)->first();
        return view('admin.post.editPost', compact('category', 'post', 'editPost'));
    }

    // Edit Post
    public function editPost(Request $request, $id)
    {
        $this->postValidationCheck($request);
        $data = $this->getEditPostDate($request);

        if (isset($request->postImage)) {
            // get from client
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();

            $data['image'] = $fileName;

            // get image name from database
            $postData = Post::where('post_id', $id)->first();
            $dbImageName = $postData->image;

            // Delete image name from public folder
            if (File::exists(public_path() . '/postImage/' . $dbImageName)) {
                File::delete(public_path() . '/postImage/' . $dbImageName);
            }

            // store new image under public folder
            $file->move(public_path() . '/postImage', $fileName);

            // Update new data with new image
            Post::where('post_id', $id)->update($data);

        } else {
            Post::where('post_id', $id)->update($data);
        }

        return redirect()->route('admin#post')->with(['updateSuccess' => 'Post Update Success!']);
    }

    // post validation check
    private function postValidationCheck($request)
    {
        Validator::make($request->all(), [
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postCategory' => 'required',
            'postImage' => 'mimes:png,jpg,jpeg,web',
        ])->validate();
    }

    // get post date
    private function getPostDate($request, $fileName)
    {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'image' => $fileName,
            'category_id' => $request->postCategory,
        ];
    }

    // Get Edit Post Data
    private function getEditPostDate($request)
    {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            // 'image' => $fileName,
            'category_id' => $request->postCategory,
            'updated_at' => Carbon::now(),
        ];

    }
}