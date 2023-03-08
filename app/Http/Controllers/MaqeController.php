<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use Illuminate\Http\Request;

class MaqeController extends Controller
{
    private $bot;

    public function __construct(Bot $bot)
    {
        $this->bot = $bot;
    }

    public function index(Request $request)
    {
        $request->validate(['maqe_text' => 'required|string']);
        $maqeText = $request->get('maqe_text');

        $result = $this->signal($maqeText)->printPosition();

        return response([
            'success' => true,
            'message' => 'Success.',
            'data' => $result,

        ], 200);
    }

    public function signal(string $signal): Controller
    {
        $operations = $this->getOperations($signal);

        foreach ($operations as $operation) {
            $action = ucfirst($operation[0][0]);

            if ($action === 'R') {
                $this->bot->turnRight();
            } elseif ($action === 'L') {
                $this->bot->turnLeft();
            } elseif ($action === 'W') {
                // The single W with no quantifier is assumed 1.
                $this->bot->walk($operation[1] ?? 1);
            }

            // If not whitespace, throw up!
            elseif (trim($action) !== '') {
                throw new \InvalidArgumentException("Invalid operation `{$operation[0]}` in '{$signal}'");
            }
        }

        return $this;
    }

    public function printPosition()
    {
        return $this->bot->getPosition();
    }

    private function getOperations(string $signal): array
    {
        $flags = PREG_SET_ORDER;

        preg_match_all('/R|L|W(\d+)|.+/i', trim($signal), $operations, $flags);

        return $operations ?: [];
    }
}
