<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrgAgricultureRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'farmer_name' => ['required', 'string'],
			'farmer_barangay' => ['required', 'string'],
			'crop_information' => ['required', 'string', 'max:255'],
			'livestock_details' => ['required', 'string', 'max:255'],
			'insurance_or_renewal' => ['required', 'string'],
		];
	}
}
