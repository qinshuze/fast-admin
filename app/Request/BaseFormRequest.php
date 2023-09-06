<?php
declare(strict_types=1);


namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

abstract class BaseFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function __get($name)
    {
        return $this->validated()[$name] ?? null;
    }
}