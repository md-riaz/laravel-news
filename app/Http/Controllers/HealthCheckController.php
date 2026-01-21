<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HealthCheckController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'app' => config('app.name'),
            'database' => $this->databaseStatus(),
            'status' => 'ok',
            'version' => app()->version(),
        ]);
    }

    private function databaseStatus(): string
    {
        try {
            DB::select('select 1');

            return 'ok';
        } catch (\Throwable) {
            return 'unavailable';
        }
    }
}
