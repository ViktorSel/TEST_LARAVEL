<?php

declare(strict_types=1);

namespace App\Http\Procedures;

use Illuminate\Http\Request;
use Sajya\Server\Procedure;
use App\Models\Log;

class DataProcedure extends Procedure
{
    /**
     * The name of the procedure that will be
     * displayed and taken into account in the search
     *
     * @var string
     */
    public static string $name = 'DataProcedure';

    /**
     * Execute the procedure.
     *
     * @param Request $request
     *
     * @return array|string|integer
     */
    public function create(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $data = Log::create(...[$content['params']]);
        return $data;
    }

    public function get(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $paginator = $content['params']['paginator'];
        $page = $content['params']['page'];
        return Log::selectRaw('url, count(id) as count, max(visited_at) as visited_at')->groupBy('url')->paginate($paginator, ['*'], 'page', $page);
    }
}
