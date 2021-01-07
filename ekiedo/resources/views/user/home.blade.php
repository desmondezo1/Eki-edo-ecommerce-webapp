@extends('user.index')
@section('title')
{{__('messages.site_name')}}
@stop
@section('content')
@if(count($bestoffer)!=0)
<div class="container">
   <div id="demo" class="carousel slide off-slide" data-ride="carousel">
      <ul class="carousel-indicators">
         <?php $i=0;?>
         @foreach($bestoffer as $fd)
         @if($i==0)
         <?php $class="active";?>
         @else
         <?php $class="";?>
         @endif
         <li data-target="#demo" data-slide-to="{{$i}}" class="{{$class}}"></li>
         <?php $i++;?>
         @endforeach
      </ul>
      <div class="carousel-inner">
         <?php $i=0;?>
         @foreach($bestoffer as $fd)
         <?php 
            $active="";
            if($i==0){
               $active="active";
            }
            $i++;
            ?>
         @if($fd->offer_type==1)
         <div class="carousel-item {{$active}}">
            <div class="offer-img" style="background-image:url('{{asset('public/upload/offer/image').'/'.$fd->banner}}')">
               <div class="off-text">
                     <div class="real-text">
                        <h1 class="animated slideInDown" style="color: <?= Session::get('site_color') ?> !important">{{$fd->title}}</h1>
                        <h2 class="animated fadeInLeft">{{$fd->main_title}}</h2>
                        @if($fd->is_product=='1')
                        <p class="animated slideInDown">{{__('messages.home_note_1')}} {{$fd->fixed}}% {{__('messages.home_note_2')}}</p>
                        @endif
                        @if($fd->is_product=='2')
                        <p class="animated fadeInRight">{{__('messages.home_note_3')}}{{$currency}}{{$fd->new_price}}</p>
                        @endif
                        @if($fd->is_product=='1')
                        <a href="{{url('productslist').'/'.$fd->category_id.'/0/0'.'/'.$fd->fixed}}" style="background: <?= Session::get('site_color') ?> !important">
                        {{__('messages.shop_now')}}
                        </a>
                        @endif
                        @if($fd->is_product=='2')
                        <a href="{{url('viewproduct').'/'.$fd->product_id}}" style="background: <?= Session::get('site_color') ?> !important">
                        {{__('messages.shop_now')}}
                        </a>
                        @endif
                     </div>
               </div>
            </div>
         </div>
         @endif
         @endforeach
      </div>
      <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
      </a>
   </div>
</div>
@endif
<div class="container">
   <div class="row nor-b">
      @foreach($offerdata as $fd)
      @if($fd->offer_type==2&&$fd->offer_id!=0)
      <?php $img_url=asset('public/upload/offer/image').'/'.$fd->offer->banner;?>
      <div class="col-md-4 col-12">
         <div class="normal1 text-off overlay_main" style="background-image:url('{{$img_url}}')">
            <div class="overlay">
            </div>
            <div class="ban-text">
            <h1 style="color: <?= Session::get('site_color') ?> !important">{{$fd->offer->title}}</h1>
            @if($fd->offer->is_product=='2')
            <p>{{__('messages.home_note_3')}}{{$currency}}{{$fd->offer->new_price}}</p>
            @endif
            @if($fd->offer->is_product=='1')
            <p>{{__('messages.home_note_1')}} {{$fd->offer->fixed}}% {{__('messages.home_note_2')}}</p>
            @endif
            @if($fd->offer->is_product=='2')
            <a href="{{url('viewproduct').'/'.$fd->offer->product_id}}" style="background: <?= Session::get('site_color') ?> !important">
           {{__('messages.shop_now')}}
            </a>
            @endif
            @if($fd->offer->is_product=='1')
            <a href="{{url('productslist').'/0/'.$fd->offer->category_id.'/0'.'/'.$fd->offer->fixed}}" style="background: <?= Session::get('site_color') ?> !important">
            {{__('messages.shop_now')}}
            </a>
            @endif
         </div>
         </div>
      </div>
      @endif
      @endforeach
   </div>
</div>
<div class="container">
   <div class="services-main">
      <div class="row">
         <div class="col-md-3 col-6 services">
            <div class="ser-img" style="background: <?= Session::get('site_color') ?> !important"></div>
            <h1>{{__('messages.free_delivery')}}</h1>
            <p>{{__('messages.home_note_4')}}</p>
         </div>
         <div class="col-md-3 col-6 services">
            <div class="ser-img-1" style="background: <?= Session::get('site_color') ?> !important"></div>
            <h1>{{__('messages.home_note_5')}}</h1>
            <p>{{__('messages.Feedbacks')}}</p>
         </div>
         <div class="col-md-3 col-6 services">
            <div class="ser-img-2" style="background: <?= Session::get('site_color') ?> !important"></div>
            <h1>{{__('messages.Payment')}}</h1>
            <p>{{__('messages.secured_sys')}}</p>
         </div>
         <div class="col-md-3 col-6 services">
            <div class="ser-img-3" style="background: <?= Session::get('site_color') ?> !important"></div>
            <h1>{{__('messages.support')}}</h1>
            <p>{{__('messages.helpline')}} -{{$setting->helpline}}</p>
         </div>
      </div>
   </div>
</div>
<div class="container">
   <div class="sale-banner">
      <div class="row">
         @foreach($banner as $ba)
         @if($ba->id==1)
         <div class="col-md-6">
            <div class="sale-banner-1 overlay_main_2">
               <a href="{{url('productslist').'/0/'.$ba->subcategory.'/0/0'}}"> <img src="{{asset('public/upload/banner/image').'/'.$ba->Image}}" class="img-responsive"></a>
               <div class="overlay_2">
               </div>
               <div class="sale-b-text">
                  <h1>{{$ba->title}}</h1>
                  <p>{{$ba->subtitle}}</p>
                  <a href="{{url('productslist').'/0/'.$ba->subcategory.'/0/0'}}" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.shop_now')}}</a>
               </div>
            </div>
         </div>
         @endif   
         @endforeach
         <div class="col-md-6">
            @foreach($banner as $ba)
            @if($ba->id!=1&&$ba->id!=3)
            <div class="sale-banner-2 col-md-12 p-0 overlay_main_2">
               <a href="{{url('productslist').'/0/'.$ba->subcategory.'/0/0'}}"> <img src="{{asset('public/upload/banner/image').'/'.$ba->Image}}" class="img-responsive"></a>
               <div class="overlay_2">
               </div>
               <div class="sale-b-text">
                  <h1>{{$ba->title}}</h1>
                  <p>{{$ba->subtitle}}</p>
                  <a href="{{url('productslist').'/0/'.$ba->subcategory.'/0/0'}}" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.shop_now')}}</a>
               </div>
            </div>
            @endif   
            @if($ba->id!=1&&$ba->id!=2)
            <div class="sale-banner-3 col-md-12 p-0 overlay_main_2">
               <a href="{{url('productslist').'/0/'.$ba->subcategory.'/0/0'}}"> <img src="{{asset('public/upload/banner/image').'/'.$ba->Image}}" class="img-responsive"></a>
               <div class="overlay_2">
               </div>
               <div class="sale-b-text">
                  <h1>{{$ba->title}}</h1>
                  <p>{{$ba->subtitle}}</p>
                  <a href="{{url('productslist').'/0/'.$ba->subcategory.'/0/0'}}" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.shop_now')}}</a>
               </div>
            </div>
            @endif   
            @endforeach                
         </div>
      </div>
   </div>
</div>
<div class="container">
   <div class="product-heading">
      <h1>{{__('messages.best_selling')}}</h1>
   </div>
   <p id="bestcompare">
   <div class="product-slider">
      <div id="demo1">
         <div class="row pos">
            <div class="customNavigation"> 
               <a class="btn prev" onclick="prevdemo1()"><i class="fa fa-angle-left" aria-hidden="true"></i></a> 
               <a class="btn next" onclick="nextdemo1()"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
            <div id="owl-demo1" class="owl-carousel">
               <?php $k=1;?>
               @foreach($bestselling as $bt)
                  @if($bt["stock"]=='0')
                           <div class="out_of_sb">
                              <span>{{__('messages.outstock')}}</span>
                           </div>
                          @endif
               <div class="item col-md-12">
                  
                  <div class="home-bg">

                  <div class="img-background">

                     <figure class="preview-image">
                        
                        <a href="{{url('viewproduct/').'/'.$bt['id']}}"> <img src="{{asset('public/upload/product').'/'.$bt['basic_image']}}" class="img-responsive"></a>
                      
                        <div class="preview-image-overlay">
                           <button type="button" onclick="quickview('<?=$bt["id"]?>')">
                               {{__('messages.Quick View')}}
                           </button>
                        </div>

                     </figure>

                     <div class="img-text">

                        <label class="fancy-checkbox">
                             @if(Auth::id()!="")
                            <input type="checkbox" id="checkdata{{$k}}" name="checkdata" onclick="changewishlist('<?php echo $bt['id'];?>','checkdata{{$k}}')" <?=$bt['wish']==1? ' checked="checked"' : '';?>/>
                           @else
                            <input type="checkbox" onclick="removewishselect('checkdata{{$k}}')" id="checkdata{{$k}}" name="checkdata"  data-toggle="modal" data-target="#myModal"/>
                           @endif
                       
                         <big id="wishfavor{{$bt['id']}}"></big>
                        </label>
                          <i class="fa fa-spinner loadlconwish" aria-hidden="true" id="loading{{$bt['id']}}" ></i>

                        @if($bt['discount']!=0)
                        <span>{{$bt['discount']}}%</span>
                        @endif
                     </div>
                     <div class="text-s-box text-s-box-2">
                        <h1>{{$bt['name']}}</h1>
                        <span class="rating">
                        <?php for($i=0;$i<$bt['ratting'];$i++){ ?>
                        <i class="fa fa-star" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                        <?php }?>
                        <?php for($i=0;$i<(5-$bt['ratting']);$i++){ ?>
                        <i class="fa fa-star-o" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                        <?php }?>
                        </span>
                        <span class="review">
                        ({{$bt['total_review']}} {{__('messages.review')}})
                        </span>
                        <span class="compare_icon"> 
                           <a href="javascript:addcomapre('<?=$bt['id']?>','bestcompare')"><img src="{{asset('public/Ecommerce/images/compare.png')}}"></a>
                        </span>
                        <div class="price">
                           <h2>{{Session::get("currency")}}{{$bt['price']}}</h2>
                           <span >{{Session::get("currency")}}{{$bt['MRP']}}</span>
                             @if($bt["stock"]=='1')
                           <a href="{{url('viewproduct/').'/'.$bt['id']}}" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.shop_now')}}</a>
                           @endif
                        </div>
                     </div>
                  </div>                
               </div>
            </div>
               <?php $k++;?>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</div>
@if($sen_offer)
<?php $coll_img=asset('public/upload/offer/image').'/'.$sen_offer->banner;?>
<div class="summer-banner" style="background-image: url('{{$coll_img}}')">
   <div class="container sum-box">
      <div class="summer-text">
         <h1>{{__('messages.up_to')}} {{$sen_offer->fixed_to}}% {{__('messages.home_note_2')}}</h1>
         <p>{{$sen_offer->title}}</p>
         <a href="{{url('productslist').'/'.$sen_offer->category.'/0/0'.'/'.$sen_offer->fixed_to}}" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.shop_now')}}</a>
      </div>
   </div>
</div>
@endif
@if($sepical_cat)
<div class="container">
   <div class="one-product-slider">
      <div class="row">
         <div class="col-md-6">
            <div id="demo1" class="carousel slide slides" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <a href="{{url('productslist').'/'.$sepical_cat->category_id.'/0/0/0'}}"> <img src="{{asset('public/upload/category/image/').'/'.$sepical_cat->image}}" alt="Los Angeles" class="img-responsive"></a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="one-product-text">
               <h1>{{$sepical_cat->title}}</h1>
               <p>{{$sepical_cat->description}}
               </p>
               <a href="{{url('productslist').'/'.$sepical_cat->category_id.'/0/0/0'}}" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.shop_now')}}</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endif
<div class="container">
   <div class="product-heading">
      <h1>{{__('messages.feature_product')}}</h1>
   </div>
   <p id="featurecompare">
   <div class="product-slider">
      <div id="demo">
         <div class="row pos">
            <div class="customNavigation"> 
               <a class="btn prev" onclick="prevowl()"><i class="fa fa-angle-left" aria-hidden="true"></i></a> 
               <a class="btn next" onclick="nextowl()"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
            <div id="owl-demo" class="owl-carousel">
               <?php $k=1;?>
               @foreach($featurepro as $fe)
               
               <div class="item col-md-12">
                  @if($fe->productdata->stock=='0')
                           <div class="out_of_sb">
                              <span>{{__('messages.outstock')}}</span>
                           </div>
                          @endif
                  <div class="home-bg">
                  <div class="img-background" >
                     <figure class="preview-image">
                        <a href="{{url('viewproduct/').'/'.$fe->productdata->id}}"> <img src="{{asset('public/upload/product').'/'.$fe->productdata->basic_image}}" class="img-responsive"></a>
                        <div class="preview-image-overlay">
                           <button type="button" onclick="quickview('{{$fe->productdata->id}}')">
                              {{__('messages.Quick View')}}
                           </button>
                        </div>
                     </figure>
                     <div class="img-text">
                        <label class="fancy-checkbox">
                             @if(Auth::id()!="")
                              <input type="checkbox" id="checkfe{{$k}}" name="checkdata" onclick="changewishlist('{{$fe->productdata->id}}','checkfe{{$k}}')" <?=$fe->wish==1? ' checked="checked"' : '';?>/>
                             @else
                              <input type="checkbox" id="checkfe{{$k}}" name="checkdata"  onclick="removewishselect('checkfe{{$k}}')" data-toggle="modal" data-target="#myModal"/>
                             @endif
                        <big id="wishfavor{{$fe->productdata->id}}"></big>
                        </label>
                        <i class="fa fa-spinner loadlconwish" aria-hidden="true" id="loading{{$fe->productdata->id}}"></i>
                        @if($fe->productdata->discount!=0)
                        <span>{{$fe->productdata->discount}}%</span>
                        @endif
                     </div>
                  </div>
                  <div class="text-s-box text-s-box-2">
                     <h1>{{$fe->productdata->name}}</h1>
                     <span class="rating">
                     <?php for($i=0;$i<$fe->productdata->avgStar;$i++){ ?>
                     <i class="fa fa-star" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                     <?php }?>
                     <?php for($i=0;$i<(5-$fe->productdata->avgStar);$i++){ ?>
                     <i class="fa fa-star-o" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                     <?php }?>
                     </span>
                     <span class="review">
                     ({{$fe->total_review}} {{__('messages.review')}})
                     </span>
                     <span class="compare_icon"> 
                        <a href="javascript:addcomapre('<?=$fe->product_id?>','featurecompare')"><img src="{{asset('public/Ecommerce/images/compare.png')}}"></a>
                     </span>
                     <div class="price">
                        <h2>{{Session::get("currency")}}{{$fe->productdata->selling_price}}</h2>
                        <span >{{Session::get("currency")}}{{$fe->productdata->MRP}}</span>
                        @if($fe->productdata->stock=='1')
                        <a href="{{url('viewproduct/').'/'.$fe->product_id}}" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.shop_now')}}</a>
                        @endif
                     </div>
                  </div> 
               </div>
            </div>
               <?php $k++;?>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</div>
@stop