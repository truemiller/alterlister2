<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    //
    protected $table = 'publishers';
    protected $fillable = [
        "title",
        "slug",
        "link_1",
        "logo"
    ];

    public function entities(){
        return $this->hasMany(Entity::class);
    }


}
