<?php

use EnricoDeLazzari\EgdClient\Http\GetPlayes;

it('can test', function () {
    $data = (new GetPlayes())();

    dd($data);

    expect(true)->toBeTrue();
});
