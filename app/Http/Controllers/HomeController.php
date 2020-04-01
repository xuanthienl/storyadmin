<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use App\Category;

use Illuminate\Support\Facades\Auth; //để sử dụng aull

class HomeController extends Controller
{
    public function dashboard() {
        if (Auth::check()) {
            $stories = Story::get();
            $categories = Category::get();
            return view('dashboard', ['stories'=>$stories, 'categories' => $categories]);
        }
        return redirect()->route('login');
    }

    public function index() {
        // if (Auth::check()) { //Dùng cái này để bắt buộc login xong mới được vào home
            $stories = Story::where('deleted_at', NULL)->orderBy('id', 'desc')->get();
            $categories = Category::where('deleted_at', NULL)->take(5)->get();
            return view('home', ['stories' => $stories, 'categories'=> $categories]);
        // }
        // return redirect()->route('login');
    }

    public function PageCategory($id) {
        $categories = Category::where('deleted_at', NULL)->take(5)->get();
        $category = Category::where('deleted_at', NULL)->where('id', '=', $id)->first();
        $stories = Story::where('deleted_at', NULL)->where('tbl_category_id', '=', $id)->orderBy('created_at', 'desc')->get();
        return view('category', ['categories' => $categories, 'category' => $category, 'stories' => $stories]);
    }

    public function PageStory($id) {
        $categories = Category::where('deleted_at', NULL)->take(5)->get();
        $story = Story::where('deleted_at', NULL)->where('id', '=', $id)->first();
        return view('story', ['categories' => $categories, 'story' => $story]);
    }

    public function search(Request $request) {
        
        $category_id = $request->category;
        $title = $request->content;

        $story = Story::where('deleted_at', null);

        if(isset($category_id) && $category_id > 0){
            // NẾU TỒN TẠI VÀ ID TỪ > 0 (0 LÀ GIÁ TRỊ CỦA ALL) NÊN KHI CHỌN ALL THÌ TÌM KIẾM THEO CATEGORY KO THỰC HIỆN
            $story = $story->where('tbl_category_id', $category_id);
        }

        if(isset($title) && strlen($title) > 0){
            // NẾU TỒN TẠI VÀ ĐỘ DÀI > 0
            $story = $story->where('title', 'like', "%". $title ."%");
        }
        $story = $story->paginate(10);



        // if(isset($category) && isset($timkiem)) {
        //     $story = Story::where('tbl_category_id', $category)->Where('story','like', "%" . $timkiem . "%")->orWhere('audio','like', "%" . $timkiem . "%")->firstOrFail()->paginate(10);
        // }
        // elseif (isset($timkiem)) {
        //     $story = Story::Where('title','like', "%" . $timkiem . "%")->orWhere('story','like', "%" . $timkiem . "%")->orWhere('audio','like', "%" . $timkiem . "%")->firstOrFail()->paginate(10);
        // }
        // elseif (isset($category)) {
        //     $story = Story::where('tbl_category_id','like', "%" . $category . "%")->firstOrFail()->paginate(10);
        // }
        
        $categories = Category::get();
        
    
        return view('search', ['categories'=> $categories, 'stories' => $story, 'category_id' => $category_id, 'title' => $title]);
    }

    public function sendMail() {
        
    }
}
