@extends('user.index')
@section('title')
{{__('messages.product_ls')}}
@stop
@section('content')
<style type="text/css">
   input.my-checkbox:checked{
      background-color:<?= Session::get('site_color') ?> !important;
   }
</style>
 <div class="loader"  id="loader"></div>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="shop-color">
   <div class="container my-container">
      <div class="row">
         <div class="shop-filter">
            <div class="ep-fillter">
               <input type="hidden" name="code" id="code_search" value="<?=isset($_GET['cd'])?$_GET['cd']:''; ?>" />
               <input type="hidden" name="search" id="search" value="<?=isset($_GET['s'])?$_GET['s']:''; ?>" />
               <div class="brands">
                  <button type="button" class="btn" data-toggle="collapse" data-target="#demo12">{{__('messages.subcategory')}}
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </button>
                  <div id="demo12" class="collapse show">
                     <?php $i=0;?>
                     @foreach($lssub as $sub)
                     <div class="brand-check">
                        <div class="check-shop">
                           <input type="radio" class="my-checkbox" value="{{$sub->id}}" id="subcategory{{$i}}" name="subcategory" <?=$subcategory ==$sub->id ? ' checked="checked"' : '';?>  onclick="changefilter(1,'{{$i}}','{{$sub->id}}')">
                           <lable>{{$sub->name}}</lable>
                        </div>
                     </div>
                     <?php $i++;?>
                     @endforeach
                     <input type="hidden" id="nosub" value="{{$i}}"/>
                  </div>
               </div>
               <div class="brands">
                  <button type="button" class="btn" data-toggle="collapse" data-target="#demo">{{__('messages.brands')}}
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </button>
                  <div id="demo" class="collapse show">
                     <div class="brand-check">
                         <?php $i=0;?>
                        @foreach($brandls as $brn)
                        <div class="check-shop">
                           <input type="radio" class="my-checkbox" value="{{$brn}}" name="brand" id="brand{{$i}}" <?=$brand ==$brn ? ' checked="checked"' : '';?> onclick="changefilter(4,'{{$i}}','{{$brn}}')">
                           <lable>{{$brn}}</lable>
                        </div>
                         <?php $i++;?>
                        @endforeach
                       
                        <input type="hidden" id="nobrand" value="{{$i}}"/>
                     </div>
                  </div>
               </div>
               @if(!empty($pricels))
               <div class="brands">
                  <button type="button" class="btn" data-toggle="collapse" data-target="#demo-2">{{__('messages.price')}}
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </button>
                  <div id="demo-2" class="collapse show">
                     <div class="brand-check">
                        <?php $i=0;?>
                        @foreach($pricels as $pls)
                        <div class="check-shop">
                           <input type="radio" class="my-checkbox" name="pricesel" id="pricesel{{$i}}" onclick="changefilter(3,'{{$i}}','{{$pls}}')" value="{{$pls}}">
                           <lable>{{$pls}}</lable>
                        </div>
                        <?php $i++; ?>
                        @endforeach
                        <input type="hidden" id="noprice" value="{{$i}}"/>
                     </div>
                  </div>
               </div>
               @endif
               <div class="brands">
                  <button type="button" class="btn" data-toggle="collapse" data-target="#demo-3">{{__('messages.review')}}
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </button>
                  <div id="demo-3" class="collapse show">
                     <div class="brand-check">
                        <div class="check-shop">
                           <input type="radio" class="my-checkbox" value="5" name="ratting" id="ratting4" onclick="changefilter(2,4,5)">
                           <lable>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                           </lable>
                        </div>
                        <div class="check-shop">
                           <input type="radio" class="my-checkbox" value="4" name="ratting" id="ratting3" onclick="changefilter(2,3,4)">
                           <lable>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important"aria-hidden="true"></i>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important"aria-hidden="true"></i>
                              <i class="fa fa-star-o" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                           </lable>
                        </div>
                        <div class="check-shop">
                           <input type="radio" class="my-checkbox" value="3" name="ratting" id="ratting2" onclick="changefilter(2,2,3)">
                           <lable>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star-o" style="color: <?= Session::get('site_color') ?> !important"aria-hidden="true"></i>
                              <i class="fa fa-star-o" style="color: <?= Session::get('site_color') ?> !important"aria-hidden="true"></i>
                           </lable>
                        </div>
                        <div class="check-shop">
                           <input type="radio" class="my-checkbox" value="2" name="ratting" id="ratting1" onclick="changefilter(2,1,2)">
                           <lable>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star-o" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star-o" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star-o" style="color: <?= Session::get('site_color') ?> !important"aria-hidden="true"></i>
                           </lable>
                        </div>
                        <div class="check-shop">
                           <input type="radio" class="my-checkbox" value="1" name="ratting" id="ratting0" onclick="changefilter(2,0,1)">
                           <lable>
                              <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star-o" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star-o" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star-o" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                              <i class="fa fa-star-o" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                           </lable>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="brands">
                  <button type="button" class="btn" data-toggle="collapse" data-target="#demo-color">{{__('messages.color')}}
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </button>
                  <div id="demo-color" class="collapse show">
                     <div class="brand-radio">
                        <ul class="colors colorslist-1 checkboxcolor">
                           <?php $i=0;?>
                           @foreach($colorarr as $coarr)
                           <li id="changeli{{$i}}" onclick="changeactive('{{$i}}')">
                              <input type="radio" id="customcolor{{$i}}" name="colorchk" value="{{$coarr}}" onclick="changefilter(5,'{{$i}}','{{$coarr}}')" class="color-1" style="background:<?php echo $coarr;?>" >
                           </li>
                           <?php $i++;?>
                           @endforeach
                        </ul>
                        <input type="hidden" name="totalcolor" id="totalcolor" value="{{$i}}">
                     </div>
                  </div>
               </div>
               @if(!empty($pricels))
               <div class="brands">
                  <button type="button" class="btn" data-toggle="collapse" data-target="#demo-size">{{__('messages.Size')}}
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </button>
                  <div id="demo-size" class="collapse show">
                     <div class="brand-check">
                         <?php $i=0;?>
                        @foreach($sizearr as $pls)
                        <div class="check-shop">
                           <input type="radio" class="my-checkbox" name="sizechk" id="sizechk{{$i}}" onclick="changefilter(6,'{{$i}}','{{$pls}}')" value="{{$pls}}">
                           <lable>{{$pls}}</lable>
                        </div>
                        <?php $i++;?>
                        @endforeach
                         <input type="hidden" name="totalsize" id="totalsize" value="{{$i}}">
                     </div>
                  </div>
               </div>
               @endif
            </div>
         </div>
         <div class="product">
            <div class="shop-head">
               <input type="hidden" name="categoryid" id="categoryid" value="<?=isset($categorydata->id)?$categorydata->id:'0'; ?>">
               <input type="hidden" name="discount" id="discount" value="{{$discount}}">
               <h1><a href="{{url('/')}}" style="color: <?= Session::get('site_color') ?> !important">{{__('messages.home')}} </a>/<?=isset($categorydata->name)?$categorydata->name:''; ?> </h1>
               <p><span id="totalresult">{{__('messages.show_note1')}} {{count($productlist)}} {{__('messages.pro_of')}} {{count($productlist)}} {{__('messages.product')}} </span><span id="searchme"><?=isset($_GET['cd'])?"<b>".__('messages.coupon').":</b>".$_GET['cd']:''; ?></span><span id="search"><?=isset($_GET['s'])?"<b>".__('messages.search').":</b>".$_GET['s']:''; ?></span>
               <div class="Sort"></p>
                  <ul>
                     <h1>{{__('messages.sort_by')}} :</h1>
                     <li><a id="sort1" href="javascript:void(0);" class="active-2" onclick="changesort(1)">{{__('messages.Popalarity')}}</a></li>
                     <li><a id="sort2" href="javascript:void(0);" onclick="changesort(2)">{{__('messages.PLTH')}}</a></li>
                     <li><a id="sort3" href="javascript:void(0);" onclick="changesort(3)">{{__('messages.PHTL')}}</a></li>
                     <li><a id="sort4" href="javascript:void(0);" onclick="changesort(4)">{{__('messages.newest')}}</a></li>
                  </ul>
               </div>
            </div>
            <p id="productfiltercompare">
            <div class="shop-product" id="productlistdata">
               <?php $k=1;?>
               @foreach($productlist as $p)
               <div class="pro-1" >
                  <div class="product-box">
                    @if($p->stock=='0')
                     <div class="out_of_sb-w">
                        <span>{{__('messages.outstock')}}</span>
                     </div>
                    @endif
                     <div class="pro-img">
                          <figure class="preview-image">
                        <a href="{{url('viewproduct/').'/'.$p->id}}"> <img src="{{asset('public/upload/product').'/'.$p->basic_image}}" class="img-responsive"></a>
                        <div class="preview-image-overlay">
                           <button type="button" onclick="quickview('{{$p->id}}')">
                                {{__('messages.Quick View')}}
                           </button>
                        </div>
                     </figure>
                  
                        <div class="img-text">
                           <label class="fancy-checkbox">
                               @if(Auth::id()!="")
                           <input type="checkbox" id="checkda{{$k}}" name="checkdata" onclick="changewishlist('{{$p->id}}','checkda{{$k}}')" <?=$p->wish==1? ' checked="checked"' : '';?>/>
                           @else
                            <input type="checkbox" id="checkda{{$k}}" name="checkdata"  onclick="removewishselect('checkda{{$k}}')" data-toggle="modal" data-target="#myModal"/>
                           @endif
                          <big id="wishfavor{{$p->id}}"></big>
                           </label>
                           <i class="fa fa-spinner loadlconwish" aria-hidden="true" id="loading{{$p->id}}" ></i>
                           <span>{{$p->disper}}%</span>
                        </div>
                     </div>
                     <div class="text-s-box">
                        <h1>{{$p->name}}</h1>
                        <span class="rating">
                        <?php for($i=0;$i<$p->avgStar;$i++){ ?>
                        <i class="fa fa-star" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                        <?php }?>
                        <?php for($i=0;$i<(5-$p->avgStar);$i++){ ?>
                        <i class="fa fa-star-o" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                        <?php }?>
                        </span>
                        <span class="review">
                        ({{$p->total_review}} {{__('messages.review')}})
                        </span>
                        <span class="compare_icon"> 
                           <a href="javascript:addcomapre('<?=$p->id?>','productfiltercompare')"><img src="{{asset('public/Ecommerce/images/compare.png')}}"></a>
                        </span>
                        <div class="price">
                           <h2>{{Session::get("currency")}}{{$p->price}}</h2>
                           <span >{{Session::get("currency")}}{{$p->MRP}}</span>
                             @if($p->stock!=='0')
                               <a href="{{url('viewproduct/').'/'.$p->id}}" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.shop_now')}}</a>
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
<input type="hidden" id="selpriceval"/>
<input type="hidden" id="selsubcat"/>
<input type="hidden" id="selbrand"/>
<input type="hidden" id="selratting"/>
<input type="hidden" id="selcolor"/>
<input type="hidden" id="selsize"/>
@stop
