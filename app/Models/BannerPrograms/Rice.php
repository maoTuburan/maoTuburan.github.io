<?php

namespace App\Models\BannerPrograms;

use App\Models\Farmer\Farmer;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rice extends Model
{
	use HasFactory,HasUuids,SoftDeletes;

	protected $fillable = [
		'farmer_name',
		'farmer_barangay',
		'farm_details',
		'insurance_or_renewal',
	];

	public function farmer()
	{
		return $this->belongsTo(Farmer::class);
	}
}
