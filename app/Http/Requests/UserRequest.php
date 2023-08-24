<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends BaseRequest
{
    public function rules() : array
    {
        if (empty($meeting)) {
            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => trans('messages.id_is_not_exist'),
            ]));
        }

        return [
            'name' => 'required',
            'email' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (empty ($device)) {
                        return $fail(':attribute không hợp lệ');
                    }
                }
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => explode('@', $this->email)[0],
        ]);
    }
}
