<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreAlumnoTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_an_alumno_using_the_database_column_names(): void
    {
        $response = $this->post(route('alumno.store'), [
            'nombre' => 'Antonio',
            'apellido' => 'Alba',
            'fnac' => '2000-01-01',
            'genero' => 'hombre',
            'notaacceso' => '4.00',
        ]);

        $response->assertRedirect(route('alumno.index'));
        $this->assertDatabaseHas('alumno', [
            'nombre' => 'Antonio',
            'apellido' => 'Alba',
            'fnac' => '2000-01-01',
            'genero' => 'hombre',
            'notaacceso' => 4,
        ]);

        $this->get(route('alumno.index'))
            ->assertOk()
            ->assertSee('Alba');
    }

    public function test_it_updates_and_deletes_an_alumno(): void
    {
        $alumno = \App\Models\Alumno::create([
            'nombre' => 'Antonio',
            'apellido' => 'Alba',
            'fnac' => '2000-01-01',
            'genero' => 'hombre',
            'notaacceso' => '4.00',
        ]);

        $this->put(route('alumno.update', $alumno), [
            'nombre' => 'Antonio',
            'apellido' => 'Alba',
            'fnac' => '2000-01-01',
            'genero' => 'hombre',
            'notaacceso' => '8.50',
        ])->assertRedirect(route('alumno.index'));

        $this->assertDatabaseHas('alumno', [
            'id' => $alumno->id,
            'notaacceso' => 8.5,
        ]);

        $this->delete(route('alumno.destroy', $alumno))
            ->assertRedirect(route('alumno.index'));

        $this->assertDatabaseMissing('alumno', ['id' => $alumno->id]);
    }

    public function test_it_rejects_invalid_alumno_data(): void
    {
        $this->from(route('alumno.create'))
            ->post(route('alumno.store'), [
                'nombre' => '',
                'apellido' => 'A',
                'fnac' => 'not-a-date',
                'genero' => 'invalid',
                'notaacceso' => 11,
            ])
            ->assertRedirect(route('alumno.create'))
            ->assertSessionHasErrors(['nombre', 'apellido', 'fnac', 'genero', 'notaacceso']);

        $this->assertDatabaseCount('alumno', 0);
    }
}
