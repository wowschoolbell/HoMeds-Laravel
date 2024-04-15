<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class QuizStoreRequest extends FormRequest
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
    public function rules(Request $request)
    {
            $rules['type']     = "required";
            $rules['question'] = "required|string|max:255";
            $rules['course'] = "required|string|max:255";
            $rules['curriculam'] = "required|string|max:255";
            $rules['point']    = "required|numeric|not_in:0";

            $rules['quiz_option.0.is_correct']    = function ($attribute, $value, $fail) use ($request) {
                $isCorrect = collect($request->quiz_option)->where('is_correct', 1)->toArray();

                if (empty($isCorrect)) {
                    $fail('Choose the correct options.');
                }
            };
            $rules['quiz_option.*.option'] = "required|distinct";

            return $rules;
    }

    public function messages()
    {
        $messages['question.required'] = 'The question field is required.';
        $messages['question.max']      = 'The question may not be greater than 255 characters.';
        $messages['type.required']     = 'The question field is required.';

        $r_key = 1;
        foreach(request()->quiz_option ? : [] as $key => $option)
        {
            $messages['quiz_option.'.($key).'.option.required'] = 'Option field is required in Row '.($r_key);
            $r_key++;
        }


        $d_key = 1;
        foreach(request()->quiz_option ? : [] as $key => $option)
        {
            $messages['quiz_option.'.($key).'.option.distinct'] = 'Option field is duplicate in Row '.($d_key);
            $d_key++;
        }

        $messages['point.required']    = 'The point field is required.';
        $messages['point.numeric']     = 'The point field must be number.';
        $messages['point.not_in']      = 'The point field must not be 0.';

        return $messages;
    }
}
