<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPruebaRequest;
use App\Http\Requests\StorePruebaRequest;
use App\Http\Requests\UpdatePruebaRequest;
use App\Prueba;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PruebaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Prueba::query()->select(sprintf('%s.*', (new Prueba)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'prueba_show';
                $editGate      = 'prueba_edit';
                $deleteGate    = 'prueba_delete';
                $crudRoutePart = 'pruebas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.pruebas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('prueba_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pruebas.create');
    }

    public function store(StorePruebaRequest $request)
    {
        $prueba = Prueba::create($request->all());

        return redirect()->route('admin.pruebas.index');
    }

    public function edit(Prueba $prueba)
    {
        abort_if(Gate::denies('prueba_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pruebas.edit', compact('prueba'));
    }

    public function update(UpdatePruebaRequest $request, Prueba $prueba)
    {
        $prueba->update($request->all());

        return redirect()->route('admin.pruebas.index');
    }

    public function show(Prueba $prueba)
    {
        abort_if(Gate::denies('prueba_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pruebas.show', compact('prueba'));
    }

    public function destroy(Prueba $prueba)
    {
        abort_if(Gate::denies('prueba_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prueba->delete();

        return back();
    }

    public function massDestroy(MassDestroyPruebaRequest $request)
    {
        Prueba::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
