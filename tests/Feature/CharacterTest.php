<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Character;
use App\User;

class CharacterTest extends TestCase
{
    use RefreshDatabase;

    public function testGetActiveCharacter()
    {
        $user = factory(User::class)->create();

        $character = factory(Character::class)->create();

        // Assert it works when there is an active character

        $user->characters()->save($character);

        $response = $this->actingAs($user, 'api')->getJson('/api/character/active-character');

        $response->assertOk();

        // Assert it works when there is no active character

        $character->active = false;
        $character->save();

        $response = $this->actingAs($user, 'api')->getJson('/api/character/active-character');

        $response->assertOk();
    }
}
