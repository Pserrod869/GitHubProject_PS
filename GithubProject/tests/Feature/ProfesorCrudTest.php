<?php

namespace Tests\Feature;

use App\Models\Profesor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfesorCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_updates_displays_and_deletes_a_profesor(): void
    {
        $this->get(route('profesor.create'))
            ->assertOk()
            ->assertSee('Crear profesor')
            ->assertSee('Nombre')
            ->assertSee('Apellidos')
            ->assertSee('Fecha de alta')
            ->assertSee('Especialidad')
            ->assertSee('Salario');

        $profesorData = [
            'nombre' => 'Ana',
            'apellido' => 'García López',
            'fecha_alta' => '2026-01-15',
            'especialidad' => 'Matemáticas',
            'salario' => '42500.50',
        ];

        $this->post(route('profesor.store'), $profesorData)
            ->assertRedirect();

        $profesor = Profesor::firstOrFail();
        $this->assertDatabaseHas('profesor', [
            'nombre' => 'Ana',
            'apellido' => 'García López',
            'especialidad' => 'Matemáticas',
            'salario' => '42500.50',
        ]);
        $this->assertSame('2026-01-15', $profesor->fecha_alta->toDateString());

        $this->get(route('profesor.index'))
            ->assertOk()
            ->assertSee('ID')
            ->assertSee('15/01/2026')
            ->assertSee('Ana')
            ->assertSee('García López')
            ->assertSee('Matemáticas')
            ->assertSee('42.500,50');

        $this->get(route('profesor.show', $profesor))
            ->assertOk()
            ->assertSee('Ana García López')
            ->assertSee('Especialidad:')
            ->assertSee('Matemáticas')
            ->assertSee('Fecha de alta:')
            ->assertSee('15/01/2026')
            ->assertSee('Salario:')
            ->assertSee('42.500,50');

        $this->get(route('profesor.edit', $profesor))
            ->assertOk()
            ->assertSee('Editar profesor')
            ->assertSee('Nombre')
            ->assertSee('Apellidos')
            ->assertSee('Fecha de alta')
            ->assertSee('Salario');

        $this->put(route('profesor.update', $profesor), [
            ...$profesorData,
            'nombre' => 'Ana María',
            'especialidad' => 'Física',
            'salario' => '44000.00',
        ])->assertRedirect(route('profesor.show', $profesor));

        $this->assertDatabaseHas('profesor', [
            'id' => $profesor->id,
            'nombre' => 'Ana María',
            'apellido' => 'García López',
            'especialidad' => 'Física',
            'salario' => '44000.00',
        ]);

        $this->delete(route('profesor.destroy', $profesor))
            ->assertRedirect(route('profesor.index'));

        $this->assertDatabaseMissing('profesor', ['id' => $profesor->id]);
    }

    public function test_it_rejects_invalid_profesor_data(): void
    {
        $this->from(route('profesor.create'))
            ->post(route('profesor.store'), [
                'nombre' => '',
                'apellido' => 'X',
                'fecha_alta' => 'not-a-date',
                'especialidad' => '',
                'salario' => '-1',
            ])
            ->assertRedirect(route('profesor.create'))
            ->assertSessionHasErrors(['nombre', 'apellido', 'fecha_alta', 'especialidad', 'salario']);

        $this->assertDatabaseCount('profesor', 0);
    }
}
