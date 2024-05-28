<?php

namespace App\Models;

use App\Models\Scopes\ActiveDataScope;
use App\Trait\FunctionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, FunctionsTrait, Notifiable;
    protected $guarded = [];

    public function scopeActive()
    {
        return $this->where('status', 'active');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }


    public function Fun($data)
    {
        return self::FormatDate($data);
    }

    public function Status($status)
    {
        return self::ChangeStatus($status);
    }

    // protected static function booted() {
    //     static::addGlobalScope(new ActiveDataScope);
    // }
}