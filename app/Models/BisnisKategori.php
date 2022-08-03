<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BisnisKategori extends Model
{
    use HasFactory;
    protected $table        = 'business_needs';
    protected $fillable     = ['stuffId', 'businessId', 'name', 'description'];
    protected $primaryKey   = 'stuffId';
    protected $keyType      = 'int';
    public $incrementing    = true;
    public $timestamps      = false;
}
