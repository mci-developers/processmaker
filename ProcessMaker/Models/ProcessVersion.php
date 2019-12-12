<?php

namespace ProcessMaker\Models;

use Illuminate\Database\Eloquent\Model;
use ProcessMaker\Traits\HasCategories;

/**
 * ProcessVersion is used to store the historical version of a process.
 *
 * @property string id
 * @property string bpmn
 * @property string name
 * @property string process_category_id
 * @property string process_id
 * @property string status
 * @property string start_events
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 *
 */
class ProcessVersion extends Model
{
    use HasCategories;

    const categoryClass = ProcessCategory::class;

    protected $connection = 'processmaker';

    /**
     * Do not automatically set created_at
     */
    const CREATED_AT = null;

    /**
     * Attributes that are not mass assignable.
     *
     * @var array $fillable
     */
    protected $guarded = [
        'id',
        'updated_at',
    ];

    protected $casts = [
        'start_events' => 'array',
        'warnings' => 'array',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * BPMN data will be hidden. It will be able by its getter.
     *
     * @var array
     */
    protected $hidden = [
        'bpmn'
    ];

    /**
     * Set multiple|single categories to the process
     *
     * @param string $value
     */
    public function setProcessCategoryIdAttribute($value)
    {
        return $this->setMultipleCategories($value, 'process_category_id');
    }
}
