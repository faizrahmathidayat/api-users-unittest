<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ApiResponser;
use App\Models\User;

/**
 * @OA\Schema(
 *     schema="UserRequest",
 *     type="object",
 *     required={"name", "email", "age"},
 *     @OA\Property(property="name", type="string", example="Faiz Rahmat Hidayat"),
 *     @OA\Property(property="email", type="string", format="email", example="faizrahmat.hidayat06@gmail.com"),
 *     @OA\Property(property="age", type="integer", example=30)
 * )
*/

class UserStoreUpdateRequest extends FormRequest
{
    use ApiResponser;
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
        $userId = $this->route('id');

        if ($userId && !User::find($userId)) {
            abort($this->errorResponse('Data tidak ditemukan', 404));
        }

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'age' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return array(
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute sudah digunakan.',
            'numeric' => ':attribute harus berupa angka.',
            'min' => ':attribute minimal :min Tahun.',
            'exists' => ':attribute tidak ditemukan.',
        );
    }

    public function attributes()
    {
        return array(
            'name' => 'Nama',
            'email' => 'Email',
            'age' => 'Usia',
        );
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse('Data yang diberikan tidak valid', 422, $validator->errors()));
    }
}
