<?php

declare(strict_types=1);

namespace Modules\Media\Models;

// use Spatie\MediaLibrary\Models\Media as BaseMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Lang\Models\Traits\LinkedTrait;
use Modules\Xot\Traits\Updater;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia; // spatie tags
use Spatie\ModelStatus\HasStatuses;
use Spatie\Tags\HasTags;

/**
 * Undocumented class.
 */
class SpatieImage extends BaseMedia {
    use Updater;

    // use Searchable;
    // use Cachable;
    use HasFactory;
    use HasTags; // spatie tags
    use HasStatuses; //spatie status
    use HasDomains;
    use LinkedTrait;
    /**
     * Indicates whether attributes are snake cased on arrays.
     *
     * @see  https://laravel-news.com/6-eloquent-secrets
     *
     * @var bool
     */
    // public static $snakeAttributes = true;

    protected $perPage = 30;

    protected $fillable = [
        'id', 'model_type', 'model_id', 'uuid', 'collection_name', 'name',
        'file_name', 'mime_type', 'disk', 'conversions_disk', 'size',
        'manipulations',
        'custom_properties', 'generated_conversions', 'responsive_images',
        'order_column', 'user_id',
        'time_from', 'time_to',
        'created_at', 'updated_at', 'created_by', 'updated_by',
        'title', 'subtitle', 'guid',
    ];

    protected $appends = [
        'original_url', 'preview_url',
        'title', 'subtitle',
    ];

    //protected $with = ['tags:id,name'];
    protected $with = ['tags'];

    protected $table = 'spatie_images';

    /**
     * Undocumented function.
     */
    public function getVideoUrlAttribute(?string $value): ?string {
        return url('/streamsnip/'.$this->id);
    }
}
