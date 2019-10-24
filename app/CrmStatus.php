<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrmStatus extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'crm_statuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function crmCustomers()
    {
        return $this->hasMany(CrmCustomer::class, 'status_id', 'id');
    }
}
