<?php

namespace App\Services;
use App\Models\Product;

class ProductServices
{

    public static function create(array $data)
    {
        try {
            $count_slug = Product::where('slug', $data['slug'])->count();

            if ($count_slug != 0) {
                $data['slug'] = $data['slug'] . '-' . time();
            }

            $status = Product::create($data);

            if ($status) {
                session()->flash('success', "Successfully Created Product");
                return   redirect()->route('admin.products.index');
            }
            session()->flash('error', "Not Successfully Created Product");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public static function edit(string $slug, array $data)
    {
        try {
            $get_data = Product::where('slug', $slug);

            if ($get_data->first()->photo) unlink($get_data->first()->photo);

            if ($get_data->count() > 1) {
                $data['slug'] = $slug . '-' . time();
            }

            $status = $get_data->first()->fill($data)->save();

            if ($status) {
                session()->flash('success', "Successfully Updated Product");
                return redirect()->route('admin.products.index');
            }
            session()->flash('error', "Not Successfully Updated Product");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    function delete(string $slug)
    {
        try {
            $data = Product::where('slug', $slug)->first();

            if ($data) {

                if ($data->photo) unlink($data->photo);

                $data->delete();

                session()->flash('success', "Successfully Deleted Product");
                return redirect()->back();
            }
            session()->flash('error', "Not Found Data");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }
}
