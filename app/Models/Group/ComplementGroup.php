<?php

namespace App\Models\Group;

use App\Models\Complement;
use Illuminate\Database\Eloquent\Model;

class ComplementGroup extends Model
{
    protected $table = 'complement_group';

    protected $fillable = ['price', 'state', 'complement_id', 'group_id'];

    public function complement() {
        return $this->belongsTo(Complement::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
