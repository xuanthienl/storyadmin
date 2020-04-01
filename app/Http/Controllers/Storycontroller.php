<?php

namespace App\Http\Controllers;
use App\Story;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Storage;

class Storycontroller extends Controller
{
    public function index() {
        // if (Auth::check()) { //Dùng cái này để bắt buộc login xong mới được vào home
            $stories = Story::orderBy('id', 'desc')->get();
            $categories = Category::where('deleted_at', NULL)->get();
            return view('home', ['stories' => $stories, 'categories'=> $categories]);
        // }
        // return redirect()->route('login');
    }

    //SHOW STORY
    public function indexstory() {
        $stories = Story::where('deleted_at', NULL)->Paginate(6);
        $categories = Category::get();
        return view('story.index_story', ['stories'=> $stories, 'categories' => $categories,]);
    }
    //CREATE STORY
    public function create() {
        $categories = Category::get();
        return view('story.create_story', ['categories' => $categories]);

    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'story' => 'required',
        ]);

        $story = new Story;
        $story->title = $request->title;
        $story->story = $request->story;
        $story->tbl_category_id = $request->category_id;


        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/img/story', $filename);
            $story->img = $filename;
        } else {
            // return $request;
            $story->img = '';
        };
       
        if($request->path) {
            $story->audio = $request->path;
        }
        else {
            if ($request->hasfile('audio')) {
                $file = $request->file('audio');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/audio/story', $filename);
                $story->audio = $filename;
            } 
            else {
                // return $request;
                $story->audio ='';
            } 
        }

        $story->save();

        return redirect()->route('stories.index');
    }

    //DESTROY STORY
    public function destroy($id) {
        $story = Story::where('id','=', $id)->first();

        $img = public_path("uploads/img/story/{$story->img}");
        if(is_file($img)) {
            unlink($img);
        }

        $audio = public_path("uploads/audio/story/$story->audio");
        if(is_file($audio)) {
            unlink($audio);
        }

        Story::destroy($id);
        return redirect()->route('stories.index');
    }

    //EDIT
    public function edit($id) {
        $data = Story::where('id', '=', $id)->first();
        $categories = Category::get();
        return view('story.edit_story', ['story'=> $data, 'categories' => $categories]);
    }

    public function update(Request $request, $id) {
        $data = Story::where('id', '=', $id)->first();
        $data->title = $request->title;
        $data->story = $request->story;
        $data->tbl_category_id = $request->category_id;
        
        if ($request->hasfile('image')) {

            $image = public_path("uploads/img/story/$data->img");
            if(is_file($image)) { //Dung is_file() để ktra xem file có tồn tại ko thay cho:  Story::exists($image)
                unlink($image);
            }  //KIỂM TRA XEM FILE ẢNH ĐÃ TỒN TẠI CHƯA, NẾU TỒN TẠI THÌ XÓA ĐI RỒI TIẾP TỤC
            
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/img/story', $filename);
            $data->img = $filename;
        }
        
        // $extension = Story::pluck('audio')->extension();
        if($request->path) {
            $audio = public_path("uploads/audio/story/$data->audio");
            if(is_file($audio)) {
                unlink($audio);
            }

            $data->audio = $request->path;
        }
        elseif ($request->hasfile('audio')) {
            // if($extension == '.mp3')
            $audio = public_path("uploads/audio/story/$data->audio");
                if(is_file($audio)) {
                    unlink($audio);
                }
            $file = $request->file('audio');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension; //dùng time() hoặc date('m-d-Y_H:i:s') hoặc timestamp() để cài tên cho file...
            $file->move('uploads/audio/story', $filename);
            $data->audio = $filename;
        }

        $data->save();
        
        return redirect()->route('stories.index');
    }

    //show
    public function show($id) {
        $categories = Category::get();
        $category = Category::where('id', $id)->first();
        $stories = Story::where('deleted_at', NULL)->where('tbl_category_id', '=', $id)->orderBy('created_at', 'desc')->paginate(10);
        return view('story.show_category_name', ['categories' => $category, 'category'=> $categories, 'stories' => $stories]);
    }

    //KHÔI PHỤC HOẶC XÓA VĨNH VIỄN STORY
    public function restore() {
        $stories = Story::onlyTrashed()->get();
        
        return view('story.restore_story', ['story'=> $stories]);
    }

    public function postrestore($id) {
        Story::where('id', $id)->restore();
        return redirect()->route('stories.index');
    }

    public function delete($id) {
        Story::where('id', $id)->forceDelete();
        return redirect()->route('restore-story');

    }

    public function like($id)
    {
        $story = Story::findOrFail($id);
        if ($story !== null) {

            $story->likes += 1;

            $story->save();

            return response()->json([
                // "success" => true,
                "solikela" => $story->likes
            ], 200);
        }
    }

    public function dislike($id)
    {
        $story = Story::findOrFail($id);
        if ($story !== null) {

            $story->likes -= 1;

            $story->save();

            return response()->json([
                // "success" => true,
                "solikela" => $story->likes
            ], 200);
        }
    }
}
