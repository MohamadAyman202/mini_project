<?php

namespace App\Models;

use App\Trait\FunctionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, FunctionsTrait;
    protected $guarded = [];


    public function scopeActive()
    {
        return $this->where('status', 'active');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function Fun($data)
    {
        return self::FormatDate($data);
    }

    public function Status($status)
    {
        return self::ChangeStatus($status);
    }
}
