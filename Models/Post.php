<?php

namespace Modules\Blog\Models;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Vite;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{

    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $table = 'posts';

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'content',
        'tags',
        'photo',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    protected $appends = [
        'photo_url',
        'photo_thumbnail_url',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getPhotoUrlAttribute(): string
    {
        $photoExists = $this->getMedia('posts')->first();

        if ($photoExists) return $photoExists->getUrl();

        return Vite::asset('resources/img/photo-placeholder.svg');
    }

    public function getPhotoThumbnailUrlAttribute(): string
    {
        $photoExists = $this->getMedia('thumbnail')->first();

        if ($photoExists) return $photoExists->getUrl();

        return Vite::asset('resources/img/photo-placeholder.svg');
    }

    public function getPublishedAtFormattedAttribute()
    {
        return Carbon::parse($this->published_at)->format('M d, Y');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('post-media')
            ->nonQueued();

        $this->addMediaConversion('thumbnail')
            ->fit(Manipulations::FIT_CROP, 1000, 700)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('posts')
            ->useFallbackUrl(resource_path('img/photo-placeholder.svg'))
            ->useFallbackPath(resource_path('img/photo-placeholder.svg'))
            ->singleFile();
    }
}
