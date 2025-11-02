<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
    ];

    /**
     * Get setting value by key (static helper).
     */
    public static function getValue(string $key, $default = null)
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    /**
     * Scope to filter by type if needed.
     */
    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }
}