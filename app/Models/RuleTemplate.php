<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'rule_text',
        'category',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Scope untuk rule yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk kategori tertentu
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope untuk ordering
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('rule_text');
    }

    /**
     * Rules yang menggunakan template ini
     */
    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    /**
     * Homestays yang menggunakan rule ini
     */
    public function homestays()
    {
        return $this->hasManyThrough(Homestay::class, Rule::class);
    }
}