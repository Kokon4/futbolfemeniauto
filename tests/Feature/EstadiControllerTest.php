<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Estadi;
use App\Models\Equip;

class EstadiControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => 'admin']);
    }

    public function test_index_displays_estadis()
    {
        $estadis = Estadi::factory(3)->create();

        $response = $this->actingAs($this->user)->get(route('estadis.index'));

        $response->assertStatus(200);
        $response->assertViewIs('estadis.index');
        $response->assertViewHas('estadis');
    }

    public function test_create_displays_form()
    {
        $response = $this->actingAs($this->user)->get(route('estadis.create'));

        $response->assertStatus(200);
        $response->assertViewIs('estadis.crear');
        $response->assertViewHas('equips');
        $response->assertViewHas('estadis');
    }

    public function test_store_creates_new_estadi()
    {
        $estadiData = [
            'nom' => $this->faker->name,
            'ciutat' => $this->faker->city,
            'capacitat' => $this->faker->numberBetween(1000, 100000),
        ];

        $response = $this->actingAs($this->user)->post(route('estadis.store'), $estadiData);

        $response->assertRedirect(route('estadis.index'));
        $this->assertDatabaseHas('estadis', $estadiData);
    }

    public function test_show_displays_estadi()
    {
        $estadi = Estadi::factory()->create();

        $response = $this->actingAs($this->user)->get(route('estadis.show', $estadi));

        $response->assertStatus(200);
        $response->assertViewIs('estadis.show');
        $response->assertViewHas('estadi');
    }

    public function test_edit_displays_form()
    {
        $estadi = Estadi::factory()->create();

        $response = $this->actingAs($this->user)->get(route('estadis.edit', $estadi));

        $response->assertStatus(200);
        $response->assertViewIs('estadis.edit');
        $response->assertViewHas('estadi');
        $response->assertViewHas('estadis');
    }

    public function test_update_modifies_estadi()
    {
        $estadi = Estadi::factory()->create();
        $newData = [
            'nom' => $this->faker->name,
            'ciutat' => $this->faker->city,
            'capacitat' => $this->faker->numberBetween(1000, 100000),
        ];

        $response = $this->actingAs($this->user)->put(route('estadis.update', $estadi), $newData);

        $response->assertRedirect(route('estadis.show', $estadi->id));
        $this->assertDatabaseHas('estadis', array_merge(['id' => $estadi->id], $newData));
    }

    public function test_destroy_deletes_estadi()
    {
        $estadi = Estadi::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('estadis.destroy', $estadi));

        $response->assertRedirect(route('estadis.index'));
        $this->assertDatabaseMissing('estadis', ['id' => $estadi->id]);
    }
}