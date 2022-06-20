<?php

use EnricoDeLazzari\EgdClient\Http\GetPlayerByPinFromApi;

it('can test', function () {
    $data = (new GetPlayerByPinFromApi())();

    dd($data);

    expect(true)->toBeTrue();
});
