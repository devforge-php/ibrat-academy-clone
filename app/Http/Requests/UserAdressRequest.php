<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAdressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'country' => 'nullable|string|max:255',
            'provice' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'local_comunity' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'country.string' => __('Country maydonida faqat matn bo‘lishi kerak.|Поле "Страна" должно содержать только текст.|The "Country" field must contain only text.'),
            'country.max' => __('Country maydoni 255 ta belgidan oshmasligi kerak.|Поле "Страна" не должно превышать 255 символов.|The "Country" field must not exceed 255 characters.'),

            'provice.string' => __('Provice maydonida faqat matn bo‘lishi kerak.|Поле "Область" должно содержать только текст.|The "Provice" field must contain only text.'),
            'provice.max' => __('Provice maydoni 255 ta belgidan oshmasligi kerak.|Поле "Область" не должно превышать 255 символов.|The "Provice" field must not exceed 255 characters.'),

            'district.string' => __('District maydonida faqat matn bo‘lishi kerak.|Поле "Район" должно содержать только текст.|The "District" field must contain only text.'),
            'district.max' => __('District maydoni 255 ta belgidan oshmasligi kerak.|Поле "Район" не должно превышать 255 символов.|The "District" field must not exceed 255 characters.'),

            'local_comunity.string' => __('Local community maydonida faqat matn bo‘lishi kerak.|Поле "Местное сообщество" должно содержать только текст.|The "Local Community" field must contain only text.'),
            'local_comunity.max' => __('Local community maydoni 255 ta belgidan oshmasligi kerak.|Поле "Местное сообщество" не должно превышать 255 символов.|The "Local Community" field must not exceed 255 characters.'),
        ];
    }
}
