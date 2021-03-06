<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class categoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.add');
    }

    public function store(AddCategoryRequest $request)
    {
        $this->category->create(
            [
                'name' => $request->name
            ]
        );
        return redirect()->route('categories.index')->with('message_success', 'Tạo danh mục thành công');
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update($id, Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:20', Rule::unique('categories')->ignore($id)]
        ],
            [
                'name.required' => 'Tên danh mục không được trống',
                'name.unique' => 'Tên danh mục không trùng',
                'name.max' => 'Tên danh mục không được dài hơn 20 ký tự',
                'name.min' => 'Tên danh mục không được ngắn hơn 2 ký tự',
            ]
        );
        $this->category->find($id)->update([
            'name' => $request->name
        ]);
        return redirect()->back()->with('message_success', 'Cập nhật danh mục thành công');
    }

    public function delete($id)
    {
        $category = $this->category->find($id);
        $abc = $category->products->first();

        if (empty($abc)){
            $this->category->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        }else{
            return response()->json([
                'massage' => 'fail',
                'code' => 500
            ],500);
        }

    }

    public function search(Request $request)
    {
        $searches = $this->category->where('name', 'LIKE', "%$request->search%")->paginate(5)->appends(['search' => $request->search]);
        $value_search = $request->search;
        return view('admin.category.search', compact('searches', 'value_search'));
    }

    public function autocomplete_search(Request $request)
    {
        $data = $request->all();

        if ($data['query']) {
            $categories = $this->category->where('name', 'LIKE', '%' . $data['query'] . '%')->get();
            $output = '<ul class="dropdown-menu" style="display: block; position: absolute; margin-left: 15px;">';
            foreach ($categories as $key => $val) {
                $output .= '<li class="search_ajax_category_li" style=""><a href="#"  style=" color: black;">' . $val->name . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }

    }
}
