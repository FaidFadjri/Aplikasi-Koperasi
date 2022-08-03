<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BisnisModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable     = ['businessId', 'nameOfBusiness', 'descOfBusiness', 'pic'];
    protected $primaryKey   = 'businessId';
    protected $keyType      = 'string';
    protected $table        = 'business';
    public $timestamps      = true;


    public function _getAllBusiness()
    {
        return $this->select('*')->get()->toArray();
    }

    public function _getBusinessById($businessId)
    {
        return $this->select('*')->where('businessId', '=', $businessId)->get()->toArray();
    }
}
