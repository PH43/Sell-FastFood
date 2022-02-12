<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Mail;
class orderAdminController extends Controller
{
    private $order,$orderDetail;
    public function __construct(Order $order, OrderDetail $orderDetail)
    {
        $this->orderDetail = $orderDetail;
        $this->order = $order;
    }

    public function index(){
        $orders = $this->order->latest()->paginate(5);
        return view('admin.order.index', compact('orders'));
    }

    public function change_status($id){
        $order = $this->order->find($id);
        $order_details = $this->orderDetail->where('order_id', $order->id)->get();
        return view('admin.order.change_status',compact('order','order_details'));
    }

    public function send_mail_confirm($id,Request $request){
        $order = $this->order->find($id);
        if ($request->has('order_note')){
            $order_note = $request->order_note;
        }else{
            $order_note = '';
        }
        $order->update([
            'status' => 'Đơn hàng đã duyệt',
            'order_note' => $request->order_note
        ]);
        $from_mail = "lcminh10121999@gmail.com";
        $from_name = "Shop FastFood";
        $to_mail = $order->email;
        $order_details = $this->orderDetail->where('order_id', $order->id)->get();
        Mail::send('admin.order.send_mail_confirm',[
            'order' => $order,
            'order_details' => $order_details,
            'order_note' => $order_note,
            'status' => 'Bạn đã đặt hàng thành công thành công'
        ], function ($mail) use ( $from_mail,$from_name,$to_mail){
            $mail->to($to_mail);
            $mail->from($from_mail,$from_name);
            $mail->subject('Đã duyệt đơn đặt hàng');
        });
        return redirect()->back()->with('message_confirm_order', 'Đơn hàng đã duyệt và gửi email cho khách hàng');
    }

    public function show_form_reject($id){
        $order = $this->order->find($id);
        $order_details = $this->orderDetail->where('order_id', $order->id)->get();
        return view('admin.order.form_reject_order', compact('order','order_details'));
    }

    public function send_mail_reject($id,Request $request){
        $order =  $this->order->find($id);
        if ($request->has('order_note')){
            $order_note = $request->order_note;
        }else{
            $order_note = '';
        }
        $order->update([
            'status' => 'Đơn hàng đã hủy',
            'order_note' => $request->order_note
        ]);
        $from_mail = "lcminh10121999@gmail.com";
        $from_name = "Shop FastFood";
        $to_mail = $order->email;
        $order_details = $this->orderDetail->where('order_id', $order->id)->get();
        Mail::send('admin.order.send_mail_confirm',[
            'order' => $order,
            'order_details' => $order_details,
            'order_note' => $order_note,
            'status' => 'Đơn hàng của bạn đã bị hủy'
        ], function ($mail) use ( $from_mail,$from_name,$to_mail){
            $mail->to($to_mail);
            $mail->from($from_mail,$from_name);
            $mail->subject('Đã hủy đơn đặt hàng');
        });
        return redirect()->back()->with('message_reject_order', 'Đơn hàng đã hủy và gửi email cho khách hàng');
    }

    public function ship($id){
        $order =  $this->order->find($id);
        if ($order->status == 'Đơn hàng đã duyệt'){
            $order->update([
                'status' => 'Đơn hàng đã giao',
            ]);
            return response()->json([
                'massage' => 'success',
                'code' => 200
            ],200);
        }else{
            return response()->json([
                'massage' => 'fail',
                'code' => 500
            ],500);
        }
    }

    public function delete($id){
        $order = $this->order->find($id);
        if ($order->status !== 'Đơn hàng đã duyệt'){
            $this->order->find($id)->delete();
            return response()->json([
                'massage' => 'success',
                'code' => 200
            ],200);
        }else{
            return response()->json([
                'massage' => 'fail',
                'code' => 500
            ],500);
        }

    }

    public function search(Request $request){
        $status = $request->status;
        $search_value = $request->search;
        $query = $this->order->query();
        if ($request->has('search')){
            $query->whereRaw(\DB::raw('(name LIKE ? or email LIKE ?)'),['%'.$search_value.'%' ,'%'.$search_value.'%']);
        }
        if ($request->has('status')){
            $query->where('status', 'LIKE', '%' . $status . '%' );
        }
        $orders = $query->paginate(5)->appends(['search' => $search_value, 'status' => $status]);
        return view('admin.order.search', compact('orders', 'status', 'search_value'));
    }
}
