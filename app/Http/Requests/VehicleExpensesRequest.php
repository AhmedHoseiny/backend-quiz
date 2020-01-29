<?php

namespace App\Http\Requests;

use App\Enums\SortDirectionsEnums;
use App\Enums\VehiclesExpensesSortByEnums;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class VehicleExpensesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sort_by' => ['nullable', Rule::in(VehiclesExpensesSortByEnums::$sortBy)],
            'sort_direction' => ['nullable', Rule::in(SortDirectionsEnums::$sortDirection)],
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors()->all()));
    }
}
