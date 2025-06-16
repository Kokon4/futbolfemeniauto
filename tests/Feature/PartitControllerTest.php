<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Partit;
use App\Models\Equip;

class PartitControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;
    protected $arbitre;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => 'admin']);
        $this->arbitre = User::factory()->create(['role' => 'arbitre']);
    }

    public function test_index_displays_partits()
    {
        $partits = Partit::factory(3)->create();

        $response = $this->actingAs($this->user)->get(route('partits.index'));

        $response->assertStatus(200);
        $response->assertViewIs('partits.index');
        $response->assertViewHas('partits');
    }

    public function test_create_displays_form()
    {
        $response = $this->actingAs($this->user)->get(route('partits.create'));

        $response->assertStatus(200);
        $response->assertViewIs('partits.create');
        $response->assertViewHas('equips');
    }

    public function test_store_creates_new_partit()
    {
        $equips = Equip::factory(2)->create();
        $partitData = [
            'equip_local_id' => $equips[0]->id,
            'equip_visitant_id' => $equips[1]->id,
            'data' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'),
            'jornada' => $this->faker->numberBetween(1, 38),
            'arbitre_id' => $this->arbitre->id,
        ];

        $response = $this->actingAs($this->user)->post(route('partits.store'), $partitData);

        $response->assertRedirect(route('partits.index'));
        $this->assertDatabaseHas('partits', $partitData);
    }

    public function test_show_displays_partit()
    {
        $partit = Partit::factory()->create();

        $response = $this->actingAs($this->user)->get(route('partits.show', $partit));

        $response->assertStatus(200);
        $response->assertViewIs('partits.show');
        $response->assertViewHas('partit');
    }

    public function test_edit_displays_form()
    {
        $partit = Partit::factory()->create();

        $response = $this->actingAs($this->user)->get(route('partits.edit', $partit));

        $response->assertStatus(200);
        $response->assertViewIs('partits.edit');
        $response->assertViewHas('partit');
        $response->assertViewHas('equips');
    }

    public function test_update_modifies_partit()
    {
        $partit = Partit::factory()->create();
        $equips = Equip::factory(2)->create();
        $newData = [
            'equip_local_id' => $equips[0]->id,
            'equip_visitant_id' => $equips[1]->id,
            'data' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'),
            'jornada' => $this->faker->numberBetween(1, 38),
            'arbitre_id' => $this->arbitre->id,
        ];

        $response = $this->actingAs($this->user)->put(route('partits.update', $partit), $newData);

        $response->assertRedirect(route('partits.index'));
        $this->assertDatabaseHas('partits', array_merge(['id' => $partit->id], $newData));
    }

    public function test_destroy_deletes_partit()
    {
        $partit = Partit::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('partits.destroy', $partit));

        $response->assertRedirect(route('partits.index'));
        $this->assertDatabaseMissing('partits', ['id' => $partit->id]);
    }

    public function test_edit_result_displays_form()
    {
        $partit = Partit::factory()->create(['arbitre_id' => $this->arbitre->id]);

        $response = $this->actingAs($this->arbitre)->get(route('partits.edit-result', $partit));

        $response->assertStatus(200);
        $response->assertViewIs('partits.edit-result');
        $response->assertViewHas('partit');
    }

    public function test_update_result_modifies_partit()
    {
        $partit = Partit::factory()->create(['arbitre_id' => $this->arbitre->id]);
        $resultData = [
            'gol_local' => $this->faker->numberBetween(0, 5),
            'gol_visitant' => $this->faker->numberBetween(0, 5),
        ];

        $response = $this->actingAs($this->arbitre)->put(route('partits.update-result', $partit), $resultData);

        $response->assertRedirect(route('partits.index'));
        $this->assertDatabaseHas('partits', array_merge(['id' => $partit->id], $resultData));
    }
}

