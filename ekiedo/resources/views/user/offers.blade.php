@extends('user.index')
@section('title')
{{__('messages.site_name')}}
@stop
@section('content')
<style>
    .off-heading h1:before{
         background-color:<?= Session::get('site_color') ?> !important;
    }
    .off-heading h1:after{
        background-color:<?= Session::get('site_color') ?> !important;
    }
</style>
<div class="container">
   <div class="row nor-b">
      <?php $i=0?>
      @foreach($normaloffer as $no)
      <div class="col-md-4 col-12">
         <?php $path=asset("public/upload/offer/image/")."/".$no->banner?>
         <div class="normal1 text-off overlay_main" style="background-image:url('{{$path}}')">
             <div class="overlay">
            </div>
            <div class="off-ban">
            <h1 style="color: <?= Session::get('site_color') ?> !important">{{$no->title}}</h1>
            @if($no->is_product=='2')
            <p>{{__('messages.home_note_3')}}{{Session::get('currency')}}{{$no->new_price}}</p>
            @endif
            @if($no->is_product=='1')
            <p>{{__('messages.home_note_1')}}  {{$no->fixed}}% {{__('messages.home_note_2')}} </p>
            @endif
              @if($no->is_product=='3')
            <p>{{$no->coupon_code}}</p>
            @endif
            @if($no->is_product=='2')
            <a href="{{url('viewproduct').'/'.$no->product_id}}" style="background: <?= Session::get('site_color') ?> !important">
            {{__('messages.shop_now')}}
            </a>
            @endif
            @if($no->is_product=='1')
            <a href="{{url('productslist').'/0/'.$no->category_id.'/0'.'/'.$no->fixed}}" style="background: <?= Session::get('site_color') ?> !important">
            {{__('messages.shop_now')}}
            </a>
            @endif
             @if($no->is_product=='3')

            <a href="{{url('productslist').'/0/0/0/0/'.'?cd='.$no->coupon_code}}" style="background: <?= Session::get('site_color') ?> !important">
            {{__('messages.shop_now')}}
            </a>
            @endif

         </div>
         </div>
      </div>
      <?php $i++;?>
      @endforeach
   </div>
</div>
<div class="container">
   <div class="off-heading">
      <h1>{{__('messages.best_offer')}}</h1>
   </div>
   <p id="offercompare">
   <div class="product-slider">
      <div id="demo1">
         <div class="row pos">
            <div class="customNavigation"> 
               <a class="btn prev" onclick="prevdemo2()"><i class="fa fa-angle-left" aria-hidden="true"></i></a> 
               <a class="btn next" onclick="nextdemo2()"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
            <div id="owl-demo2" class="owl-carousel">
               <?php $k=1;?>
               @foreach($getoffers as $fe)
               <div class="item col-md-12">
                  <div class="home-bg">
                      @if($fe->stock=='1')
                          <div class="out_of_sb">
                                                    <span>{{__('messages.outstock')}}</span>
                                                 </div>
                      @endif
                  <div class="img-background" >
                    
                       <figure class="preview-image">
                        <a href="{{url('viewproduct/').'/'.$fe->id}}"> <img src="{{asset('public/upload/product').'/'.$fe->basic_image}}" class="img-responsive"></a>
                        <div class="preview-image-overlay">
                           <button type="button" onclick="quickview('{{$fe->id}}')">
                              Quick View
                           </button>
                        </div>
                     </figure>
                     </a>
                     <div class="img-text">
                        <label class="fancy-checkbox">
                             @if(Auth::id()!="")
                              <input type="checkbox" id="checkfe{{$k}}" name="checkdata" onclick="changewishlist('{{$fe->id}}','checkfe{{$k}}')" <?=$fe->wish==1? ' checked="checked"' : '';?>/>
                             @else
                              <input type="checkbox" id="checkfe{{$k}}" name="checkdata"  onclick="removewishselect('checkfe{{$k}}')" data-toggle="modal" data-target="#myModal"/>
                             @endif 
                             <big id="wishfavor{{$fe->id}}"></big>
                        </label>
                        <i class="fa fa-spinner loadlconwish" aria-hidden="true" id="loading{{$fe->id}}" ></i>
                        @if($fe->discount!=0)
                        <span>{{$fe->discount}}%</span>
                        @endif
                     </div>
                  </div>
              
                   <div class="text-s-box text-s-box-2">
                     <h1>{{$fe->name}}</h1>
                     <span class="rating">
                        <?php for($i=0;$i<$fe->avgStar;$i++){ ?>
                        <i class="fa fa-star" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                        <?php }?>
                        <?php for($i=0;$i<(5-$fe->avgStar);$i++){ ?>
                        <i class="fa fa-star-o" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                        <?php }?>
                        </span>
                     <span class="review">
                     ({{$fe->total_review}} {{__('messages.review')}})
                     </span>
                     <span class="compare_icon"> 
                        <a href="javascript:addcomapre('<?=$fe->id?>','offercompare')"><img src="{{asset('public/Ecommerce/images/compare.png')}}"></a>
                     </span>
                     <div class="price">
                        <h2>{{Session::get('currency').$fe->selling_price}}</h2>
                        <span >{{Session::get("currency")}}{{$fe->MRP}}</span>
                         @if($fe->stock=='1')
                              <a href="{{url('viewproduct/').'/'.$fe->id}}" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.shop_now')}}</a>
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