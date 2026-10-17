<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;

test('it creates a user and checks database name', function () {
    $user = User::factory()->create();

    expect(User::where('id', $user->id)->exists())->toBeTrue();

    $currentDB = DB::connection()->getDatabaseName();
    expect($currentDB)->toBe('wrong');
});
