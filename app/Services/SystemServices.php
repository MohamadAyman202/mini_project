<?php

namespace App\Services;

use App\Events\SendNotifications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SystemServices
{
    /*
    * @param mixed $model is required (datatype = object)
    * @param mixed $data is required (datatype = array)
    * @param mixed $msg is required (datatype = string)
    * @param mixed $route is not required (datatype = string)
    * @param mixed $request not required (pass only useing save photo)
    */
    public static function createSystem(object $model, array $data, string $msg, string $route = null, $request = null)
    {
        try {

            if (!is_null($request) && $request->hasFile('photo')) {
                $photo_name = time() . '.' . $request->file('photo')->extension();
                $data['photo'] = "uploads/$msg/$photo_name";
                $request->file('photo')->move(public_path("uploads/$msg"), $photo_name);
            }

            $count_slug = $model->where('slug', $data['slug'])->count();

            if ($count_slug != 0) {
                $data['slug'] = $data['slug'] . '-' . time();
            }

            $status = $model->create($data);

            if ($status) {
                // self::event_notifications($status);
                session()->flash('success', "Successfully Created $msg");
                return  $route ? redirect()->route($route) : redirect()->back();
            }
            session()->flash('error', "Not Successfully Created $msg");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /*
    * @param mixed $model is required (datatype = object)
    * @param mixed $slug is required (datatype = string)
    * @param mixed $data is required (datatype = array)
    * @param mixed $msg is required (datatype = string)
    * @param mixed $route is not required (datatype = string)
    * @param mixed $request not required (pass only useing save photo)
    */
    public static function editSystem(object $model, string $slug, array $data, string $msg, string $route = null, $request = null)
    {
        try {
            $get_data = $model->where('slug', $slug);
            if (!is_null($get_data->first())) {

                if (!is_null($request) && $request->hasFile('photo')) {
                    if (!is_null($get_data->first()->photo)) {
                        unlink($get_data->first()->photo);
                    }
                    $photo_name = time() . '.' . $request->file('photo')->extension();
                    $data['photo'] = "uploads/$msg/$photo_name";
                    $request->file('photo')->move(public_path("uploads/$msg"), $photo_name);
                }

                $data['admin_id'] = auth()->user()->id;
                if ($get_data->count() > 1) {
                    $data['slug'] = $slug . '-' . time();
                }


                $status = $get_data->first()->fill($data)->save();

                if ($status) {
                    session()->flash('success', "Successfully Updated $msg");
                    return  !is_null($route) ? redirect()->route($route) : redirect()->back();
                }
                session()->flash('error', "Not Successfully Updated $msg");
                return redirect()->back();
            }
            session()->flash('error', "Not Found Data");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /*
    * @param mixed $model is required (datatype = object)
    * @param mixed $slug is required (datatype = string)
    * @param mixed $msg is required (datatype = string)
    */

    function deleteSystem(object $model, string $slug, string $msg)
    {
        try {
            $data = $model->where('slug', $slug)->first();

            if ($data) {
                if (!is_null($data->photo)) {
                    unlink($data->photo);
                }
                $status = $data->delete();
                if ($status) {
                    session()->flash('success', "Successfully Deleted $msg");
                    return redirect()->back();
                }
                session()->flash('error', "Not Successfully Deleted $msg");
                return redirect()->back();
            }
            session()->flash('error', "Not Found Data");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    // public static function event_notifications($data)
    // {
    //     if (Route::currentRouteName() == 'product_store') return new SendNotifications($data);
    // }
}
