<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Rating;
use Illuminate\Http\Request;
use App\Slider;
use Illuminate\Support\Facades\Log;
use Cart;
use DB;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $product, $category, $order, $orderDetail, $rating, $comment;
    public function __construct(Product $product, Category $category, Order $order, OrderDetail $orderDetail, Rating $rating, Comment $comment)
    {
        $this->product = $product;
        $this->category = $category;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->rating = $rating;
        $this->comment = $comment;
    }

    public function index()
    {
        $products =  $this->product->latest()->paginate(6);
        $categories = $this->category->get();
        return view('home.home',compact('products','categories'));
    }

    public function category_product($id){
        $categories = $this->category->get();
        $category_product = $this->category->find($id);
        $products = $this->product->where('category_id' , $id)->latest()->paginate(6);
        return view('home.category_product',compact('products','categories', 'category_product'));
    }

    public function product_detail($id){

        $ratings = $this->rating->where('product_id' , $id)->get()->count();

        $sum_rating = $this->rating->sum('value');

        if(empty($ratings) || empty($sum_rating)){
            $avg_rating = null;
        }else{
            $avg_rating = $sum_rating / $ratings;
        }



        if (!empty($avg_rating)){
            $show_rating = $avg_rating;
        }else{
            $show_rating = null;
        }

//        $ratings_1 = $this->rating->where('product_id' , $id)->where('value', 1)->get()->count();
//        $ratings_2 = $this->rating->where('product_id' , $id)->where('value', 2)->get()->count();
//        $ratings_3 = $this->rating->where('product_id' , $id)->where('value', 3)->get()->count();
//
//        if (!empty($ratings)){
//            if (!empty($ratings_1)){
//                $percentages_1 = ($ratings_1 / $ratings ) * 100;
//                $ratings_1_count = $ratings_1;
//            }else{
//                $percentages_1 = 0 ;
//                $ratings_1_count = 0;
//            }
//            if (!empty($ratings_2)){
//                $percentages_2 = ($ratings_2 / $ratings ) * 100;
//                $ratings_2_count = $ratings_2;
//            }else{
//                $percentages_2 = 0 ;
//                $ratings_2_count = 0;
//            }
//            if (!empty($ratings_3)){
//                $percentages_3 = ($ratings_3 / $ratings ) * 100;
//                $ratings_3_count = $ratings_3;
//            }else{
//                $percentages_3 = 0 ;
//                $ratings_3_count = 0;
//            }
//
//            $max = $percentages_1;
//            $show_rating = 1;
//            $ratings_count = $ratings_1_count;
//
//            if ($max <= $percentages_2){
//                $max = $percentages_2;
//                $show_rating = 2;
//                $ratings_count = $ratings_2_count;
//            }
//            if ($max <= $percentages_3){
//                $max = $percentages_3;
//                $show_rating = 3;
//                $ratings_count = $ratings_3_count;
//            }
//        }else{
//            $max = null;
//            $show_rating = null;
//            $ratings_count = null;
//        }
        $comments = $this->comment->where('product_id', $id)->latest()->paginate(5);


        $categories = $this->category->get();
        $product = $this->product->find($id);

        return view('home.product_detail',compact('product','categories',  'show_rating','comments','ratings'));
    }

    public function show_cart(){
        return view('home.cart');
    }

    public function add_to_cart(Request $request){
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $product = $this->product->where('id',$product_id )->first();

        $value['id'] = $product_id;
        $value['qty'] = $quantity;
        $value['name'] = $product->name;
        $value['price'] = $product->price;
        $value['weight'] = '111';
        $value['options']['image'] = $product->feature_image_path;
        $carts = Cart::content();
        $cart = $carts->where('id', $product_id)->first();
        if ($quantity <= 0){
            return redirect()->route('homes.product_detail' ,['id' => $product_id])
                ->with('message_cart_error' , 'Số lượng sản phẩm đặt phải là số và không được nhỏ hơn 1');
        }
        if ($cart == NULL && $quantity > 10){
            return redirect()->route('homes.product_detail' ,['id' => $product_id])
                ->with('message_cart_error' , 'Số lượng sản phẩm đặt không được quá 10');
        }
        if ($cart == NULL && $quantity < 11){
            Cart::add($value);
            return redirect()->route('homes.product_detail' ,['id' => $product_id])
                ->with('message_cart' , 'Thêm sản phẩm vào giỏ hàng thành công');
        }
        if (($cart->qty + $quantity > 10)){
            return redirect()->route('homes.product_detail' ,['id' => $product_id])
                ->with('message_cart_error' , 'Tổng số lượng sản phẩm đặt và sản phẩm đã có trong giỏ hàng không được quá 10');
        }
        if (($cart->qty +$quantity < 11)){
            Cart::add($value);
            return redirect()->route('homes.product_detail' ,['id' => $product_id])
                ->with('message_cart' , 'Thêm sản phẩm vào giỏ hàng thành công');
        }

    }



    public function delete_cart($id){
        Cart::remove($id);
        return redirect()->back()->with('message_cart_delete' , 'Xóa sản phẩm thành công');
    }

    public function update_cart_qty($id, Request $request){
        $qty = $request->quantity;
        if ($qty <= 0){
            return redirect()->back()
                ->with('message_cart_update_error' , 'Số lượng phải là số và lớn hơn 1');
        }
        if ($qty > 10){
            return redirect()->back()
                ->with('message_cart_update_error' , 'Số lượng phải là số và không được lớn hơn 10');
        }
        if ($qty < 11){
            Cart::update($id, $qty);
            return redirect()->back()
                ->with('message_cart_update_success' , 'Cập nhật số lượng thành công');
        }
    }

    public function checkout(Request $request){

        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'address' => ['required'],
            'phone' => ['required','numeric'],

        ],
            [
                'name.required' => 'Tên không được trống',
                'email.required' => 'Email không được trống',
                'address.required' => 'Địa chỉ không được trống',
                'phone.required' => 'Số điện thoại không được trống',
                'phone.numeric' => 'Số điện thoại phải là số',
            ]
        );
        try {
            DB::beginTransaction();

            $order = $this->order->create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'status' => 'Chờ duyệt',
            ]);
            $carts = Cart::content();

            if (!$carts->isEmpty()){
                foreach ($carts as $cart){
                    $this->orderDetail->create([
                        'quantity' => $cart->qty,
                        'price' => $cart->price,
                        'order_id' => $order->id,
                        'product_id' => $cart->id,
                    ]);
                }
            }else{
                return redirect()->back()
                    ->with('message_cart_update_error' , 'Chưa có sản phẩm');
            }


            foreach ($carts as $cart){
                Cart::remove($cart->rowId);
            }

            DB::commit();
            return redirect()->back()->with('message_cart_update_success' , 'Đặt hàng thành công');

        }
        catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message'.$exception->getMessage() . 'Line'. $exception->getLine());
        }
    }

    public function search_home(Request $request){
        $value_search = $request->search;
        $categories = $this->category->get();
        $products = $this->product->where('name', 'LIKE', '%'.$value_search. '%')
            ->paginate(6)->appends(['search' => $value_search]);;
        return view('home.search_home', compact('categories','products', 'value_search'));
    }

    public function comment(Request $request){
        $product_id = $request->product_id;
        $rating_value = $request->rating_value;
        $comment_value = $request->comment_value;
        $name_comment = $request->name_comment.'.'.str_random(32);

        if (!empty($comment_value)){
            $comment = $this->comment->create([
                'product_id' => $product_id,
                'comment_value' => $comment_value,
                'name_comment' => $name_comment
            ]);

            $comment_id = $comment->id;
        }else{
            $comment_id = null;
        }


        $this->rating->create([
            'product_id' => $product_id,
            'comment_id' => $comment_id,
            'value' => $rating_value
        ]);

        return redirect()->back();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
