<?php

namespace App\Models\Farmer;

use App\Models\BannerPrograms\Corn;
use App\Models\BannerPrograms\Fishery;
use App\Models\BannerPrograms\HighValueCrop;
use App\Models\BannerPrograms\Livestock;
use App\Models\BannerPrograms\OrgAgriculture;
use App\Models\BannerPrograms\Rice;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Farmer extends Model
{
  use HasFactory,HasUuids,SoftDeletes;

	protected $fillable = [
		'name',
		'gender',
		'banner_program',
		'barangay',
	];

	public function CornProgram()
	{
		return $this->belongsTo(Corn::class);
	}

	public function RiceProgram()
	{
		return $this->belongsTo(Rice::class);
	}

	public function HighValueCropsProgram()
	{
		return $this->belongsTo(HighValueCrop::class);
	}

	public function OrgAgricultureProgram()
	{
		return $this->belongsTo(OrgAgriculture::class);
	}

	public function FisheryProgram()
	{
		return $this->belongsTo(Fishery::class);
	}

	public function LivestockProgram()
	{
		return $this->belongsTo(Livestock::class);
	}
}
