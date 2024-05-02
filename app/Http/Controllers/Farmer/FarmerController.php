<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Farmer\Farmer;
use App\Http\Requests\StoreFarmerRequest;
use App\Http\Requests\UpdateFarmerRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FarmerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{

		return view('farmer.index');
	}

	public function showTable()
	{
		if (request()->ajax()) {
			$farmers = Farmer::select('id', 'name', 'gender', 'banner_program', 'barangay')->get();

			return DataTables::of($farmers)
			->addColumn('action', 'farmer.table-buttons')
			->rawColumns(['action'])
			->toJson();
		}
	}
	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('farmer.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreFarmerRequest $request)
	{
		$data = $request->validated();

		$farmers = new Farmer();
		$farmers->name = $data['name'];
		$farmers->gender = $data['gender'];
		$farmers->banner_program = $data['banner_program'];
		$farmers->barangay = $data['barangays'];
		$farmers->save();

		toast('Farmer has been created successfully!','success');
		return redirect()->route('farmers.index');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Farmer $farmer)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Farmer $farmer)
	{
		return view('farmer.edit',compact('farmer'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateFarmerRequest $request, Farmer $farmer)
	{
		$data = $request->validated();

		$farmer->name = $data['name'];
		$farmer->gender = $data['gender'];
		$farmer->banner_program = $data['banner_program'];
		$farmer->barangay = $data['barangays'];
		$farmer->save();

		toast('Farmer has been updated successfully!','success');
		return redirect()->route('farmers.index');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Farmer $farmer)
	{
		if(request()->ajax()) {
			$farmer->delete();

			return response()->json([
				'status' => true,
				'message' => 'Farmer has been deleted successfully!',
			]);
		}
	}
}
