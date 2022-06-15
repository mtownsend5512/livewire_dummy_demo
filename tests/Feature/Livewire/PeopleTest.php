<?php

namespace Tests\Feature\Livewire;

use App\Models\People as PeopleModel;
use App\Http\Livewire\People;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PeopleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(People::class);

        $component->assertStatus(200);
    }

    /** @test  */
    function the_component_is_visible()
    {
        $this->get('/people')->assertSeeLivewire('people');
    }

    /** @test */
    public function a_person_can_be_created()
    {
        $component = Livewire::test(People::class)
            ->set('firstName', 'Saul')
            ->set('lastName', 'Goodman')
            ->set('age', 50)
            ->call('create');

        $this->assertTrue(PeopleModel::query()
                ->where('first_name', 'Saul')
                ->where('last_name', 'Goodman')
                ->where('age', 50)
                ->exists());
    }

    /** @test */
    public function first_name_is_validated_when_created()
    {
        $component = Livewire::test(People::class)
            ->set('firstName', '')
            ->call('create')
            ->assertHasErrors(['firstName' => 'required']);
    }

    /** @test */
    public function last_name_is_validated_when_created()
    {
        $component = Livewire::test(People::class)
            ->set('lastName', '')
            ->call('create')
            ->assertHasErrors(['lastName' => 'required']);
    }

    /** @test */
    public function age_is_validated_when_created()
    {
        $component = Livewire::test(People::class)
            ->set('age', 'abc50')
            ->call('create')
            ->assertHasErrors(['age' => 'numeric']);
    }

    /** @test */
    public function people_can_be_filtered()
    {
        PeopleModel::create([
            'first_name' => 'Mark',
            'last_name' => 'Townsend',
            'age' => 33,
        ]);

        $component = Livewire::test(People::class)
            ->set('filter', 'Townsend')
            ->assertSee('lastName', 'Townsend');

        $component = Livewire::test(People::class)
            ->set('filter', 'Toooooownsend')
            ->assertNotSet('lastName', 'Townsend');
    }
}
