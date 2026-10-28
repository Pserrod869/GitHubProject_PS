<?php

namespace App\Http\Controllers;

use Illuminate\Database\UniqueConstraintViolationException;
use App\Models\Alumno;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlumnoController extends Controller
{
    public function create(): View
    {
        //
        return view('alumno.create', []);
    }

    public function destroy(Alumno $alumno): RedirectResponse
    {
        $alumno->delete();

        return redirect()->route('alumno.index');
    }

    public function edit(Alumno $alumno): View
    {
        //
        return view('alumno.edit', ['alumno'=>$alumno]);
    }

    private static function getRules(): array
    {
        return [
            'nombre' => 'required|string|max:100|min:2',
            'apellido' => 'required|string|max:130|min:3',
            'fnac' => 'nullable|date|before_or_equal:today',
            'genero' => 'nullable|in:hombre,femenino,otro',
            'notaacceso' => 'nullable|numeric|gte:0|lte:10|decimal:0,2',
        ];
    }

    public function index(): View
    {
        return view('alumno.index', ['alumnos' => Alumno::all()]);
    }

    public function show(Alumno $alumno): View
    {
        //
        return view('alumno.show', ['alumno'=>$alumno]);
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = self::getRules();
        $messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
            'nombre.min' => 'El nombre debe tener al menos 2 caracteres.',
            'apellido.required' => 'Los apellidos son obligatorios.',
            'apellido.string' => 'Los apellidos deben ser una cadena de texto.',
            'apellido.max' => 'Los apellidos no pueden tener más de 130 caracteres.',
            'apellido.min' => 'Los apellidos deben tener al menos 3 caracteres.',
            'fnac.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'fnac.before_or_equal' => 'La fecha de nacimiento no puede ser posterior a hoy.',
            'genero.in' => 'Selecciona un género válido.',
            'notaacceso.numeric' => 'La nota de acceso debe ser un número.',
            'notaacceso.gte' => 'La nota de acceso debe ser como mínimo 0.',
            'notaacceso.lte' => 'La nota de acceso no puede ser mayor que 10.',
            'notaacceso.decimal' => 'La nota de acceso debe tener como máximo 2 decimales.',
        ];

        $validatedData = $request->validate($rules, $messages);
        $alumno = new Alumno($validatedData);

        try {
            $alumno->save();
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'claveunica' => 'Ya existe un alumno con ese nombre y apellido.',
            ]);
        }

        return redirect()->route('alumno.index')->with('success', 'Alumno creado correctamente.');
    }

    public function update(Request $request, Alumno $alumno): RedirectResponse
    {
        $validatedData = $request->validate(self::getRules());

        try {
            $alumno->update($validatedData);
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'claveunica' => 'Ya existe un alumno con ese nombre y apellido.',
            ]);
        }

        return redirect()->route('alumno.index')->with('success', 'Alumno actualizado correctamente.');
    }
}
