<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function index() {
        $categories = Category::where('deleted_at', NULL)->Paginate(5); //simplePaginate(6); để chỉ hiển thị 2 nút Previous và Next
        return view('category.index_category', ['categories' => $categories]);

    }

    public function create() {
        return view('category.create_category');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);

        $category = New Category;
        $category->name = $request->name;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/img/category', $filename);
            $category->img = $filename;
        } else {
            // return $request;
            $category->img = '';
        };

        $category->save();

        return redirect()->route('categories.index');
    }

    public function destroy($id) {
        $category = Category::where('id','=', $id)->first();
        $img = public_path("uploads/img/category/{$category->img}");
        if (is_file($img)) { //Category::exists($img) sẽ trả về true, nó sẽ tìm file, nếu ko có file là nó báo lỗi ko có file để unlink
        unlink($img);
        }

        Category::destroy($id);
        return redirect()->route('categories.index');
    }

    public function edit($id) {
        $category = Category::where('id','=', $id)->first();
        return view('category.edit_category', ['category' => $category]);
    }

    public function update(Request $request, $id) {
        $category = Category::where('id','=', $id)->first();
        $category->name = $request->name;

        if ($request->hasfile('image')) {
            
            $img = public_path("uploads/img/category/{$category->img}");
            if (is_file($img)) { 
                unlink($img);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/img/category', $filename);
            $category->img = $filename;
            
        }

        $category->save();

        return redirect()->route('categories.index');
    }

    public function restore() {
        $category = Category::onlyTrashed()->get();
        
        return view('category.restore', ['category'=> $category]);
    }

    public function postrestore($id) {
        Category::where('id', $id)->restore();
        return redirect()->route('categories.index');
    }

    public function delete($id) {
        Category::where('id', $id)->forceDelete();
        return redirect()->route('restore');

    }
}
