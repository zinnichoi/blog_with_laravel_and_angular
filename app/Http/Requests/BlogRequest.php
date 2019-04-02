<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            return [
                'title' => 'required|unique:blogs|max:100',
                'content' => 'required',
                'blog_thumbnail' => 'required|max:100',
                'age_limit' => 'required|numeric|min:0|max:100',
                'gender_limit' => 'required|numeric|min:0|max:2',
            ];
        }
        if ($this->isMethod('PUT')) {
            $exploredUrl = explode("/", $this->url());
            $id = end($exploredUrl);
            return [
                'title' => 'required|max:100|unique:blogs,title,' . $id,
                'content' => 'required',
                'blog_thumbnail' => 'required|max:100',
                'age_limit' => 'required|numeric|min:0|max:100'
            ];
        }
    }

    /**
     * Convert json data input to array
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->json()->all();
    }

    /**
     * Customize when failed will not redirect
     *
     * @param Validator $validator
     * @return array|void
     */
    protected function failedValidation(Validator $validator)
    {
        return $validator->errors()->all();
    }

    /**
     * Check validation is failed or not
     *
     * @return bool
     */
    public function isFailed()
    {
        return $this->validator->fails();
    }

    /**
     * Return error message array
     *
     * @return array
     */
    public function getErrorMessage()
    {
        return $this->validator->errors()->all();
    }
}
