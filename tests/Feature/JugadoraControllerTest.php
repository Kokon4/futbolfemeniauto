<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class JugadoraControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;
    protected $equip;

    protected function setUp(): void
    {
        parent::setUp();

        $this->equip = Equip::factory()->create();
        $this->user = User::factory()->create(['equip_id' => $this->equip->id]);
    }

    public function test_index_displays_jugadores()
    {
        $jugadores = Jugadora::factory(3)->create();

        $response = $this->actingAs($this->user)->get(route('jugadores.index'));

        $response->assertStatus(200);
        $response->assertViewIs('jugadores.index');
        $response->assertViewHas('jugadores');
    }

    public function test_create_displays_form()
    {
        $response = $this->actingAs($this->user)->get(route('jugadores.create'));

        $response->assertStatus(200);
        $response->assertViewIs('jugadores.create');
        $response->assertViewHas('equip');
    }

    public function test_store_creates_new_jugadora()
    {
        Storage::fake('public');

        $jugadoraData = [
            'nom' => $this->faker->name,
            'cognom' => $this->faker->lastName,
            'dorsal' => $this->faker->numberBetween(1, 99),
            'data_naixement' => $this->faker->date(),
            'posicio' => $this->faker->randomElement(['Portera', 'Defensa', 'Migcampista', 'Davantera']),
            'equip_id' => $this->equip->id,
            'foto' => UploadedFile::fake()->image('jugadora.jpg')
        ];

        $response = $this->actingAs($this->user)->post(route('jugadores.store'), $jugadoraData);

        $response->assertRedirect(route('jugadores.index'));
        $this->assertDatabaseHas('jugadores', [
            'nom' => $jugadoraData['nom'],
            'cognom' => $jugadoraData['cognom'],
            'dorsal' => $jugadoraData['dorsal'],
        ]);

        // Get the created jugadora from the database
        $createdJugadora = Jugadora::where('nom', $jugadoraData['nom'])
                                   ->where('cognom', $jugadoraData['cognom'])
                                   ->first();

        // Assert that the file exists in the storage
        $this->assertNotNull($createdJugadora->foto);
        Storage::disk('public')->assertExists($createdJugadora->foto);
    }

    public function test_show_displays_jugadora()
    {
        $jugadora = Jugadora::factory()->create();

        $response = $this->actingAs($this->user)->get(route('jugadores.show', $jugadora));

        $response->assertStatus(200);
        $response->assertViewIs('jugadores.show');
        $response->assertViewHas('jugadora');
    }

    public function test_edit_displays_form()
    {
        $jugadora = Jugadora::factory()->create();

        $response = $this->actingAs($this->user)->get(route('jugadores.edit', $jugadora));

        $response->assertStatus(200);
        $response->assertViewIs('jugadores.edit');
        $response->assertViewHas('jugadora');
        $response->assertViewHas('equips');
    }

    public function test_update_modifies_jugadora()
    {
        $jugadora = Jugadora::factory()->create();
        $newData = [
            'nom' => $this->faker->name,
            'cognom' => $this->faker->lastName,
            'dorsal' => $this->faker->numberBetween(1, 99),
            'data_naixement' => $this->faker->date(),
            'posicio' => $this->faker->randomElement(['Portera', 'Defensa', 'Migcampista', 'Davantera']),
            'equip_id' => $this->equip->id,
        ];

        $response = $this->actingAs($this->user)->put(route('jugadores.update', $jugadora), $newData);

        $response->assertRedirect(route('jugadoras.index'));
        $this->assertDatabaseHas('jugadores', [
            'id' => $jugadora->id,
            'nom' => $newData['nom'],
            'cognom' => $newData['cognom'],
            'dorsal' => $newData['dorsal'],
        ]);
    }

    public function test_destroy_deletes_jugadora()
    {
        $jugadora = Jugadora::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('jugadores.destroy', $jugadora));

        $response->assertRedirect(route('jugadores.index'));
        $this->assertDatabaseMissing('jugadores', ['id' => $jugadora->id]);
    }
}

