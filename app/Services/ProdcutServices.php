<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductsNotifications;
use Illuminate\Support\Facades\Notification;

class ProdcutServices
{
    /*
    * @param mixed $data is required (datatype = array)
    * @param mixed $request not required (pass only useing save photo)
    */
    public static function create(array $data, $request = null)
    {
        try {

            if (!is_null($request) && $request->hasFile('photo')) {
                $photo_name = time() . '.' . $request->file('photo')->extension();
                $data['photo'] = "uploads/Prodcuts/$photo_name";
                $request->file('photo')->move(public_path("uploads/Prodcuts"), $photo_name);
            }

            $count_slug = Product::where('slug', $data['slug'])->count();

            if ($count_slug != 0) {
                $data['slug'] = $data['slug'] . '-' . time();
            }

            $product = Product::create($data);
            if ($product) {
                $customers = User::where('id', '!=', auth()->user()->id)->get();
                Notification::send($customers, new ProductsNotifications($product));
                session()->flash('success', "Successfully Created Product");
                return  redirect()->back();
            }
            session()->flash('error', "Not Successfully Created Product");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /*
    * @param mixed $slug is required (datatype = string)
    * @param mixed $data is required (datatype = array)
    * @param mixed $request not required (pass only useing save photo)
    */
    public static function edit(string $slug, array $data, $request = null)
    {
        try {
            $get_data = Product::where('slug', $slug);
            if (!is_null($get_data->first())) {

                if (!is_null($request) && $request->hasFile('photo')) {
                    if (!is_null($get_data->first()->photo)) {
                        unlink($get_data->first()->photo);
                    }
                    $photo_name = time() . '.' . $request->file('photo')->extension();
                    $data['photo'] = "uploads/Product/$photo_name";
                    $request->file('photo')->move(public_path("uploads/Product"), $photo_name);
                }

                $data['admin_id'] = auth()->user()->id;
                if ($get_data->count() > 1) {
                    $data['slug'] = $slug . '-' . time();
                }


                $product = $get_data->first()->fill($data)->save();

                if ($product) {
                    session()->flash('success', "Successfully Updated Product");
                    return  redirect()->back();
                }
                session()->flash('error', "Not Successfully Updated Product");
                return redirect()->back();
            }
            session()->flash('error', "Not Found Data");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /*
    * @param mixed $slug is required (datatype = string)
    */

    function delete(string $slug)
    {
        try {
            $data = Product::where('slug', $slug)->first();

            if ($data) {
                if (!is_null($data->photo)) {
                    unlink($data->photo);
                }
                $status = $data->delete();
                if ($status) {
                    session()->flash('success', "Successfully Deleted Product");
                    return redirect()->back();
                }
                session()->flash('error', "Not Successfully Deleted Product");
                return redirect()->back();
            }
            session()->flash('error', "Not Found Data");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }
}
