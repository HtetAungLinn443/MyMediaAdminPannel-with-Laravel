<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //category page
    public function index()
    {
        $category = Category::get();
        return view('admin.category.index', compact('category'));
    }

    // category create
    public function categoryCreate(Request $request)
    {
        $this->categoryValidation($request);
        $date = $this->getCategoryDate($request);

        Category::create($date);
        return back();
    }

    // category delete
    public function categoryDelete($id)
    {
        Category::where('category_id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Caetgory Deleet Success!']);
    }

    // category search
    public function categorySearch(Request $request)
    {
        $category = Category::Where('title', "LIKE", '%' . $request->categoryKey . '%')
            ->get();
        return view('admin.category.index', compact('category'));
    }

    // Category Edit Page
    public function categoryEditPage($id)
    {
        $category = Category::where('category_id', $id)->first();
        return view('admin.category.editPage', compact('category'));
    }

    // Category Edit
    public function categoryEdit(Request $request, $id)
    {

        $this->categoryValidation($request);
        $data = $this->getCategoryDate($request);

        Category::where('category_id', $id)->update($data);
        return redirect()->route('admin#category');
    }

    // private function group
    // category Validation
    private function categoryValidation($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required',
            'categoryDescription' => 'required|min:3',
        ])->validate();
    }

    // get category date
    private function getCategoryDate($request)
    {
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
        ];
    }

}