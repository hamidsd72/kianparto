<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SliderRequest extends FormRequest
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
                    // 'title1' => 'required|max:75',
                    // 'title2' => 'required|max:75',
                    'text' => 'nullable|max:300',
                    'link' => "nullable|url",
                    'photo' => "required|image|mimes:jpeg,jpg,png|max:2048",
                ];
            }
            case 'PATCH':
            {
                $id=$this->request->get('id');
                return [
                    // 'title1' => 'required|max:75',
                    // 'title2' => 'required|max:75',
                    'text' => 'nullable|max:300',
                    'link' => "nullable|url",
                    'photo' => "nullable|image|mimes:jpeg,jpg,png|max:2048",
                ];
            }
            default:
                break;
        }
    }
}
