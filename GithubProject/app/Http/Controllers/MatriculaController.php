<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\Modulo;
use Carbon\Carbon;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class MatriculaController extends Controller
{
    private const Messages = [
        'alumno_id.required' => 'El alumno es obligatorio',
        'alumno_id.integer' => 'El alumno no se ha seleccionado bien.',
        'alumno_id.exists' => 'El alumno no existe.',
        'modulo_id.required' => 'El módulo es obligatorio',
        'modulo_id.integer' => 'El módulo no se ha seleccionado bien.',
        'modulo_id.exists' => 'El módulo no existe.',
    ];

    private const RULES = [
        'alumno_id' => ['required', 'integer', 'exists:alumno,id'],
        'modulo_id' => ['required', 'integer', 'exists:modulo,id'],
    ];

    private function getCurso(): int
    {
        if (Carbon::now()->month >= 9) {
            return Carbon::now()->year;
        }

        return Carbon::now()->year - 1;
    }

    private function getCursoEscolar(): string
    {
        return $this->getCurso().'/'.($this->getCurso() + 1);
    }

    public function index(): RedirectResponse
    {
        return redirect()->route('matricula.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('matricula.create', [
            'alumnos' => Alumno::query()->orderBy('apellido')->orderBy('nombre')->get(),
            'curso_escolar' => $this->getCursoEscolar(),
            'modulos' => Modulo::query()->orderBy('nombre')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), self::RULES, self::Messages);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $matricula = new Matricula($validator->validated());
        $matricula->curso = $this->getCurso();

        try {
            $matricula->save();
        } catch (UniqueConstraintViolationException) {
            return back()->withInput()->withErrors([
                'matricula' => "Este alumno ya está matriculado en este módulo durante el curso escolar {$this->getCursoEscolar()}.",
            ]);
        }

        return redirect()
            ->route('matricula.create')
            ->with('success', "Matrícula creada correctamente para el curso escolar {$this->getCursoEscolar()}.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Matricula $matricula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matricula $matricula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matricula $matricula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matricula $matricula)
    {
        //
    }
}
