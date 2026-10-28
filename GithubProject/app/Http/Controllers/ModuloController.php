<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ModuloController extends Controller
{
    public function index(): View
    {
        // $modulos = Modulo::all();
        // return view('modulo.index', ['modulos' => $modulos]);
        $modulos = Modulo::orderBy('nombre')->get();

        return view('modulo.index', compact('modulos'));
    }

    public function create(): View
    {
        return view('modulo.create');
    }

    private function validationRules(?Modulo $modulo = null): array
    {
        return [
            'abreviatura' => [
                'required',
                'string',
                'max:7',
                Rule::unique('modulo', 'abreviatura')->ignore($modulo),
            ],
            'creditos' => ['nullable', 'numeric', 'min:0', 'max:99.99'],
            'horas' => ['nullable', 'integer', 'min:0', 'max:15'],
            'nombre' => [
                'required',
                'string',
                'max:120',
                Rule::unique('modulo', 'nombre')->ignore($modulo),
            ],
        ];
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate($this->validationRules());

        try {
            Modulo::create($datos);

            return redirect()
                ->route('modulo.index')
                ->with('success', 'Módulo creado correctamente.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'No se pudo guardar el módulo. Comprueba que el nombre y la abreviatura no estén repetidos.']);
        }
    }

    public function show(string $id): View
    {
        $modulo = Modulo::find($id);
        if ($modulo == null) {
            abort(404);
        }

        return view('modulo.show', compact('modulo'));
    }

    public function showV2(string $id): View|RedirectResponse
    {
        $modulo = Modulo::find($id);
        if ($modulo == null) {
            return redirect()
                ->route('modulo.index')
                ->withErrors(['error' => 'Módulo no encontrado.']);
        }

        return view('modulo.show', compact('modulo'));
    }

    public function edit(Modulo $modulo): View
    {
        return view('modulo.edit', compact('modulo'));
    }

    public function update(Request $request, Modulo $modulo): RedirectResponse
    {
        $datos = $request->validate($this->validationRules($modulo));

        try {
            $modulo->update($datos);

            return redirect()
                ->route('modulo.index')
                ->with('success', 'Módulo actualizado correctamente.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'No se pudo actualizar el módulo. Comprueba que el nombre y la abreviatura no estén repetidos.']);
        }
    }

    public function destroy(Modulo $modulo): RedirectResponse
    {
        try {
            $modulo->delete();

            return redirect()
                ->route('modulo.index')
                ->with('success', 'Módulo eliminado correctamente.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'No se pudo eliminar el módulo.']);
        }
    }
}
