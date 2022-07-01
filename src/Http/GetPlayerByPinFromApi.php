<?php

namespace EnricoDeLazzari\EgdClient\Http;

use EnricoDeLazzari\EgdClient\Actions\FormatAction;

class GetPlayerByPinFromApi extends Http
{
    protected function getMethod(): string
    {
        return 'GET';
    }

    protected function route(): string
    {
        return 'GetPlayerDataByPIN.php';
    }

    public function __invoke(): array
    {
        $pin = '13049520';

        $body = $this->send([
            'query' => [
                'pin' => $pin,
            ],
        ])->json();

        return app(FormatAction::class)(
            data: $body,
            except: ['retcode']
        );
    }
}
