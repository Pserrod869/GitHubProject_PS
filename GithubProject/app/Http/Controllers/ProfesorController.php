<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfesorController extends Controller
{
    public function index(): View
    {
        return view('profesor.index', ['profesores' => Profesor::all()]);
    }

    public function create(): View
    {
        return view('profesor.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $profesor = Profesor::create($request->validate($this->rules()));

        return redirect()->route('profesor.show', $profesor);
    }

    public function show(Profesor $profesor): View
    {
        return view('profesor.show', ['profesor' => $profesor]);
    }

    public function edit(Profesor $profesor): View
    {
        return view('profesor.edit', ['profesor' => $profesor]);
    }

    public function update(Request $request, Profesor $profesor): RedirectResponse
    {
        $profesor->update($request->validate($this->rules()));

        return redirect()->route('profesor.show', $profesor);
    }

    public function destroy(Profesor $profesor): RedirectResponse
    {
        $profesor->delete();

        return redirect()->route('profesor.index');
    }

    private function rules(): array
    {
        return [
            'nombre' => 'required|string|min:2|max:100',
            'apellido' => 'required|string|min:3|max:130',
            'fecha_alta' => 'required|date',
            'especialidad' => 'required|string|max:150',
            'salario' => 'required|numeric|gte:0|decimal:0,2',
        ];
    }
}
