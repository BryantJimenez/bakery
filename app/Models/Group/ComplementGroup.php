<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

class ComplementGroup extends Model
{
    protected $table = 'complement_group';

    protected $fillable = ['price', 'state', 'complement_id', 'group_id'];
}
