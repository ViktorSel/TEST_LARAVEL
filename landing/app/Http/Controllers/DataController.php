<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($page = 1)
    {   
        $data = [];
        try {
            $response = Http::retry(3, 100)->post('172.24.0.1:8002/api/data', [
                'jsonrpc'   => '2.0',
                'method'    => 'DataProcedure@get',
                'params'    => [
                    'paginator' => 3,
                    'page'      => $page,
                ],
                'id'        => '1'//Str::uuid(),
            ]);
            //dd($response->json());
            $data = $response->json()['result'];
            foreach($data['links'] as $key => $field) {
                if ($field['url']) $data['links'][$key]['url'] = str_replace('http://172.24.0.1:8002/api/data?page=','/admin/activity/',$data['links'][$key]['url']);
            }
            //dd($data);
        }
        catch(\Exception $ex) {

        }
        
        return view('data',['datas' => $data]);
    }
}
