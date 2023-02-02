<?php

namespace App\Http\Controllers\Api\EndPoints;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ZipCodes as Code;
use App\Helpers\CustomResponse;
use Illuminate\Support\Facades\File;

class ZipCodes extends Controller
{
    //
    public function index(){
        return Code::all();
    }

    public function store(Request $request){
        $code = Code::create([
            'zip_code' => $request->zip_code,
            'locality' => $request->locality,
            'federal_entity' => $request->federal_entity
        ]);
        return CustomResponse::success('Codigo Creado correctamente',$code);
    }

    public function show($zip_code){

        $single_code = Code::where('zip_code',$zip_code)->first();

        return CustomResponse::success('Codigo de localidad',$single_code);
    }

    public function dropzoneFile(Request $request){

        $path =  storage_path('app/cdmx.json');
        $json = File::get($path);
        $data = json_decode($json, true);
        
        
        foreach($data as $i){
            Code::updateOrCreate(
                [
                    'zip_code' => "0".$i['codigo']
                ],
                [
                    'locality' => $i['ciudad'],
                    'federal_entity' => [ 
                        [
                            "key" => $i['codigo_estado'],
                            "name"=> $i['ciudad'],
                            "code"=> null
                        ]
                    ],
                    'settlements' => [
                        [
                            [
                                "key"  => $i['cd_asenta'],
                                "name" => $i['asenta'],
                                "zone_type"=> $i['zona']
                            ],
                            "settlement_type" => [
                                "name" => $i['tipo_asenta']
                            ]
                        ]
                    ],
                    'municipality' => [
                        [
                            "key"  => $i['codigo_munnicipio'],
                            "name" => $i['municipio'] 
                        ]
                    ]
    
                ]
            );
        }
        
    }

    
}
