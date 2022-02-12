<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use App\Rating;
use Illuminate\Http\Request;

class ratingAdminController extends Controller
{
    private $rating, $product, $comment;

    public function __construct(Rating $rating, Product $product, Comment $comment)
    {
        $this->comment = $comment;
        $this->rating = $rating;
        $this->product = $product;
    }

    public function index(){
        $ratings = $this->rating->join('products', 'products.id' , '=' , 'ratings.product_id')
            ->join('comments' ,'comments.id', '=', 'ratings.comment_id')
            ->select('products.*', 'ratings.*', 'comments.*')->get();

        return view('admin.rating.index', compact('ratings'));
    }
}
