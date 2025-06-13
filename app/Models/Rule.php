<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'homestay_id',
        'rule_template_id',
        'custom_rule_text'
    ];

    /**
     * Relation to homestay
     */
    public function homestay()
    {
        return $this->belongsTo(Homestay::class);
    }

    /**
     * Relation to rule template
     */
    public function ruleTemplate()
    {
        return $this->belongsTo(RuleTemplate::class);
    }

    /**
     * Get final rule text (custom or from template)
     */
    public function getRuleTextAttribute()
    {
        return $this->custom_rule_text ?? $this->ruleTemplate->rule_text;
    }

    /**
     * Get rule category
     */
    public function getCategoryAttribute()
    {
        return $this->ruleTemplate->category;
    }
}
