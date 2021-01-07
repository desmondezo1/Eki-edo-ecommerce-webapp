<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Sentinel;
use Session;
use DataTables;
use App\Model\Banner;
use App\Model\Categories;
Use Image;
use Hash;
class BannerController extends Controller {
       public function __construct() {
         parent::callschedule();
    }
     public function showbanner(){
         $banner=Banner::all();
         $subcategory=Categories::where("parent_category",'!=',0)->where('is_delete','0')->get();
         $img1="demo.jpg";
         $img2="demo-1.jpg";
         $img3="demo-1.jpg";
         if(isset($banner[0]->Image)){
            $img1=$banner[0]->Image;
         }
         if(isset($banner[1]->Image)){
            $img2=$banner[1]->Image;
         }
          if(isset($banner[2]->Image)){
            $img3=$banner[2]->Image;
         }
        return view("admin.banner.default")->with("img1",$img1)->with("img2",$img2)->with("img3",$img3)->with("subcategory",$subcategory)->with("bannerdata",$banner);
     }
    
   public function updatebanner(Request $request){
        if ($files = $request->file('photo1')) {
                $file = $request->file('photo1');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension() ?: 'png';
                $folderName = '/upload/banner/image/';
                $picture = str_random(10).time() . '.' . $extension;
                $destinationPath = public_path() . $folderName;
                $request->file('photo1')->move($destinationPath, $picture);
                $img_url =$picture;
                $photo =Banner::find(1);
              if(empty($photo)){
                 $photo=new Banner();
              }
              $photo->Image = $img_url;
              $photo->title=$request->get("title1");
              $photo->subtitle=$request->get("subtitle1");
              $photo->subcategory=$request->get("subcategory1");
              $photo->position='1';
              $photo->save();
       }
       else{
              $photo =Banner::find(1);
              if(empty($photo)){
                 $photo=new Banner();
              }
              $photo->title=$request->get("title1");
              $photo->subtitle=$request->get("subtitle1");
              $photo->subcategory=$request->get("subcategory1");
              $photo->position='1';
              $photo->save();
       }
       if ($files = $request->file('photo2')) {
                $file = $request->file('photo2');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension() ?: 'png';
                $folderName = '/upload/banner/image/';
                $picture = str_random(10).time() . '.' . $extension;
                $destinationPath = public_path() . $folderName;
                $request->file('photo2')->move($destinationPath, $picture);
                $img_url =$picture;
              $photo =Banner::find(2);
              if(empty($photo)){
                 $photo=new Banner();
              }
              $photo->Image = $img_url;
              $photo->title=$request->get("title2");
              $photo->subtitle=$request->get("subtitle2");
              $photo->subcategory=$request->get("subcategory2");
              $photo->position='2';
              $photo->save();
       }
       else{
              $photo =Banner::find(2);
              if(empty($photo)){
                 $photo=new Banner();
              }
              $photo->title=$request->get("title2");
              $photo->subtitle=$request->get("subtitle2");
              $photo->subcategory=$request->get("subcategory2");
              $photo->position='2';
              $photo->save();
       }
       if ($files = $request->file('photo3')) {
                $file = $request->file('photo3');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension() ?: 'png';
                $folderName = '/upload/banner/image/';
                $picture = str_random(10).time() . '.' . $extension;
                $destinationPath = public_path() . $folderName;
                $request->file('photo3')->move($destinationPath, $picture);
                $img_url =$picture;
              $photo =Banner::find(3);
              if(empty($photo)){
                 $photo=new Banner();
              }
              $photo->Image = $img_url;
              $photo->title=$request->get("title3");
              $photo->subtitle=$request->get("subtitle3");
              $photo->subcategory=$request->get("subcategory3");
              $photo->position='3';
              $photo->save();
       }
       else{
              $photo =Banner::find(3);
              if(empty($photo)){
                 $photo=new Banner();
              }
              $photo->title=$request->get("title3");
              $photo->subtitle=$request->get("subtitle3");
              $photo->subcategory=$request->get("subcategory3");
              $photo->position='3';
              $photo->save();
       }
       $image = Banner::all();
         return redirect("admin/banner");
     }
  
}
