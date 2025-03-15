<?php

namespace App\Traits;

use App\Services\SlugService;
use Illuminate\Database\Eloquent\Model;

trait HasSlugTrait
{
    public static function bootHasSlugTrait()
    {
        static::creating(function (Model $model) {
            $model->{$model->getSlugColumnName()} = SlugService::generateSlug(
                $model->{$model->getTitleColumnName()},
                $model->getTitleColumnName(),
                $model
            );
        });
    }

    public function getSlugColumnName()
    {
        return static::$slugColiumnName ?? 'slug';
    }

    public function getTitleColumnName()
    {
        return static::$titleColumnName ?? 'title';
    }

    public function initializeHasSlugTrait(): void
    {
        if (!in_array($this->getSlugColumnName(), $this->fillable)) {
            $this->fillable[] = $this->getSlugColumnName();
        }
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return $this->getSlugColumnName();
    }
}
