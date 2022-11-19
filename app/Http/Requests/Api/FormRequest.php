<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    // 确定用户是否有权提出此请求。
    public function authorize()
    {
        return true;
    }
}
