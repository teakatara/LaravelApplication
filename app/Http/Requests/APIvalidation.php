<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//以下の3行追加
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class APIvalidation extends FormRequest
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
        //内部の2行を追加
        return [
	    'title' => 'String|max:20|required',
	    'content' => 'required|String|between:10,140',
        ];
    }
    //以下の関数を追加
    public function messages()
    {
        return [
	    'title.required'  =>  '項目「タイトル」は入力必須です。',
	    'title.String' => '項目「タイトル」は文字列です。',
	    'title.max' => '項目「タイトル」は20文字までです。',
	    'content.required' => '項目「本文」は入力必須です。',
	    'content.String' => '項目「本文」は文字列です。',
	    'content.between' => '項目「本文」は10～140文字です。',
        ];
    }

    //以下の関数を追加
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['message' => 'Failed validation', 'errors' => $errors,], 422, [], JSON_UNESCAPED_UNICODE));
    }
}
