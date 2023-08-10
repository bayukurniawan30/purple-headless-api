<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Media extends Model
{
    use HasFactory, Userstamps;
    use \App\Traits\UuidTrait;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'file_name',
        'title',
        'description',
        'type',
        'most_used_colors',
        'file_size',
    ];
}
