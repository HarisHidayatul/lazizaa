<?php

namespace App\Http\Controllers;

use App\Models\listItemSO;
use App\Models\satuan;
use Illuminate\Http\Request;

class itemSOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function initAllDataSO()
    {
        //Fungsi ini merupakan fungsi untuk inisialisasi awal data SO, data ini berada didalam file csv pada folder public
        $filePath = public_path('initFile/initSO.csv'); // path to the CSV file
        $csvDatas = [];
        $rowNum = 0;

        //Satuan ini memiliki [Satuan,id]
        $satuanArray = [];

        //Item SO array ini memilki [Item, id]
        $itemSOArray = [];

        //Dapatkan data satuan
        $satuan_all = satuan::all();
        for ($i = 0; $i < $satuan_all->count(); $i++) {
            $tempData = [$satuan_all[$i]->Satuan, $satuan_all[$i]->id];
            array_push($satuanArray, $tempData);
        }

        //Dapatkan data itemSO
        $listItemSO = listItemSO::all();
        for ($i = 0; $i < $listItemSO->count(); $i++) {
            $tempData = [$listItemSO[$i]->Item, $listItemSO[$i]->id];
            array_push($itemSOArray, $tempData);
        }

        if (($handle = fopen($filePath, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $rowNum++;
                if ($rowNum == 1) {
                    continue; // Skip the first row
                }
                $csvDatas[] = $data;
            }
            fclose($handle);
        }

        foreach($csvDatas as $csvData){
            $item = $csvData[0];
            $satuan = $csvData[1];
            $harian = $csvData[2];
            if($harian == null){
                $harian = 0;
            }
            $mingguan = $csvData[3];
            if($mingguan == null){
                $mingguan = 0;
            }
            $pathIcon = $csvData[4];
            if($pathIcon == null){
                $pathIcon = 'defaultItem.svg';
            }

            $foundSatuan = false;
            $indexIfFoundSatuan = 0;

            $foundSO = false;
            $indexIfFoundSO = 0;

            //Mulai cari satuan
            for ($j = 0; $j < count($satuanArray); $j++) {
                if (strtoupper($satuanArray[$j][0]) == strtoupper($satuan)) {
                    $foundSatuan = true;
                    $indexIfFoundSatuan = $j;
                    break;
                }
            }
            if (!$foundSatuan) {
                $satuan_insert = new satuan();
                $satuan_insert->Satuan = $satuan;
                $satuan_insert->save();

                $tempData = [$satuan, $satuan_insert->id];
                array_push($satuanArray, $tempData);
                for ($j = 0; $j < count($satuanArray); $j++) {
                    //Mulai cari id kategori
                    if (strtoupper($satuanArray[$j][0]) == strtoupper($satuan)) {
                        $foundSatuan = true;
                        $indexIfFoundSatuan = $j;
                        break;
                    }
                }
            }
            //End cari satuan

            //Mulai cari item
            for ($j = 0; $j < count($itemSOArray); $j++) {
                if (strtoupper($itemSOArray[$j][0]) == strtoupper($item)) {
                    $foundSO = true;
                    $indexIfFoundSO = $j;
                    break;
                }
            }
            if (!$foundSO) {
                $so_insert = new listItemSO();
                $so_insert->idSatuan = $satuanArray[$indexIfFoundSatuan][1];
                $so_insert->Item = $item;
                $so_insert->munculHarian = $harian;
                $so_insert->munculMingguan = $mingguan;
                $so_insert->icon = $pathIcon;
                $so_insert->save();

                $tempData = [$item, $so_insert->id];
                array_push($itemSOArray, $tempData);
                for ($j = 0; $j < count($itemSOArray); $j++) {
                    //Mulai cari id item
                    if (strtoupper($itemSOArray[$j][0]) == strtoupper($item)) {
                        $foundSO = true;
                        $indexIfFoundSO = $j;
                        break;
                    }
                }
            }else{
                $so_insert = listItemSO::find($itemSOArray[$indexIfFoundSO][1]);
                $so_insert->idSatuan = $satuanArray[$indexIfFoundSatuan][1];
                $so_insert->Item = $item;
                $so_insert->munculHarian = $harian;
                $so_insert->munculMingguan = $mingguan;
                $so_insert->icon = $pathIcon;
                $so_insert->save();
            }
            //End cari item
        }
        print_r(json_encode($itemSOArray));
        // @dd($csvData);
    }
    public function index()
    {
        //
        $itemso = listItemSO::all();
        $arraySO = [];
        for($i=0;$i<$itemso->count();$i++)
        {
            array_push($arraySO,(object)[
                'id' => $itemso[$i]['id'],
                'item' => $itemso[$i]['Item'],
                'Satuan' => $itemso[$i]->satuans['Satuan']
            ]);
        }
        return response()->json([
            'countItem'=>$itemso->count(),
            'itemSO'=> $arraySO
        ]);
    }

    public function showAllItem(){
        $itemso = listItemSO::orderBy('id', 'DESC')->get();
        $satuanAll = satuan::all();
        $arraySO = [];
        $arrayAllSatuan = [];
        for($i =0; $i < $satuanAll->count();$i++){
            array_push($arrayAllSatuan, (object)[
                'id' => $satuanAll[$i]->id,
                'satuan' => $satuanAll[$i]->Satuan
            ]);
        }
        for($i=0;$i<$itemso->count();$i++)
        {
            array_push($arraySO,(object)[
                'id' => $itemso[$i]['id'],
                'item' => $itemso[$i]['Item'],
                'idSatuan' => $itemso[$i]['idSatuan'],
                'icon' => $itemso[$i]['icon'],
                'mingguanItem' => $itemso[$i]['munculMingguan'],
                'harianItem' => $itemso[$i]['munculHarian']
            ]);
        }
        return response()->json([
            'satuan' => $arrayAllSatuan,
            'itemSO'=> $arraySO
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $dataArray = [
            'Item' => $request->item,
            'idSatuan' => $request->idSatuan,
            'icon' => $request->icon
        ];
        listItemSO::create($dataArray);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $listItemSO = listItemSO::find($id);
        $listItemSO->update([
            'Item' => $request->item,
            'idSatuan' => $request->idSatuan,
            'icon' => $request->icon,
            'munculMingguan' => $request->munculMingguan,
            'munculHarian' => $request->munculHarian
        ]);
        echo 1;
        // @dd($listItemSO);
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
