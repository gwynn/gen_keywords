<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeywordsController extends Controller
{

    private $wrapper = [
        "1" => ['\'', '\''],
        "2" => ['"', '"'],
        "3" => ['<', '>'],
        "4" => ['(', ')'],
        "5" => ['[', ']'],
        "6" => ['{', '}'],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'error' => false,
            'data'  => [],
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        list($w_o, $w_c) = $this->wrapper[$data['wrap']];
        $total = count($data['set']);
        $counter = 0;
        $arr = [];
        $result = '';
        foreach((array) $data['set'] as $k => $i){
            $arr[] = explode(PHP_EOL, $i);
        }
        $last = array_key_last($arr);

        $curr_index = array_fill(0, count($arr), 0);
        $r = [];
        while(true){
            $r_sub = [];
            for($i = 0; $i < count($arr); $i++){
                $r_sub[] = $arr[$i][$curr_index[$i]];
            }
            $r[] = $r_sub;
            $si = 0;
            while(true){
                if($curr_index[$si] < count($arr[$si])-1){
                    $curr_index[$si]++;
                    break;
                }else{
                    $curr_index[$si] = 0;
                    $si++;
                }
                if($si == count($curr_index)){
                    break 2;
                }
            }
        }
        foreach($r as $_ => $d){
            $imploded = implode($data['separate'], $d);
            if($data['format'] == 'snake'){
                $imploded = str_replace(' ', '_', strtolower($imploded));
            }
            if($data['format'] == 'dash'){
                $imploded = str_replace(' ', '-', strtolower($imploded));
            }
            if($data['format'] == 'camel'){
                $imploded = ucwords(strtolower($imploded));
                $imploded = str_replace(' ', '', $imploded);
                $imploded = lcfirst($imploded);
            }
            if($data['format'] == 'studly'){
                $imploded = ucwords(strtolower($imploded));
                $imploded = str_replace(' ', '', $imploded);
            }
            if($data['format'] == 'upper'){
                $imploded = strtoupper($imploded);
            }
            if($data['format'] == 'lower'){
                $imploded = strtolower($imploded);
            }
            if($data['format'] == 'title'){
                $imploded = ucwords(strtolower($imploded));
            }
            if($data['format'] == 'normal'){
                $imploded = ucfirst(strtolower($imploded));
            }
            $result .= $w_o.$imploded.$w_c.'<br />';
        }
        return response()->json([
            'error' => false,
            'data'  => $result,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
