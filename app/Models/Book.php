<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
   
    public function rentals()
{
    return $this->hasMany(Rental::class);
}
protected $fillable = [
    'title', 'author', 'genre', 'published_year', 'isbn', 'available',
    'donor', 'donor_phone', 'usage_status', 'image_path',
];

}
