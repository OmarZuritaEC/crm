<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePruebaRequest;
use App\Http\Requests\UpdatePruebaRequest;
use App\Http\Resources\Admin\PruebaResource;
use App\Prueba;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PruebaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('prueba_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PruebaResource(Prueba::all());
    }

    public function store(StorePruebaRequest $request)
    {
        $prueba = Prueba::create($request->all());

        return (new PruebaResource($prueba))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Prueba $prueba)
    {
        abort_if(Gate::denies('prueba_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PruebaResource($prueba);
    }

    public function update(UpdatePruebaRequest $request, Prueba $prueba)
    {
        $prueba->update($request->all());

        return (new PruebaResource($prueba))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Prueba $prueba)
    {
        abort_if(Gate::denies('prueba_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prueba->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
