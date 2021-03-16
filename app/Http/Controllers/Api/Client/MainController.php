<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\EditProfileRequest;
use App\Http\Requests\Api\Client\NewOrderRequest;
use App\Http\Requests\Api\Client\ReviewRequest;
use App\Models\Product;
use App\Models\Resturant;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function profile(Request $request)
    {
        $client = $request->user();
        return responseJson(1, 'Success', $client);
    }

    public function editProfile(EditProfileRequest $request)
    {
        $client = $request->user();
        if ($client) {
            $client->update($request->except('image'));
            if ($request->hasFile('image')) {
                $image = $request->image;
                $image_new_name = time() . $image->getClientOriginalName();
                $image->move('uploads/clients', $image_new_name);
                $client->image = 'uploads/clients/' . $image_new_name;
            }

            if ($request->has('password')) {
                $client->password = bcrypt($request->password);
            }
            return responseJson(
                1,
                'Updated Succesfully',
                [
                    'api_token' => $client->api_token,
                    'client' => $client,
                ]
            );
        }
    }

    // public function newOrder(NewOrderRequest $request)
    // {
    //     $resturant = Resturant::find($request->resturant_id);
    //     if ($resturant->status == 'closed') {
    //         return responseJson(0, 'Sorry restaurant is currentlly Closed');
    //     }

    //     $order = $request->user()->orders()->create(
    //         [
    //             'resturant_id' => $request->resturant_id,
    //             'notes' => $request->notes,
    //             'order_state' => 'pending',
    //             'address' => $request->address,
    //             'payment_method_id' => $request->payment_method_id,
    //         ]
    //     );

    //     $price = 0;
    //     $delivery = $resturant->deliver;
    //     foreach ($request->product as $i) {
    //         $p = Product::find($i['product_id']);
    //         $readyProduct = [
    //             $i['product_id'] => [
    //                 'quantity' => $i['quantity'],
    //                 'price' => $p->price,
    //                 'notes' => (isset($i['notes'])) ? $i['notes'] : ''
    //             ]
    //         ];
    //         $order->products()->attach($readyProduct);
    //         $price += ($p->price * $i['quantity']);
    //     }

    //     if ($price >= $resturant->min_charge) {
    //         $totalprice = $price + $delivery;
    //         $settings = Setting::find(1);
    //         $commission = $settings->commission * $price;
    //         $net = $totalprice - $settings->commission;
    //         $update = $order->update(
    //             [
    //                 'price' => $price,
    //                 'deliver' => $delivery,
    //                 'total_price' => $totalprice,
    //                 'commission' => $commission,
    //                 'net' => $net,
    //             ]
    //         );
    //         $notification = $resturant->notifications()->create(
    //             [
    //                 'title' => 'You Have New Order',
    //                 'content' => 'New Order From ' . $request->user()->name,
    //                 'order_id' => $order->id
    //             ]
    //         );
    //         $tokens = $resturant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
    //         if (count($tokens)) {
    //             $title = $notification->title;
    //             $body = $notification->content;
    //             $data = [
    //                 'order_id' => $order->id
    //             ];
    //             $send = notifyByFirebase($title, $body, $tokens, $data);
    //             $data = [
    //                 'order' => $order->fresh()->load('products')
    //             ];
    //             return responseJson(1, 'success', $data);
    //         }
    //     } else {
    //         $order->items()->delete();
    //         $order->delete();
    //         return responseJson(0, 'Sorry Order Less Than' . $resturant->min_charge . 'Pound');
    //     }
    // }

    public function orderDetails(Request $request)
    {
        $order = $request->user()->orders()->find($request->id);
        if ($order) {
            return responseJson(1, 'Success', $order->load('products'));
        } else {
            return responseJson(0, 'Error');
        }
    }

    public function currentOrders(Request $request)
    {
        $orders = $request->user()->orders()->where('order_state', 'pending')->get();
        if ($orders) {
            return responseJson(1, 'Current Orders', $orders);
        } else {
            return responseJson(0, 'No Orders');
        }
    }

    public function pastOrders(Request $request)
    {
        $orders = $request->user()->orders()
            ->whereIn('order_state', ['rejected', 'declined', 'delivered'])->get();
        if ($orders) {
            return responseJson(1, 'Your Past Orders', $orders);
        } else {
            return responseJson(0, 'Error');
        }
    }

    public function deliveredOrder(Request $request)
    {
        $order = $request->user()->orders()->find($request->id);
        if ($order->order_state == 'accepted') {
            $orders = $order->update(['order_state' => 'delivered']);
            $resturant = $order->resturant;
            $notification = $resturant->notifications()->create(
                [
                    'title' => 'Order Delivered Successfully',
                    'content' => 'Order Recieved By Client ' . $request->user()->name,
                    'order_id' => $request->id,
                    'is_read' => false,
                ]
            );
            $tokens = $resturant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'order_id' => $order->name
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
            }

            $data = [
                'order' => $order->fresh()->load('products')
            ];

            return responseJson(1, 'تم الطلب بنجاح', $data);
        }
        return responsejson(0, 'error');
    }

    public function rejectOrder(Request $request)
    {
        $order = $request->user()->orders()->find($request->id);
        if ($order->order_state == 'accepted' || $order->order_state == 'pending') {
            $orders = $order->update(['order_state' => 'rejected']);
            $resturant = $order->resturant;
            $notification = $resturant->notifications()->create(
                [
                    'title' => 'Order Rejected',
                    'content' => 'Client Refused to take the order ' . $request->user()->name,
                    'order_id' => $request->id,
                    'is_read' => false,
                ]
            );
            $tokens = $resturant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'order_id' => $order->name
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
            }

            $data = [
                'order' => $order->fresh()->load('products')
            ];

            return responseJson(1, 'order Rejected', $data);
        }
        return responsejson(0, 'error');
    }

    public function reviews(ReviewRequest $request) {
        $review = $request->user()->reviews()->create($request->all());
        return responseJson(1, 'Thanks for Review', $review);
    }
}
