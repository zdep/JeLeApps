<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsValidPassword;
use App\Http\Controllers\ApiController;

class UsersRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'unique:users,email|email:rfc,dns|max:255',
            'password' => 'min:6',
            'gender' => 'required|in:М,Ж',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
			/*'name.required' => 'Поле "Имя" обязательно для заполнения',
			'email.required' => 'Поле "email" обязательно для заполнения',
			'name.max' => 'Количество символов в поле "Имя" не может превышать 255',
			'email.max' => 'Количество символов в поле "email" не может превышать 255',
			'email.unique' => 'Такой "email" уже существует',
			'phone.max' => 'Количество символов в поле "Телефон" не может превышать 20',*/
        ];
    }

	/**
	 * Configure the validator instance.
	 *
	 * @param  \Illuminate\Validation\Validator  $validator
	 * @return void
	 */
	public function withValidator($validator)
	{
		$validator->after(function ($validator) {
            if ($validator->errors()->all()) {
                $message = $validator->errors()->first();

                abort(
                    $message
                    ? response()->json(
                        [
                            'error' => 10,
                            'error_text' => $message,
                        ],
                        400,
                        [
                            'Content-Type' => 'application/json; charset=UTF-8',
                            'Charset' => 'utf-8',
                        ],
                        JSON_UNESCAPED_UNICODE
                    )
                    : response(null, 400)
                );
            }
		});
	}
}
