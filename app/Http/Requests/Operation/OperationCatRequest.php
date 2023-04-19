<?php

namespace App\Http\Requests\Operation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OperationCatRequest extends FormRequest
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
                    'title' => 'required|max:200',
                    // |unique:operation_cats',
                    'photo' => "nullable|image|mimes:jpeg,jpg,png|max:2048",
                ];
            }
            case 'PATCH':
            {
                $id=$this->request->get('id');

                return [
                    'title' => 'required|max:200',
                    // |unique:operation_cats,title,'.$id,
                    'photo' => "nullable|image|mimes:jpeg,jpg,png|max:2048",
                ];
            }
            default:
                break;
        }
    }
}
