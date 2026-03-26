<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Note extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'notes';

    protected $primaryKey = 'id';

    //public $timestamps = false;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'status',
        'is_pinned',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'note_category')->withTimestamps();
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function publish(): bool
    {
        $this->status = 'published';
        return $this->save();
    }

    public function archive(): bool
    {
        $this->status = 'archived';
        return $this->save();
    }

    public function pin(): bool
    {
        $this->is_pinned = true;
        return $this->save();
    }

    public function unpin(): bool
    {
        $this->is_pinned = false;
        return $this->save();
    }

    public static function searchPublished(string $q, int $limit = 20)
    {
        $q = trim($q);

        return static::query()
            ->where('status', 'published')
            ->where(function (Builder $x) use ($q) {
                $x->where('title', 'like', "%{$q}%")
                    ->orWhere('body', 'like', "%{$q}%");
            })
            ->orderByDesc('updated_at')
            ->limit($limit)
            ->get();
    }

}
