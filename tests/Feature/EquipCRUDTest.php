<?php 
namespace Tests\Feature;

use App\Models\Estadi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Equip;

class EquipCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function es_pot_crear_un_equip_correctament()
    {
        // Actuar: Crear un equip
        $estadi = Estadi::create([
            'nom' => 'Camp Nou',
            'ciutat' => 'Barcelona',
            'capacitat' => 99354,
        ]);
        $equip = Equip::create([
            'nom' => 'FC Barcelona',
             'titols' =>30,
             'estadi_id' => 1,
        ]);

        // Comprovar que l’equip es guarda a la base de dades
        $this->assertDatabaseHas('equips', [
            'nom' => 'FC Barcelona',
            'titols' => 30,
            'estadi_id' => 1,
        ]);
    }

    public function es_poden_llistar_els_equips()
    {
        // Arrange: Crear equips
        Equip::factory()->create(['nom' => 'FC Barcelona']);
        Equip::factory()->create(['nom' => 'Real Madrid']);

        // Actuar: Obtenir la llista d’equips
        $equips = Equip::all();

        // Comprovar que la llista conté els equips creats
        $this->assertCount(2, $equips);
        $this->assertEquals('FC Barcelona', $equips[0]->nom);
        $this->assertEquals('Real Madrid', $equips[1]->nom);
    }

    public function es_pot_actualitzar_un_equip()
    {
        // Arrange: Crear un equip
        $equip = Equip::create([
            'nom' => 'FC Barcelona',
            'ciutat' => 'Barcelona',
        ]);

        // Actuar: Actualitzar l’equip
        $equip->update([
            'nom' => 'Barça',
            'ciutat' => 'Catalunya',
        ]);

        // Comprovar que els canvis es reflecteixen a la base de dades
        $this->assertDatabaseHas('equips', [
            'nom' => 'Barça',
            'ciutat' => 'Catalunya',
        ]);
    }

    public function es_pot_esborrar_un_equip()
    {
        // Arrange: Crear un equip
        $equip = Equip::create([
            'nom' => 'FC Barcelona',
            'ciutat' => 'Barcelona',
        ]);

        // Actuar: Esborrar l’equip
        $equip->delete();

        // Comprovar que l’equip ja no existeix a la base de dades
        $this->assertDatabaseMissing('equips', [
            'nom' => 'FC Barcelona',
            'ciutat' => 'Barcelona',
        ]);
    }

    public function no_es_pot_crear_un_equip_sense_nom()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Intentar crear un equip sense nom
        Equip::create([
            'ciutat' => 'Barcelona',
        ]);
    }
}