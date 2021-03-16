<?php

namespace App\Http\Controllers\Api\Resturant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Resturant\CreateOfferRequest;
use App\Http\Requests\Api\Resturant\CreateProductRequest;
use App\Http\Requests\Api\Resturant\EditOfferRequest;
use App\Http\Requests\Api\Resturant\EditProductRequest;
use App\Http\Requests\Api\Resturant\EditProfileRequest;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showProducts(Request $request)
    {
        $products = Product::where('resturant_id', $request->user()->id)->paginate(10);
        return responseJson(1, 'Success', $products);
    }

    public function createProducts(CreateProductRequest $request)
    {
        $product = $request->user()->products()->create($request->all());
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('uploads/products', $image_new_name);
            $product->image = 'uploads/products/' . $image_new_name;
        }

        return responseJson(1, 'Success', $product);
    }

    public function editProducts(EditProductRequest $request)
    {
        $product = $request->user()->products()->find($request->id);
        if ($product) {
            $product->update($request->except('image'));
            if ($request->hasFile('image')) {
                $image = $request->image;
                $image_new_name = time() . $image->getClientOriginalName();
                $image->move('uploads/products', $image_new_name);
                $product->image = 'uploads/products/' . $image_new_name;
            }
            return responseJson(1, 'Updated', $product);
        } else {
            return responseJson(0, 'Product not found');
        }
    }

    public function deleteProducts(Request $request)
    {
        $model = $request->user()->products()->find($request->id);
        $model->delete();
        return responseJson(1, 'Deleted Successfully');
    }

    public function profile(Request $request)
    {
        $profile = $request->user();
        return responseJson(1, 'Success', $profile);
    }

    public function editProfile(EditProfileRequest $request)
    {
        $profile = $request->user();
        if ($profile) {
            $profile->update($request->except('image'));
            if ($request->hasFile('image')) {
                $image = $request->image;
                $image_new_name = time() . $image->getClientOriginalName();
                $image->move('uploads/resturants', $image_new_name);
                $profile->image = 'uploads/resturants/' . $image_new_name;
            }
            if ($request->has('password')) {
                $profile->password = bcrypt($request->password);
            }
            $categories = $profile->categories()->sync($request->categories);
            return responseJson(
                1,
                'Profile Updated Successfully',
                [
                    'resturant' => $profile,
                    'categories' => $categories,
                ]
            );
        }
    }

    public function offers(Request $request)
    {
        $offer = $request->user()->offers()->paginate(10);
        return responseJson(1, 'Success', $offer);
    }

    public function createOffer(CreateOfferRequest $request)
    {
        $offer = $request->user()->offers()->create($request->all());
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('uploads/offers', $image_new_name);
            $offer->image = 'uploads/offers/' . $image_new_name;
        }

        return responseJson(1, 'Offers Added Successfully', $offer);
    }

    public function deleteOffers(Request $request)
    {
        $model = $request->user()->offers()->find($request->id);
        $model->delete();
        return responseJson(1, 'Deleted Successfully');
    }

    public function editOffer(EditOfferRequest $request)
    {
        $offers = $request->user()->offers()->find($request->id);
        if ($offers) {
            $offers->update($request->except('image'));
            if ($request->hasFile('image')) {
                $image = $request->image;
                $image_new_name = time() . $image->getClientOriginalName();
                $image->move('uploads/offerss', $image_new_name);
                $offers->image = 'uploads/offerss/' . $image_new_name;
            }
            return responseJson(1, 'Updated', $offers);
        } else {
            return responseJson(0, 'offers not found');
        }
    }

    public function newOrders(Request $request)
    {
        $orders = $request->user()->orders()->where('order_state', 'pending')->get();
        if ($orders) {
            return responseJson(1, 'Success', $orders);
        } else {
            return responseJson(0, 'No Orders');
        }
    }

    public function currentOrders(Request $request)
    {
        $orders = $request->user()->orders()->where('order_state', 'accepted')->get();
        if ($orders) {
            return responseJson(1, 'Success', $orders);
        } else {
            return responseJson(0, 'No Orders');
        }
    }

    public function pastOrders(Request $request)
    {
        $orders = $request->user()->orders()
            ->whereIn('order_state', ['delivered', 'declined', 'rejected'])->get();
        if ($orders) {
            return responseJson(1, 'Success', $orders);
        } else {
            return responseJson(0, 'No Orders');
        }
    }

    public function acceptOrders(Request $request)
    {
        $order = $request->user()->orders()->find($request->id);
        if ($order->order_state == 'pending') {
            $orders = $order->update(
                ['order_state' => 'accepted']
            );

            $client = $order->client;
            $notification = $client->notifications()->create(
                [
                    'title' => 'Your Order Has been Accepted',
                    'content' => 'Restaurant Accepted Your Order ' . $request->user()->name,
                    'order_id' => $request->id,
                    'is_read' => false,
                ]
            );

            $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            $send = null;
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'order_id' => $order->id
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
            }

            $data = [
                'order' => $order->fresh()->load('products')
            ];

            return responseJson(1, 'تم الطلب بنجاح', ['data' => $data, 'send' => $send]);
        }
        return responseJson(0, 'هذا الطلب لا يمكن رفضه');
    }

    public function declineOrders(Request $request)
    {
        $order = $request->user()->orders()->find($request->id);
        if ($order->order_state == 'pending') {
            $orders = $order->update(
                ['order_state' => 'declined']
            );

            $client = $order->client;
            $notification = $client->notifications()->create(
                [
                    'title' => 'Your Order Has been Declined',
                    'content' => 'Restaurant Is Currentlly Busy Try Again Later ' . $request->user()->name,
                    'order_id' => $request->id,
                    'is_read' => false,
                ]
            );

            $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            $send = null;
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'order_id' => $order->id
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
            }

            $data = [
                'order' => $order->fresh()->load('products')
            ];

            return responseJson(1, 'Your Order Has Been Declined', ['data' => $data, 'send' => $send]);
        }
        return responseJson(0, 'This Order Cannot be accepted');
    }

    public function settings(Request $request)
    {
        $settings = Setting::find(1);
        $price = $request->user()->orders()->where('order_state', 'delivered')->sum('price');
        $commission = $price * 0.1;
        $paid = $request->user()->commissions()->sum('paid');
        $remain = $commission - $paid;
        return responsejson(
            1,
            'success',
            [
                'content' => $settings->content,
                'text' => $settings->text,
                'Total' => $price,
                'commission' => $commission,
                'paid' => $paid,
                'remain' => $remain,
            ]
        );
    }
}
