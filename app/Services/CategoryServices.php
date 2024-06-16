<?php

namespace App\Services;
use App\Models\Category;

class CategoryServices
{

    public static function create(array $data)
    {
        try {
            $count_slug = Category::where('slug', $data['slug'])->count();

            if ($count_slug != 0) {
                $data['slug'] = $data['slug'] . '-' . time();
            }

            $status = Category::create($data);

            if ($status) {
                session()->flash('success', "Successfully Created Category");
                return   redirect()->route('admin.category.index');
            }
            session()->flash('error', "Not Successfully Created Category");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public static function edit(string $slug, array $data)
    {
        try {
            $get_data = Category::where('slug', $slug);

            if ($get_data->first()->photo) unlink($get_data->first()->photo);

            if ($get_data->count() > 1) {
                $data['slug'] = $slug . '-' . time();
            }

            $status = $get_data->first()->fill($data)->save();

            if ($status) {
                session()->flash('success', "Successfully Updated Category");
                return redirect()->route('admin.category.index');
            }
            session()->flash('error', "Not Successfully Updated Category");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    function delete(string $slug)
    {
        try {
            $data = Category::where('slug', $slug)->first();

            if ($data) {

                if ($data->photo) unlink($data->photo);

                $data->delete();

                session()->flash('success', "Successfully Deleted Category");
                return redirect()->back();
            }
            session()->flash('error', "Not Found Data");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }
}
