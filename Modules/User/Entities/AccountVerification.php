<?php
namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;

class AccountVerification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'code',
        'is_used',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'code' => 'integer',
        'is_used' => 'boolean',
    ];

    /**
     * Get the user assossiated to this verification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
