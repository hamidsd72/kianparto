<?php

namespace App\Http\Requests\Operation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OperationTopContentSpecificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'operation_content_id'  => 'required|integer',
                    'title'                 => 'required|max:250',
                    // 'title' => 'required|max:200|unique:operation_top_contents',
                    // 'photo' => "nullable|image|mimes:jpeg,jpg,png|max:2048",
                ];
            }
            case 'PATCH':
            {
                $id=$this->request->get('id');

                return [
                    'title' => 'required|max:250',
                    // 'title' => 'required|max:200|unique:operation_top_contents,title,'.$id,
                    // 'photo' => "nullable|image|mimes:jpeg,jpg,png|max:2048",
                ];
            }
            default:
                break;
        }
    }
}
