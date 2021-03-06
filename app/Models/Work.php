<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Work
 *
 * @property int $id
 * @property string $slug
 * @property array $title
 * @property array $body
 * @property array|null $description
 * @property int $type_id
 * @property int $in_slideshow
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $preview
 * @property-read mixed $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\WorkType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work inSlideshow()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work whereInSlideshow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Work whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Work extends Model implements HasMedia
{
    use Sluggable, HasMediaTrait, HasTranslations;

    protected $fillable = [
        'slug',
        'title',
        'body',
        'description',
        'type_id',
        'in_slideshow',
        'url'
    ];

    protected $with = [
        'type',
    ];

    protected $translatable = [
        'title',
        'body',
        'description'
    ];

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(WorkType::class);
    }

    /**
     * @return string
     */
    public function getPreviewAttribute()
    {
        return optional($this->getFirstMedia('preview'))->getFullUrl('medium');
    }

    public function scopeInSlideshow()
    {
        return $this->where('in_slideshow', 1);
    }

    /**
     * Register conversions for images
     */
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('preview')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('small')
                    ->keepOriginalImageFormat()
                    ->width(620)
                    ->height(620)
                    ->nonOptimized();
                $this
                    ->addMediaConversion('medium')
                    ->keepOriginalImageFormat()
                    ->width(1920)
                    ->height(1920)
                    ->nonOptimized();
            });

        $this
            ->addMediaCollection('work')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('large')
                    ->keepOriginalImageFormat()
                    ->width(1920)
                    ->height(1920)
                    ->nonOptimized();
            });
    }

    /**
     * Boot
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('ordered', function (Builder $builder) {
            $builder->latest();
        });
    }
}
