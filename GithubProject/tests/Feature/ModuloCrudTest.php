<?php

namespace Tests\Feature;

use App\Models\Modulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuloCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_updates_displays_and_deletes_a_modulo(): void
    {
        $this->get(route('modulo.create'))
            ->assertOk()
            ->assertSee('Crear módulo')
            ->assertSee('Nombre')
            ->assertSee('Abreviatura')
            ->assertSee('Horas')
            ->assertSee('Créditos')
            ->assertDontSee('Apellidos');

        $moduloData = [
            'nombre' => 'Desarrollo web',
            'abreviatura' => 'DWES',
            'horas' => 6,
            'creditos' => '8.00',
        ];

        $this->post(route('modulo.store'), $moduloData)
            ->assertRedirect();

        $modulo = Modulo::firstOrFail();
        $this->assertDatabaseHas('modulo', $moduloData);

        $this->get(route('modulo.index'))
            ->assertOk()
            ->assertSee('Desarrollo web')
            ->assertSee('DWES')
            ->assertSee('Acciones')
            ->assertDontSee('Apellidos');

        $this->get(route('modulo.show', $modulo))
            ->assertOk()
            ->assertSee('Desarrollo web')
            ->assertSee((string) $modulo->id)
            ->assertSee('DWES')
            ->assertSee('6')
            ->assertSee('8,00')
            ->assertSee('Volver')
            ->assertSee('Editar');

        $this->get(route('modulo.edit', $modulo))
            ->assertOk()
            ->assertSee('Guardar cambios');

        $this->put(route('modulo.update', $modulo), [
            ...$moduloData,
            'nombre' => 'Desarrollo web servidor',
            'horas' => 7,
        ])->assertRedirect(route('modulo.index'));

        $this->assertDatabaseHas('modulo', [
            'id' => $modulo->id,
            'nombre' => 'Desarrollo web servidor',
            'horas' => 7,
        ]);

        $this->delete(route('modulo.destroy', $modulo))
            ->assertRedirect(route('modulo.index'));

        $this->assertDatabaseMissing('modulo', ['id' => $modulo->id]);
    }

    public function test_it_rejects_invalid_or_duplicate_modulo_data(): void
    {
        $modulo = Modulo::create([
            'nombre' => 'Desarrollo web',
            'abreviatura' => 'DWES',
            'horas' => 6,
            'creditos' => '8.00',
        ]);

        $this->from(route('modulo.create'))
            ->post(route('modulo.store'), [
                'nombre' => 'Desarrollo web',
                'abreviatura' => 'DWES',
                'horas' => 16,
                'creditos' => '100.00',
            ])
            ->assertRedirect(route('modulo.create'))
            ->assertSessionHasErrors(['nombre', 'abreviatura', 'horas', 'creditos']);

        $this->assertDatabaseCount('modulo', 1);
        $this->assertDatabaseHas('modulo', ['id' => $modulo->id]);

        $otroModulo = Modulo::create([
            'nombre' => 'Bases de datos',
            'abreviatura' => 'BBDD',
            'horas' => 5,
            'creditos' => '6.00',
        ]);

        $this->from(route('modulo.edit', $otroModulo))
            ->put(route('modulo.update', $otroModulo), [
                'nombre' => 'Desarrollo web',
                'abreviatura' => 'DWES',
                'horas' => 5,
                'creditos' => '6.00',
            ])
            ->assertRedirect(route('modulo.edit', $otroModulo))
            ->assertSessionHasErrors(['nombre', 'abreviatura']);

        $this->assertDatabaseHas('modulo', [
            'id' => $otroModulo->id,
            'nombre' => 'Bases de datos',
            'abreviatura' => 'BBDD',
        ]);
    }
}
