<?php

namespace Tests\Feature;

use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\Modulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MatriculaTest extends TestCase
{
    use RefreshDatabase;

    public function test_enrollment_section_opens_the_registration_form_without_a_list(): void
    {
        $this->get(route('matricula.index'))
            ->assertRedirect(route('matricula.create'));

        $this->get(route('matricula.create'))
            ->assertOk()
            ->assertSee('Selecciona un alumno')
            ->assertSee('Selecciona un módulo')
            ->assertDontSee('No hay matrículas registradas.')
            ->assertDontSee('<table', false);
    }

    public function test_enrollment_form_lists_existing_students_and_classes_for_school_year(): void
    {
        Alumno::create([
            'nombre' => 'Lucía',
            'apellido' => 'García',
        ]);
        Modulo::create([
            'nombre' => 'Desarrollo web',
            'abreviatura' => 'DW',
        ]);

        $this->get(route('matricula.create'))
            ->assertOk()
            ->assertSee('Curso: 2026/2027')
            ->assertSee('García, Lucía')
            ->assertSee('Desarrollo web (DW)');
    }

    public function test_enrollment_is_saved_for_the_selected_student_and_class(): void
    {
        $alumno = Alumno::create([
            'nombre' => 'Lucía',
            'apellido' => 'García',
        ]);
        $modulo = Modulo::create([
            'nombre' => 'Desarrollo web',
            'abreviatura' => 'DW',
        ]);

        $this->post(route('matricula.store'), [
            'alumno_id' => $alumno->id,
            'modulo_id' => $modulo->id,
        ])
            ->assertRedirect(route('matricula.create'))
            ->assertSessionHas('success', 'Matrícula creada correctamente para el curso escolar 2026/2027.');

        $this->assertDatabaseHas('matricula', [
            'alumno_id' => $alumno->id,
            'modulo_id' => $modulo->id,
            'curso' => 2026,
        ]);

        $this->get(route('matricula.create'))
            ->assertOk()
            ->assertSee('Matrícula creada correctamente para el curso escolar 2026/2027.')
            ->assertDontSee('No hay matrículas registradas.')
            ->assertDontSee('<table', false);
    }

    public function test_enrollment_rejects_students_or_classes_that_do_not_exist(): void
    {
        $this->from(route('matricula.create'))
            ->post(route('matricula.store'), [
                'alumno_id' => 999,
                'modulo_id' => 999,
            ])
            ->assertRedirect(route('matricula.create'))
            ->assertSessionHasErrors(['alumno_id', 'modulo_id']);

        $this->assertDatabaseCount('matricula', 0);
    }

    public function test_a_student_cannot_be_enrolled_twice_in_the_same_class_and_school_year(): void
    {
        $alumno = Alumno::create([
            'nombre' => 'Lucía',
            'apellido' => 'García',
        ]);
        $modulo = Modulo::create([
            'nombre' => 'Desarrollo web',
            'abreviatura' => 'DW',
        ]);

        Matricula::create([
            'alumno_id' => $alumno->id,
            'modulo_id' => $modulo->id,
            'curso' => 2026,
        ]);

        $this->from(route('matricula.create'))
            ->post(route('matricula.store'), [
                'alumno_id' => $alumno->id,
                'modulo_id' => $modulo->id,
            ])
            ->assertRedirect(route('matricula.create'))
            ->assertSessionHasErrors([
                'matricula' => 'Este alumno ya está matriculado en este módulo durante el curso escolar 2026/2027.',
            ]);

        $this->assertDatabaseCount('matricula', 1);
    }
}
