<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class SignInRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'required' => ':attribute is required!',
            'email' => ':attribute is invalid!',
        ];
    }

    /**
     * @param Validator $validator
     * @throws HttpResponseException;
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json([
                'errors' => $errors,
                'status' => 400,
            ], Response::HTTP_BAD_REQUEST)
        );
    }
}
