<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Desa;
use App\Models\Kabkot;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KemiskinanController extends Controller
{
    public function index()
    {
        return view('kemiskinan',[
            "title"=>"Kemiskinan",
            "kabkots"=>Kabkot::orderby('idkabkot')->get(),
            "peta"=>"jatim_by_kabkot",
            "judulPeta"=>"Provinsi Jawa Timur",
            "data"=>"",
            "max"=>0,
            "min"=>0,
            ]);
    }

    public function getKecamatan(Request $request){
        $kecamatan=Kecamatan::orderby('idkecamatan')
                        ->where('idkabkot',$request->idkabkot)
                        ->get();
        
        if(count($kecamatan)>0){
            return response()->json($kecamatan);
        }
    }

    public function getNamaKecamatan(String $request){
        $namakecamatan=Kecamatan::where('idkecamatan',$request)
                        ->value('namakecamatan');
       return $namakecamatan;
       
    }

    public function getNamaKabupaten(String $request){
        $namakecamatan=Kabkot::where('idkabkot',$request)
                        ->value('namakabkot');
       return $namakecamatan;
       
    }

    public function getDesa(Request $request){
        $desa=Desa::orderby('iddesa')
                        ->where('idkecamatan',$request->idkecamatan)
                        ->get();
        
        if(count($desa)>0){
            return response()->json($desa);
        }
    }

    public function pilihWilayah(Request $request){
        $peta="";
        $data=null;
        $max=null;
        $min=null;
        $judulPeta="";
        if ($request->kabkot!=0 && $request->kecamatan==0){
            $peta="idkab_".$request->kabkot;
            $judulPeta=$this->getNamaKabupaten($request->kabkot);
            $data=json_decode($this->getDataByKab($request->kabkot)->getContent(),true);
            $max=$this->getMaxDataByKab($request->kabkot);
            $min=$this->getMinDataByKab($request->kabkot);
        }else if($request->kabkot!=0 && $request->kecamatan !=0){
            $peta="idkec_".$request->kecamatan;  
            $judulPeta=$this->getNamaKabupaten($request->kabkot).
                " Kecamatan ".$this->getNamaKecamatan($request->kecamatan);
            $data=json_decode($this->getDataByKec($request->kecamatan)->getContent(),true);
            $max=$this->getMaxDataByKec($request->kecamatan);
            $min=$this->getMinDataByKec($request->kecamatan);
        }else{
            return view('kemiskinan',[
                "title"=>"Kemiskinan",
                "kabkots"=>Kabkot::orderby('idkabkot')->get(),
                "peta"=>"jatim_by_kabkot",
                "judulPeta"=>"Provinsi Jawa Timur",
                "data"=>"",
                "max"=>0,
                "min"=>0,
                ]);
        }

        //($request->idkabkot==0)

        return view('kemiskinan',[
            "title"=>"Kemiskinan",
            "kabkots"=>Kabkot::orderby('idkabkot')->get(),
            "kecamatans"=>Kecamatan::orderby('idkecamatan')
                ->where('idkabkot',$request->kabkot)
                ->get(),
            "peta"=>$peta,
            "kabkotselected"=>$request->kabkot,
            "kecselected"=>$request->kecamatan,
            "judulPeta"=>$judulPeta,
            "data"=>$data,
            "max"=>$max,
            "min"=>$min
        ]);
        //echo $data;
        //return echo $data;

    }

    public function getDataByKab(String $idkab){
        $data=Data::select('iddesa as name', 'jumlah as value','namadesa as Nama Desa','miskin as Miskin',
                'rentan_miskin as Rentan Miskin', 'sangat_miskin as Sangat Miskin')
                    ->orderby('iddesa')
                    ->where('idkabkot',$idkab)
                    ->get();
        if(count($data)>0){
            return response()->json($data);
        }               
    }

     public function getMaxDataByKab(String $idkab){
        $maxSelect=Data::orderBy('jumlah', 'desc')
                    ->where('idkabkot',$idkab)
                    ->first();
        $max = $maxSelect->jumlah;
        return $max;            
    }
    public function getMinDataByKab(String $idkab){
        $minSelect=Data::orderBy('jumlah', 'asc')
                    ->where('idkabkot',$idkab)
                    ->first();
        $min = $minSelect->jumlah;
        return $min;            
    }

    public function getMaxDataByKec(String $idkecamatan){
        $maxSelect=Data::orderBy('jumlah', 'desc')
                    ->where('idkecamatan',$idkecamatan)
                    ->first();
        $max = $maxSelect->jumlah;
        return $max;            
    }

    public function getMinDataByKec(String $idkecamatan){
        $minSelect=Data::orderBy('jumlah', 'asc')
                    ->where('idkecamatan',$idkecamatan)
                    ->first();
        $min = $minSelect->jumlah;
        return $min;            
    }
    
    public function getDataByKec(String $idkecamatan){
        $data=Data::select('iddesa as name', 'jumlah as value','namadesa as Nama Desa','miskin as Miskin',
                'rentan_miskin as Rentan Miskin', 'sangat_miskin as Sangat Miskin')
                  ->orderby('iddesa')
                    ->where('idkecamatan',$idkecamatan)
                    ->get();
        if(count($data)>0){
            return response()->json($data);
        }  
    }
    
}
