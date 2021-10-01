<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class productController extends Controller
{
    private $category, $product, $productImage;

    public function __construct(Category $category, Product $product, ProductImage $productImage)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
    }

    public function index(){
        $categories = $this->category->get();
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index', compact('products','categories'));
    }

    public function create(){
        $categories = $this->category->get();
        return view('admin.product.add', compact('categories'));
    }

    public function store(AddProductRequest $request){

        $dataProduct = [
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'content' => $request->contents
        ];

        //upload 1 anh
        if ($request->hasFile('feature_image_path')){
            $file_image = $request->feature_image_path;
            $file_image_name = $file_image->getClientOriginalName();
            $file_image_name_hash = str_random(20). '.' . $file_image->getClientOriginalExtension();
            $file_image_path = $request->file('feature_image_path')->storeAs('public/product', $file_image_name_hash);
            $data = [
                'file_name' => $file_image_name,
                'file_path' => Storage::url($file_image_path)
            ];
        }

        if (!empty($data)){
            $dataProduct['feature_image_path'] = $data['file_path'];
            $dataProduct['feature_image_name'] = $data['file_name'];
        }

        $product = $this->product->create($dataProduct);



        //upload nhieu anh
        if ($request->hasFile('image_path')){
            foreach ($request->image_path as $file_multiple_image){
                $file_multiple_image_name = $file_multiple_image->getClientOriginalName();
                $file_multiple_image_name_hash = str_random(20). '.' . $file_multiple_image->getClientOriginalExtension();
                $file_multiple_image_path = $file_multiple_image->storeAs('public/product', $file_multiple_image_name_hash);
                $data_multiple = [
                    'file_multiple_name' => $file_multiple_image_name,
                    'file_multiple_path' => Storage::url($file_multiple_image_path)
                ];
                // su dung relationship create anh chi tiet
                $product->images()->create([
                    'image_path' => $data_multiple['file_multiple_path'],
                    'image_name' => $data_multiple['file_multiple_name']
                ]);
//                ProductImage::create([
//                    'product_id' => $product->id,
//                    'image_path' => $data_multiple['file_multiple_path'],
//                    'image_name' => $data_multiple['file_multiple_name']
//                ]);
            }
        }

        return redirect()->route('products.index');
    }

    public function edit($id){
        $categories = $this->category->get();
        $product = $this->product->find($id);
        return view('admin.product.edit', compact('categories', 'product'));
    }

    public function update($id, UpdateProductRequest $request){

        $dataProductUpdate = [
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'content' => $request->contents
        ];

        //upload 1 anh
        if ($request->hasFile('feature_image_path')){
            $file_image = $request->feature_image_path;
            $file_image_name = $file_image->getClientOriginalName();
            $file_image_name_hash = str_random(20). '.' . $file_image->getClientOriginalExtension();
            $file_image_path = $request->file('feature_image_path')->storeAs('public/product', $file_image_name_hash);
            $data = [
                'file_name' => $file_image_name,
                'file_path' => Storage::url($file_image_path)
            ];
        }

        if (!empty($data)){
            $dataProductUpdate['feature_image_path'] = $data['file_path'];
            $dataProductUpdate['feature_image_name'] = $data['file_name'];
        }

        $product = $this->product->find($id)->update($dataProductUpdate);
        $product_update = $this->product->find($id);


        //upload nhieu anh
        if ($request->hasFile('image_path')){
            $this->productImage->where('product_id', $id)->delete();
            foreach ($request->image_path as $file_multiple_image){
                $file_multiple_image_name = $file_multiple_image->getClientOriginalName();
                $file_multiple_image_name_hash = str_random(20). '.' . $file_multiple_image->getClientOriginalExtension();
                $file_multiple_image_path = $file_multiple_image->storeAs('public/product', $file_multiple_image_name_hash);
                $data_multiple_update = [
                    'file_multiple_name' => $file_multiple_image_name,
                    'file_multiple_path' => Storage::url($file_multiple_image_path)
                ];
                // su dung relationship create anh chi tiet
                $product_update->images()->create([
                    'image_path' => $data_multiple_update['file_multiple_path'],
                    'image_name' => $data_multiple_update['file_multiple_name']
                ]);
//                ProductImage::create([
//                    'product_id' => $product_update->id,
//                    'image_path' => $data_multiple_update['file_multiple_path'],
//                    'image_name' => $data_multiple_update['file_multiple_name']
//                ]);
            }
        }

        return redirect()->route('products.index');
    }

    public function delete($id){
        $this->product->find($id)->delete();
        return redirect()->route('products.index');
    }

    public function search(Request $request){
        $categories = $this->category->get();
        $query = $this->product->query();
        if (!empty($request->search)){
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }if (!empty($request->category_id)){
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(5);
        return view('admin.product.search', compact('products','categories'));

    }
}
