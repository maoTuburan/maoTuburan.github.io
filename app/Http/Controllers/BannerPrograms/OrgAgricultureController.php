<?php

namespace App\Http\Controllers\BannerPrograms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrgAgricultureRequest;
use App\Http\Requests\UpdateOrgAgricultureRequest;
use App\Models\BannerPrograms\OrgAgriculture;
use App\Models\Farmer\Farmer;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class OrgAgricultureController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return view('banner-programs.org-agriculture.index');
	}


	public function showTable()
	{
		if(request()->ajax()) {
			$orgAgricultures = OrgAgriculture::join('farmers as farmer', 'farmer.id', '=', 'org_agricultures.farmer_name')
			->select('org_agricultures.id', 'farmer.name as farmer_name', 'org_agricultures.farmer_barangay', 'org_agricultures.crop_information', 'org_agricultures.livestock_details', 'org_agricultures.insurance_or_renewal');

			return DataTables::of($orgAgricultures)
			->filterColumn('farmer_name', function ($query, $keyword) {
				$query->where('farmer.name', 'like', "%{$keyword}%");
			})
			->addColumn('action','banner-programs.org-agriculture.table-buttons')
			->rawColumns(['action'])
			->toJson();
		}
	}
	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$farmers = Farmer::where('banner_program', 'Organic Agriculture Program')->get();
		return view('banner-programs.org-agriculture.create',compact('farmers'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreOrgAgricultureRequest $request)
	{
		$data = $request->validated();

		$organic_agricultures = new OrgAgriculture();
		$organic_agricultures->farmer_name = $data['farmer_name'];
		$organic_agricultures->farmer_barangay = $data['farmer_barangay'];
		$organic_agricultures->crop_information = $data['crop_information'];
		$organic_agricultures->livestock_details = $data['livestock_details'];
		$organic_agricultures->insurance_or_renewal = $data['insurance_or_renewal'];
		$organic_agricultures->save();

		toast('Farmer for Organic Agriculture Program created successfully', 'success');
		return redirect()->route('organic-agricultures.index');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(OrgAgriculture $orgAgriculture)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(OrgAgriculture $organic_agriculture)
	{
		$selectedFarmer = Farmer::where('id', $organic_agriculture->farmer_name)->first();
		$selectedFarmerName = (string)$selectedFarmer->name;

		$insuranceStatus = $organic_agriculture->insurance_or_renewal;
		return view('banner-programs.org-agriculture.edit', compact('organic_agriculture', 'selectedFarmerName', 'insuranceStatus'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateOrgAgricultureRequest $request, OrgAgriculture $organic_agriculture)
	{
		$data = $request->validated();

		$organic_agriculture->farmer_barangay = $data['farmer_barangay'];
		$organic_agriculture->crop_information = $data['crop_information'];
		$organic_agriculture->livestock_details = $data['livestock_details'];
		$organic_agriculture->insurance_or_renewal = $data['insurance_or_renewal'];
		$organic_agriculture->save();

		toast('Farmer for Organic Agriculture Program updated successfully', 'success');
		return redirect()->route('organic-agricultures.index');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(OrgAgriculture $organic_agriculture)
	{
		if(request()->ajax()) {
			$organic_agriculture->delete();

			return response()->json([
				'success' => true,
				'message' => 'Farmer for Organic Agriculture Program has been deleted',
			],Response::HTTP_OK);
		}
	}
}
