<?php

namespace App\Http\Controllers\Api\Resturant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Resturant\CreateProductRequest;
use App\Http\Requests\Api\Resturant\EditProductRequest;
use App\Http\Requests\Api\Resturant\EditProfileRequest;
use App\Models\Product;
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
}
