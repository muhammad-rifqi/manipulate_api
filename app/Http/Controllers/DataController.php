<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://localhost/manipulate_api/public/api/json1");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        $ttt = json_decode($output,true);
        $outp = array();
        for($i=0; $i < count($ttt['data']); $i++){
                
            $outp[] = array(
                "name"=>$ttt['data'][$i]['name'],
                "email"=>$ttt['data'][$i]['email'],
                "booking_number"=>$ttt['data'][$i]['booking']['booking_number'],
                "book_date"=>$ttt['data'][$i]['booking']['book_date'],
                "ahass_code"=>$ttt['data'][$i]['booking']['workshop']['code'],
                "ahass_name"=>$ttt['data'][$i]['booking']['workshop']['name'],
                "ahass_address_detail"=>$this->getCode($ttt['data'][$i]['booking']['workshop']['code']),
                "ahass_contact"=>'NAN',
                "ahass_distance"=>'NAN',
                "motorcycle_ut_code"=>$ttt['data'][$i]['booking']['motorcycle']['name'],
                "motorcycle"=>$ttt['data'][$i]['booking']['motorcycle']['ut_code']
            );
        }

       echo json_encode($outp);
    }

    public function getCode($search){

        $curl2 = curl_init();
        curl_setopt($curl2, CURLOPT_URL, "http://localhost/manipulate_api/public/api/json2");
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, 1);
        $output2 = curl_exec($curl2);
        curl_close($curl2);
        $rrr = json_decode($output2,true);

        $found = array_filter($rrr['data'],function($v,$k) use ($search){
        return $v['code'] == $search;
        },ARRAY_FILTER_USE_BOTH); 
        $values= array_values($found);

        return $values;

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_data()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://localhost/manipulate_api/public/data/manipulate");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        $ttt = json_decode($output,true);
        $outp = array();
        for($i=0; $i < count($ttt); $i++){

            for($j=0; $j<count($ttt[$i]['ahass_address_detail']); $j++){

                $outp[] = array(
                    "name"=>$ttt[$i]['name'],
                    "email"=>$ttt[$i]['email'],
                    "booking_number"=>$ttt[$i]['booking_number'],
                    "book_date"=>$ttt[$i]['book_date'],
                    "ahass_code"=>$ttt[$i]['ahass_code'],
                    "ahass_name"=>$ttt[$i]['ahass_name'],
                    "ahass_address"=>$ttt[$i]['ahass_address_detail'][$j]['code'],
                    "ahass_contact"=>$ttt[$i]['ahass_address_detail'][$j]['phone_number'],
                    "ahass_distance"=>$ttt[$i]['ahass_address_detail'][$j]['distance'],
                    "motorcycle"=>$ttt[$i]['motorcycle_ut_code'],
                    "motorcycle_ut_code"=>$ttt[$i]['motorcycle']
                );       
            }
        }

        $key_values = array_column($outp, 'ahass_distance'); 
        array_multisort($key_values, SORT_ASC, $outp);

       echo json_encode($outp);


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
