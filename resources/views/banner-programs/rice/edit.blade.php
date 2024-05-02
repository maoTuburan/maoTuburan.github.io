<x-app-layout>
	<div class="pagetitle mb-4">
		<h1>Rice Program</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i></a></li>
				<li class="breadcrumb-item"><a href="{{ route('bannerPrograms') }}">Banner Program</a></li>
				<li class="breadcrumb-item"><a href="{{ route('rices.index') }}">Rice Program</a></li>
				<li class="breadcrumb-item active">Create</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="row">
			<div class="col-lg-8">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Add Farmer</h5>

						<!-- Multi Columns Form -->
						<form class="row g-3" method="POST" action="{{ route('rices.update', $rice) }}">
							@csrf
							@method('PUT')

							<div class="col-md-12">
								<div class="form-floating mb-3">
									<select class="form-control @error('farmer_name') is-invalid @enderror" id="farmer_name"
										name="farmer_name" aria-label="farmer_name" data-live-search="true" title="Select Farmer" disabled>
											<option value="{{ $selectedFarmerName }}">{{ $selectedFarmerName }}</option>
									</select>
									@error('farmer_name')
									<x-input-error message="{{ $message }}" />
									@enderror
									<label for="floatingSelect">Farmer Name</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-floating mb-3">
									<select class="form-control @error('farmer_barangay') is-invalid @enderror" id="farmer_barangay"
										name="farmer_barangay" aria-label="Farmer Barangays" data-live-search="true" title="Choose Barangay" required>
										@foreach (config('constants.barangays') as $barangays)
										<option value="{{ $barangays }}" {{ old('barangays')|| $rice->farmer_barangay==$barangays ? 'selected' : '' }}>
											{{ $barangays }}
										</option>
										@endforeach
									</select>
									@error('farmer_barangay')
									<x-input-error message="{{ $message }}" />
									@enderror
									<label for="floatingSelect">Barangays</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-floating mb-3">
									<textarea class="form-control" placeholder="Details Here..." name="farm_details" id="floatingTextarea" style="height: 100px;">{{ $rice->farm_details }}</textarea>
									<label for="floatingTextarea">Farm Details</label>
								</div>
							</div>

							<x-insurance.status-update :insuranceStatus="$insuranceStatus" />

							<div class="text-start">
								<a href="{{ route('rices.index') }}" class="btn btn-secondary">Back</a>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form><!-- End Multi Columns Form -->

					</div>
				</div>
			</div>
		</div>
	</section>
</x-app-layout>
