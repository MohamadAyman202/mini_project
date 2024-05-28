<?php

namespace App\Trait;

use Carbon\Carbon;

trait FunctionsTrait
{
    public static function ChangeStatus($status): string
    {
        return match ($status) {
            'active'    => "btn btn-primary btn-sm",
            'inactive'  => "btn btn-danger btn-sm",
            default     => "Not Found",
        };
    }


    public static function CheckWorkingStatus($work_status): string
    {
        return match ($work_status) {
            "working"   => "btn btn-primary btn-sm",
            "enddate"   => "btn btn-warning btn-sm",
            "error"     => "btn btn-danger btn-sm",
            default     => "Not Found",
        };
    }

    public static function checkValuePayment($val): string
    {
        if ($val == null) {
            return "Success";
        }
        return "Failed";
    }

    public static function checkColorPayment($val): string
    {
        if ($val == null) {
            return "btn btn-primary btn-sm";
        }
        return "btn btn-danger btn-sm";
    }

    public static function FormatDate($date): string
    {
        return Carbon::parse($date)->format('Y-m-d g:i:s A');
    }

    public static function count_data()
    {
        return env('PAGINATE_COUNT');
    }
}
