<?php

namespace App\Http\Controllers;
use App\Model\CronSchedule;
use Artisan;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Model\Product;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function callschedule(){
        $getdata=CronSchedule::where("date",date("Y-m-d"))->first();
        if(empty($getdata)){
        	$storedone=$this->productupdate();
        	if($storedone==1){
        	    $store=CronSchedule::find(1);
            	$store->date=date("Y-m-d");
            	$store->save();
            	return "change";
        	}
        	
        }
       
        return "okay";
    }
    
     public function productupdate(){
      
         $product=Product::all();
         foreach ($product as $k) {
            if($k->special_price!=""){
                        $today = date('Y-m-d');
                        $start_date = date('Y-m-d', strtotime($k->special_price_start));
                        $end_date = date('Y-m-d', strtotime($k->special_price_to));
                        if($today>=$start_date&&$today<=$end_date){
                                $k->selling_price=number_format((float)$k->special_price, 2, '.', '');
                                $dis_price=(int)($k->MRP)-(int)($k->special_price);
                                $disper=0;
                                if($dis_price!=0&&$dis_price>0){
                                    $disper=((int)$dis_price/(int)$k->MRP)*100;
                                }
                                $k->discount=(int)floor($disper);
                        }else{

                                $dis_price=(int)($k->MRP)-(int)($k->price);
                                $disper=0;
                                if($dis_price!=0&&$dis_price>0){
                                        $disper=((int)$dis_price/(int)$k->MRP)*100;
                                }
                                $k->discount=(int)floor($disper);
                                $k->selling_price=number_format((float)$k->price, 2, '.', '');
                            }
                             $k->save();
                           }
            else{
                              $dis_price=(int)($k->MRP)-(int)($k->price);
                                $disper=0;
                                if($dis_price!=0&&$dis_price>0){
                                        $disper=((int)$dis_price/(int)$k->MRP)*100;
                                }
                                $k->discount=(int)floor($disper);
                                $k->selling_price=number_format((float)$k->price, 2, '.', '');  
                                $k->save();
            }
                          
                          
         }
        return 1;
  }
}
