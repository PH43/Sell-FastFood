<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(){
        $categories = $this->category->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function create(){
        return view('admin.category.add');
    }

    public function store(AddCategoryRequest $request){
        $this->category->create(
            [
                'name' => $request->name
            ]
        );
        return redirect()->route('categories.index');
    }

    public function edit($id){
        $category = $this->category->find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update($id, EditCategoryRequest $request){
        $this->category->find($id)->update([
            'name' => $request->name
        ]);
        return redirect()->route('categories.index');
    }

    public function delete($id){
        $this->category->find($id)->delete();
        return redirect()->route('categories.index');
    }
}
