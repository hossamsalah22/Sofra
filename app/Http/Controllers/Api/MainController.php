<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactUsRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Neighbourhood;
use App\Models\Offer;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Resturant;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function cities()
    {
        $model = City::all();
        return responseJson(1, 'Success', $model);
    }

    public function neighbourhoods(Request $request)
    {
        $model = Neighbourhood::where(
            function ($q) use ($request) {
                if ($request->has('city_id')) {
                    $q->where('city_id', $request->city_id);
                }
            }
        )->get();
        return responseJson(1, 'Success', $model);
    }

    public function categories()
    {
        $model = Category::all();
        return responseJson(1, 'Success', $model);
    }

    public function products()
    {
        $model = Product::all();
        return responseJson(1, 'Success', $model);
    }

    public function reviews(Request $request)
    {
        $model = Review::where('resturant_id', $request->resturant_id)->paginate(10);
        return responseJson(1, 'Success', $model);
    }

    public function resturants(Request $request)
    {
        $model = Resturant::where(
            function ($query) use ($request) {
                if ($request->has('city_id')) {
                    $query->whereHas(
                        'neighbourhood',
                        function ($q) {
                            $q->where('city_id', request()->city_id);
                        }
                    );
                }
                if ($request->has('name')) {
                    $query->where('name', 'like', '%' . $request->name . '%');
                }
            }
        )->get();
        return responseJson(1, 'success', $model);
    }

    public function aboutResturant(Request $request)
    {
        $model = Resturant::where('id', $request->id)->get();
        return responseJson(1, 'Success', $model);
    }

    public function contactus(ContactUsRequest $request)
    {
        $model = Contact::create($request->all());
        return responseJson(1, 'Thank you for your message we will reply soon', $model);
    }

    public function offers()
    {
        $model = Offer::paginate(10);
        return responseJson(1, 'Success', $model);
    }

    public function settings() {
        $settings = Setting::find(1);
        return responseJson(1, 'Success', ['about_us' => $settings->about_us]);
    }

    public function paymentMethod() {
        $model = PaymentMethod::all();
        return responseJson(1, 'Success', $model);
    }
}
