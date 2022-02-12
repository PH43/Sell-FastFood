<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use App\Rating;
use Illuminate\Http\Request;

class commentAdminController extends Controller
{
    private $rating, $product, $comment;

    public function __construct(Rating $rating, Product $product, Comment $comment)
    {
        $this->comment = $comment;
        $this->rating = $rating;
        $this->product = $product;
    }

    public function index(){
        $comments = $this->comment->join('products', 'products.id' , '=' , 'comments.product_id')
            ->join('ratings' ,'ratings.comment_id' , '=', 'comments.id')
            ->select('products.*', 'ratings.*', 'comments.*')
            ->orderBy('comments.id', 'DESC')
            ->paginate(5);
        return view('admin.comment.index', compact('comments'));
    }

    public function delete($id){
        $this->comment->find($id)->delete();
        return response()->json([
            'massage' => 'success',
            'code' => 200
        ],200);
    }

    public function search(Request $request){
        $product_name = $request->search;
        $rating_value = $request->rating_value;

        $query = $this->comment->query();
        if ($request->has('search') && !empty($product_name)){
            $query->whereHas('products', function($q) use($product_name) {
                $q->where('products.name','LIKE', '%'.$product_name.'%');
            });
        }
       if ($request->has('rating_value') && !empty($rating_value)){
           $query->whereHas('ratting', function($q) use($rating_value) {
               $q->where('ratings.value', $rating_value);
           });
       }

        $comments = $query->orderBy('comments.id', 'DESC')->paginate(5)->appends(['search' => $product_name, 'rating_value' => $rating_value]);;

        return view('admin.comment.search', compact('comments', 'rating_value', 'product_name'));
    }
}
