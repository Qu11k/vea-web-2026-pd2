<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fighter extends Model
{
    protected $fillable = ['name'];

    public function fights(): HasMany
    {
        return $this->hasMany(Fight::class);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => intval($this->id),
            'name' => $this->name,
            'description' => $this->description,
            'fighter' => $this->name,
            'weightclass' => ($this->weightclass ? $this->weightclass->name : ''),
            'year' => intval($this->year),
            'image' => asset('images/' . $this->image),
        ];
    }
}
