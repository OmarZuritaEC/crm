<?php

namespace App\Http\Requests;

use App\Prueba;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPruebaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('prueba_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pruebas,id',
        ];
    }
}
