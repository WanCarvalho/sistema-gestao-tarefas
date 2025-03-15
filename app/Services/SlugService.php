<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugService
{
    public static function generateSlug($title, $titleColumnName, Model $model)
    {
        if ($model::withoutGlobalScopes()->whereSlug($slug = Str::slug($title))->exists()) {
            $max = $model::withoutGlobalScopes()->where($titleColumnName, $title)->latest('id')->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }

            return "{$slug}-2";
        }
        return $slug;
    }
}
