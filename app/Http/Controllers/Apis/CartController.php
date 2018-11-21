<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\Models\Order;
use App\Models\ItemOrder;
use Cart;

class CartController extends Controller
{
	public function add(Request $request)
	{

		if(!$request->input('product_id')){
			return response()->json([
				'error' => ['Please Provide product id.'],
			],422);
		}
		$product = Product::with('maintenanceService')->where('id',$request->input('product_id'))->first();
		if(!$product){
			return response()->json([
				'error' => ['No product with this id.'],
			],404);
		}
		$qty = $request->input('qty') ? $request->input('qty') : 1;
		$item = Cart::add($product->id,$product->name, $qty,$product->price,['product' => $product]);
		return response()->json([
			'success' => ['Item has been added to cart.'],
		],200);
	}

	public function get()
	{
		$cartArray = [];
		foreach(Cart::content() as $item){
			$cartArray[] = ['row_id'=>$item->rowId,'name'=>$item->name,'qty'=>$item->qty,'price'=>$item->price,'product'=>$item->options->product];
		}
		return response()->json([
			'data' => $cartArray,
		],200);
	}

	public function update(Request $request)
	{
		if(!$request->input('row_id') || !$request->input('qty')){
			return response()->json([
				'error' => ['Please Provide row id and qty.'],
			],422);
		}
		Cart::update($request->input('row_id'), $request->input('qty'));
		return response()->json([
			'success' => ['Item quantity has been updated.'],
		],200);
	}

	public function remove(Request $request)
	{
		if(!$request->input('row_id')){
			return response()->json([
				'error' => ['Please Provide row id.'],
			],422);
		}
		Cart::remove($request->input('row_id'));
		return response()->json([
			'success' => ['Item has been deleted.'],
		],200);
	}

	public function destroy()
	{
		Cart::destroy();
		return response()->json([
			'success' => ['cart has been deleted.'],
		],200);
	}

	public function checkout(Request $request)
	{
		if(Cart::count() == 0){
			return response()->json([
				'error' => ['Your cart is empty.'],
			],422);
		}
		$total_price = 0;
		$data['user_id'] = $request->user()->id;
		$createOrder = Order::create($data);
		foreach (Cart::content() as $item) {
			$createItem = new ItemOrder;
			$createItem->qty = $item->qty;
			$createItem->product_id = $item->id;
			$createItem->price = $item->price;
			$createItem->order_id = $createOrder->id;
			$createItem->save();
			$total_price = $total_price + ($item->qty * $item->price);
		}
		$updateOrder = $createOrder->update(['total_price'=>$total_price]);
		Cart::destroy();
		$tokens = User::where('delivery',1)->where('city_id',$request->user()->city_id)->pluck('device_id')->toArray();
		if($tokens)
			$this->sendRequest('New Request','New Delivery Request . hurry up!!!','order',$createOrder->id,$tokens);
		return response()->json([
			'success' => ['your order has been placed and sent to agents.'],
		],200);
	}

	public function agentAccept(Request $request)
	{
		if(!$request->input('order_id') || !$request->input('status')){
			return response()->json([
				'error' => ['Please Provide order id and status.'],
			],422);
		}
		$checkOrder = Order::where('id',$request->input('order_id'))->first();
		if(!$checkOrder){
			return response()->json([
				'error' => ['No order found with this id.'],
			],404);
		}
		if($checkOrder->agent_id && $checkOrder->status == 2){
			return response()->json([
				'success' => ['an agnet has accepted this order before.'],
			],200);
		}
		$checkOrder->update(['status'=>$request->input('status'),'agent_id'=>$request->user()->id]);

		$this->sendClientRequest($request->input('status'),$checkOrder->user->device_id);
		return response()->json([
			'success' => ['order has been updated.'],
		],200);
	}

	public function orders(Request $request)
	{
		$orders = Order::where('user_id',$request->user()->id)->with('items','agent');
		if($request->input('status'))
			$orders->where('status',$request->input('status'));
		$orders = $orders->get();
		return response()->json([
			'data' => $orders,
		],200);
	}

	public function orderDetails(Request $request)
	{
		if(!$request->input('order_id')){
			return response()->json([
				'error' => ['Please Provide order.'],
			],422);
		}
		$order = Order::where('id',$request->input('order_id'))->with('items','agent')->first();
		return response()->json([
			'data' => $order,
		],200);
	}
}
