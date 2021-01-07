@extends('user.index') @section('title')
{{__('messages.view_product_detail')}}
@stop
@section('content')
<script src='https://npmcdn.com/flickity@2/dist/flickity.pkgd.js'></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
<style type="text/css">
    .product-heading h1:after{
        background-color:<?= Session::get('site_color') ?> !important;
    }
    .product-heading h1:before{
         background-color:<?= Session::get('site_color') ?> !important;
    }
    .detail-information-tab ul.tabs li.active{
        border-bottom:3px solid <?= Session::get('site_color') ?> !important;
    }
    .detail-review-star .fa-star:before{
         color:<?= Session::get('site_color') ?> !important;
    }
    .rating>input:checked~label, .rating:not(:checked)>label:hover, .rating:not(:checked)>label:hover~label{
        color:<?= Session::get('site_color') ?> !important;
    }
    .detail-information-tab .d_active{
        background-color:<?= Session::get('site_color') ?> !important;
    }
</style>

</div>
<div class="container">
    <div class="detail-product">
        <p id="msgrev"></p>
         @if(Session::has('message'))
                              <div class="col-sm-12">
                                 <div class="alert  {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">{{ Session::get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                              </div>
                              @endif
        <div class="row">
            <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}" />
            <div class="col-lg-6 col-md-6">
             <div class="carousel carousel-main" data-flickity='{"pageDots": false }'>
  <div class="carousel-cell"><img class="block__pic" src="{{asset('public/upload/product').'/'.$product->basic_image}}"/></div>
            <?php $i=1;$add_img=explode(",",$product->additional_image);?>
            @if(!empty(array_filter($add_img)))
                @foreach($add_img as $ad)
                     <div class="carousel-cell"><img class="block__pic" src="{{asset('public/upload/product').'/'.$ad}}"/></div>
                <?php $i++;?>
                @endforeach
            @endif
 
</div>

<div class="carousel carousel-nav"
  data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
  <div class="carousel-cell"><img class="thumbimg"  src="{{asset('public/upload/product').'/'.$product->basic_image}}"/></div>
            <?php $i=1;$add_img=explode(",",$product->additional_image);?>
             @if(!empty(array_filter($add_img)))
            @foreach($add_img as $ad)
                 <div class="carousel-cell"><img class="thumbimg"  src="{{asset('public/upload/product').'/'.$ad}}"/></div>
            <?php $i++;?>
            @endforeach
               @endif
</div>
        
            </div>
          <div class="col-lg-6 col-md-6">
                <div class="detail-product-text">
                    <div class="detail-product-head">
                        <input type="hidden" name="productname" id="productname" value="{{$product->name}}">
                        <h2>{{$product->name}}</h2>
                     <p>{{$currency}}<span id="order_price">{{$product->selling_price}}</span></p>
                        <input type="hidden" name="product_price" id="product_price" value="{{$product->selling_price}}">
                        <input type="hidden" name="new_price" id="new_price" value="{{$product->selling_price}}">
                        
                           <p id="mrppro">{{Session::get('currency')}}<span class="td1">{{$product->MRP}}</span></p>
                    </div>
                    <div>
                        {{$product->new_desc}}<a href="#information" >{{__('messages.Read More')}}</a>
                    </div>
                    <div class="detail-review-box">
                        <div class="detail-review-star">
                            <?php for($i=0;$i<$productstar;$i++){ ?>
                                <i class="fa fa-star" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                                <?php }?>
                                    <?php for($i=0;$i<(5-$productstar);$i++){ ?>
                                        <i class="fa fa-star-o" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                                        <?php }?>
                        </div>
                        <div class="detail-review-people">
                            <p>({{$product->totalreview}} {{__('messages.cus')}} {{__('messages.review')}})</p>
                        </div>
                    </div>
                   
                    <?php  
                  if(isset($product->options)){
                      $options_name=explode(",",$product->options->name);
                      $options_type=explode(",",$product->options->type);
                      $option_required=explode(",", $product->options->is_required);
                      $label_option=explode("#",$product->options->label);
                      $price_option=explode("#",$product->options->price);
                      for($i=0;$i<count($options_name);$i++){
                        $label=explode(",",$label_option[$i]);
                        $price=explode(",",$price_option[$i]);
                        $required="";
                        if($option_required[$i]==1){
                           $required="required";
                        }
                      ?>
                        <input type="hidden" name="option_name[]" id="option_name{{$i}}" value="{{$options_name[$i]}}">
                        <input type="hidden" name="option_req[]" id="option_req{{$i}}" value="{{$required}}">
                        <input type="hidden" name="option_type[]" id="options_type{{$i}}" value="{{$options_type[$i]}}">
                        <div>
                            <p class="detail-head col-md-12">
                                {{$options_name[$i]}} @if($required=="required")
                                <span class="req_field">*</span> @endif
                            </p>
                            @if($options_type[$i]==1)
                            <ul class="col-md-12 sizes">
                                <li>
                                    <select name="option_ls[{{$i}}][]" id="option_ls{{$i}}" class="custom-select" onchange="changetotalamount('1')">
                                        <option value="">Select</option>
                                        <?php for($j=0;$j<count($label);$j++){?>
                                            @if(isset($price[$j]))
                                              <option value="{{$label[$j]}}#{{$price[$j]}}">{{$label[$j]}}@if($price[$j]!="")({{$currency.$price[$j]}})@endif</option>
                                            @else
                                              <option value="{{$label[$j]}}#">{{$label[$j]}}</option>
                                            @endif
                                            <?php }?>
                                    </select>
                                </li>
                            </ul>
                            @endif
                            @if($options_type[$i]==2)
                                <ul class="col-md-12 sizes">
                                   <?php 
                                        for($j=0;$j<count($label);$j++){?>
                                            <li>
                                                <div class="custom-control custom-checkbox">
                                                    @if(isset($price[$j]))
                                                    <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}{{$j}}" name="option_ls{{$i}}" value="{{$label[$j]}}#{{$price[$j]}}" onchange="changetotalamount('2')">
                                                    <label class="custom-control-label" for="customCheck{{$i}}{{$j}}">{{$label[$j]}}@if($price[$j]!="")({{$currency.$price[$j]}})@endif</label>
                                                     @else
                                                      <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}{{$j}}" name="option_ls{{$i}}" value="{{$label[$j]}}#" onchange="changetotalamount('2')">
                                                    <label class="custom-control-label" for="customCheck{{$i}}{{$j}}">{{$label[$j]}}</label>
                                                     @endif
                                                </div>
                                            </li>
                                        <?php }?>
                                </ul>
                            @endif
                           @if($options_type[$i]==3)
                                <ul class="col-md-12 sizes">
                                    <?php for($j=0;$j<count($label);$j++){?>
                                            <div class="cost">
                                                <li>
                                                    <div class="custom-control custom-radio radio">
                                                        @if(isset($price[$j]))
                                                         <input type="radio" class="custom-control-input" id="customRadio{{$i}}{{$j}}" name="option_ls{{$i}}" value="{{$label[$j]}}#{{$price[$j]}}" onclick="changeradio('3','{{$label[$j]}}#{{$price[$j]}}','{{$i}}','{{$j}}')">
                                                        <label class="custom-control-label" for="customRadio{{$i}}{{$j}}">
                                                            {{$label[$j]}} @if($price[$j]!="") ({{$currency.$price[$j]}}) @endif
                                                        </label>
                                                        @else
                                                         <input type="radio" class="custom-control-input" id="customRadio{{$i}}{{$j}}" name="option_ls{{$i}}" value="{{$label[$j]}}#" onclick="changeradio('3','{{$label[$j]}}#','{{$i}}','{{$j}}')">
                                                        <label class="custom-control-label" for="customRadio{{$i}}{{$j}}">
                                                            {{$label[$j]}} 
                                                        </label>
                                                        @endif
                                                       
                                                    </div>
                                                </li>
                                            </div>
                                    <?php }?>
                                        <input type="hidden" id="previousradio{{$i}}">
                                </ul>
                            @endif
                            @if($options_type[$i]==4)
                                <ul class="col-md-12">
                                    <li>
                                        <select name="option_ls[]" id="option_ls{{$i}}" class="custom-select" multiple onchange="changetotalamount('4')">
                                            <?php for($j=0;$j<count($label);$j++){?>
                                                @if(isset($price[$j]))
                                                     <option value="{{$label[$j]}}#{{$price[$j]}}">{{$label[$j]}}@if($price[$j]!="")({{$currency.$price[$j]}})@endif</option>
                                                @else
                                                      <option value="{{$label[$j]}}#">{{$label[$j]}}</option>
                                                @endif
                                            <?php }?>
                                        </select>
                                    </li>
                                </ul>
                           @endif
                        </div>
                        <?php  } } ?>
                            <input type="hidden" name="reqerror" id="reqerror" value="0">
                            <input type="hidden" name="total_option" id="total_option" value="{{$i}}" />
                            <div class="detail-qty-button" style="border-color: <?= Session::get('site_color') ?> !important">
                                <div class="number">
                                    <span class="qty-mp minus" onclick="changeqty('-1')" style="background: <?= Session::get('site_color') ?> !important"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                    <input type="text" value="1" id="qty-nu" name="pro_qty" onchange="changeproprice(this.value)" />
                                    <span class="qty-mp plus" onclick="changeqty('1')" style="background: <?= Session::get('site_color') ?> !important"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </div>
                            </div>
                         
                                  @if($product->stock=='1')
                                     <a href="javascript:addtocart()">
                                        <div class="detail-add-cart" style="background: <?= Session::get('site_color') ?> !important">
                                           {{__('messages.add_to_cart')}}
                                        </div>
                                    </a>
                                  @else
                                     <a href="#">
                                       <div class="detail-add-cart " style="background: <?= Session::get('site_color') ?> !important">
                                           {{__('messages.outstock')}}
                                        </div>
                                    </a>
                                  @endif
                           
                            <div class="detail-info">
                                <div class="detail-info-wishlist">
                                    <label class="fancy-checkbox">
                                          @if(Auth::id()!="")
                                        <input type="checkbox" id="checkdataview0" name="checkdata" <?=$product->wish==1? ' checked="checked"' : '';?> onclick="changewishlist('<?php echo $product->id;?>','checkdataview0')" />
                                         @else
                                            <input type="checkbox" onclick="removewishselect('checkdataview0')" id="checkdataview0" name="checkdata"  data-toggle="modal" data-target="#myModal"/>
                                        @endif
                                        <big id="wishfavor{{$product->id}}"></big>
                                    </label>
                                     
                                    <p>{{__('messages.add_to_wishlist')}}</p>
                                  </br>
                                    <span>
                                      <a href="javascript:addcomapre('<?=$product->id?>','msgrev')"><img src="{{asset('public/Ecommerce/images/compare.png')}}" class="compareimg"></a>
                                     </span>
                                    <p class="pd10com">{{__('messages.Compare')}}</p>

                                </div>
                                <div class="detail-information">
                                    <h2>{{__('messages.SKU')}} :</h2>
                                    <h4>{{$product->sku}}</h4>
                                </div>
                                <div class="detail-information">
                                    <h2>{{__('messages.cate_gory')}} :</h2>
                                    <h4>{{$product->category}}/{{$product->subcategory}}</h4>
                                </div>
                                <div class="detail-information">
                                    <h2>{{__('messages.Tags')}} :</h2>
                                    <h4>{{$product->meta_keyword}}</h4>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" id="information">
    <div class="detail-information-tab">
        <ul class="tabs">
            <li class="active" rel="tab1" id="reltab1" onclick="changeproducttab(1)">{{__('messages.description')}}</li>
            <li rel="tab2" id="reltab2" onclick="changeproducttab(2)">{{__('messages.add_info')}}</li>
            <li rel="tab3" id="reltab3" onclick="changeproducttab(3)">{{__('messages.review')}}</li>
        </ul>
        <div class="tab_container">
            <h3 class="d_active tab_drawer_heading" rel="tab1" id="hredtab1" onclick="changeproducttab(1)">{{__('messages.description')}}</h3>
            <div id="tab1" class="tab_content">
                <div class="des_content">
                    <p>
                        <?php echo html_entity_decode($product->description);?>
                    </p>
                </div>
            </div>
            <h3 class="tab_drawer_heading" rel="tab2" id="hredtab2" onclick="changeproducttab(2)">{{__('messages.add_info')}}</h3>
            <div id="tab2" class="tab_content">
                <div class="addi">
                    <table class="addi-h" style="background: <?= Session::get('site_color') ?> !important">
                        <tr>
                            <th class="spe">{{__('messages.attributeset')}}</th>
                            <th class="brand">{{__('messages.attribute')}}</th>
                            <th class="sams">{{__('messages.value')}}</th>
                        </tr>
                    </table>
                    <table class="addi-sub">
                       @if(isset($product->attributes))
                        @foreach($product->attributes as $attr)
                        <tr>
                            <td class="spe-1">{{$attr->attributeset}}</td>
                            <?php
                                  $labelarr=explode(",", $attr->attribute);
                                  $valuesarr=explode(",",$attr->value);
                             ?>
                            <td class="brand-1">
                                <div class="types">
                                    <ul>
                                        @foreach($labelarr as $l)
                                        <li>{{$l}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                            <td class="sams-1">
                                <div class="types desa">
                                    <ul>
                                        @foreach($valuesarr as $v)
                                        <li>{{$v}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
                <div class="res-addi" >
                  @if(isset($product->attributes))
                   @foreach($product->attributes as $attr)
                    <div class="res-spe">
                        <h1 style="background-color:<?= Session::get('site_color') ?> !important;">{{__('messages.attributeset')}}</h1>
                        <div class="tital">
                            <h2>{{__('messages.attribute')}}</h2>
                            <p>{{__('messages.value')}}</p>
                        </div>
                    </div>
                    <div class="res-spe">
                        @foreach($product->attributes as $attr)
                        <h1 style="background-color:<?= Session::get('site_color') ?> !important;">{{$attr->attributeset}}</h1>
                        <div class="tital tal">
                          <?php 
                                  $labelarr=explode(",", $attr->attribute);
                                  $valuesarr=explode(",",$attr->value);
                          ?>
                            <?php for($k=0;$k<count($labelarr);$k++){?>
                            <h2>{{$labelarr[$k]}}</h2>
                            <p>{{$valuesarr[$k]}}</p>
                            <?php } ?>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <h3 class="tab_drawer_heading" rel="tab3" id="hredtab3" onclick="changeproducttab(3)">{{__('messages.review')}}</h3>
            <div id="tab3" class="tab_content">
                <div class="detail-review-tab">
                    <h3 class="detail-review-head">{{__('messages.review')}}</h3>
                    <div class="detail-review-user-box">
                        @foreach($product->review as $re)
                        <div class="review-user-box" data-aos="zoom-in">
                            <div class="review-user-img">
                                <?php 
                        $external_link = asset('upload/profile'.'/'.$re->userdata->profile_pic);
                           if (@GetImageSize($external_link)) {
                                 $image = $external_link;
                           } else {
                                    $image = asset('public/Ecommerce/images/profile.png');
                           }?>
                                    <img src="{{$image}}" width="100px" height="75px">
                            </div>
                            <div class="review-user-text">
                               
                                    <div class="detail-review-people-1">
                                        @for($i=0;$i<$re->ratting;$i++)
                                         <i class="fa fa-star" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                                        @endfor
                                      
                                          @for($i=0;$i<5-$re->ratting;$i++)
                                         <i class="fa fa-star-o" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                                        @endfor
                                    </div>
                                    <div class="review-user-content">
                                        <h3>{{__('messages.by')}} <span class="reviewname">{{$re->userdata->first_name}} {{$re->userdata->last_name}}</span> {{__('messages.on')}} {{date('F d,Y',strtotime($re->created_at))}}</h3>
                                        <p>{{urldecode($re->review)}}</p>
                                    </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="detail-review-box2">
                        <h2 class="detail-review-underline">{{__('messages.review_note')}}</h2>
                        <p id="msgrev"></p>
                        <div class="detail-review-rating-box">
                            <div class="detail-review-star2">
                                <p>{{__('messages.your_ratting')}}</p>
                            </div>
                            <div class="detail-review-people2 rating">
                                <input type="radio" id="star5" class="radiobtn" name="rating[]" value="5" />
                                <label class="full" for="star5"></label>
                                <input type="radio" id="star4" class="radiobtn" name="rating[]" value="4" />
                                <label class="full" for="star4"></label>
                                <input type="radio" id="star3" class="radiobtn" name="rating[]" value="3" />
                                <label class="full" for="star3"></label>
                                <input type="radio" id="star2" class="radiobtn" name="rating[]" value="2" />
                                <label class="full" for="star2"></label>
                                <input type="radio" id="star1" class="radiobtn" name="rating[]" value="1" />
                                <label class="full" for="star1"></label>
                            </div>
                        </div>
                    </div>
                    <div class="detail-review-form">
                        <label>{{__('messages.your_ratting')}}</label>
                        <br>
                        <textarea id="reviewtext" name="reviewtext"></textarea>
                    </div>
                    @if(isset($userdata->id))
                    <div class="deta-but">
                      
                        <button class="detail-review-submit" onclick="storereview()" style="background: <?= Session::get('site_color') ?> !important">
                            {{__('messages.submit')}}
                        </button>
                      
                    </div>
                    @endif @if(!isset($userdata->id))
                    <div class="detail-review-submit" style="background: <?= Session::get('site_color') ?> !important">
                        <a href="#" data-toggle="modal" data-target="#myModal" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.submit')}}
                         </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="product-heading">
        <h1>{{__('messages.related_product')}}</h1>
    </div>
    <p id="realtecompare">
    <div class="product-slider">
        <div id="demo1">
            <div class="row pos">
                <div class="customNavigation">
                    <a class="btn prev" onclick="prevdemo1()"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                    <a class="btn next" onclick="nextdemo1()"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
                <div id="owl-demo1" class="owl-carousel ">
                    @if(!empty($product->related_product))
                    <?php $k=0;?>
                        @foreach($product->related_product as $realt)
                        <div class="item col-md-12 ">
                            <div class="home-bg">
                                 @if($realt->stock=='0')
                                                 <div class="out_of_sb">
                                                    <span>{{__('messages.outstock')}}</span>
                                                 </div>
                                                @endif
                            <div class="img-background">
                                <a href="{{url('viewproduct/').'/'.$realt->id}}"> <img src="{{asset('public/upload/product').'/'.$realt->basic_image}}" class="img-responsive" ></a>
                                <div class="img-text">
                                    <label class="fancy-checkbox">
                                        @if(Auth::id()!="")
                                         <input type="checkbox" id="checkrelat{{$k}}" name="checkrelat" onclick="changewishlist('<?php echo $realt->id;?>','checkrelat{{$k}}')" <?=$realt->wish==1? ' checked="checked"' : '';?>/>
                                        @else
                                         <input type="checkbox" id="checkrelat{{$k}}" name="checkrelat" data-toggle="modal" data-target="#myModal"/>
                                        @endif
                                        <big id="wishfavor{{$realt->id}}"></big>
                                    </label>
                                     <i class="fa fa-spinner loadlconwish" aria-hidden="true" id="loading{{$realt->id}}" ></i>
                                    @if($realt->discount!=0)
                                    <span>{{$realt->discount}}%</span> @endif
                                </div>
                            </div>
                            <div class="product-text">
                                <h1>{{$realt->name}}</h1>
                                <div class="price">
                                    <h2>{{$currency}}{{$realt->selling_price}}
                           @if($realt->discount!=0)
                           <span class="realtd"> {{$currency.$realt->MRP}}</span>
                           @endif
                        </h2>

                                    <span class="rating">
                         <?php for($i=0;$i<$realt->avgStar;$i++){ ?>
                        <i class="fa fa-star" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                        <?php }?>
                        <?php for($i=0;$i<(5-$realt->avgStar);$i++){ ?>
                        <i class="fa fa-star-o" style="color: <?= Session::get('site_color') ?> !important" aria-hidden="true"></i>
                        <?php }?>
                        </span>
                         <span class="compare_icon"> 
                        <a href="javascript:addcomapre('<?=$realt->id?>','realtecompare')"><img src="{{asset('public/Ecommerce/images/compare.png')}}"></a>
                     </span>
                                </div>
                                  @if($realt->stock=='1')
                                                <a href="{{url('viewproduct/').'/'.$realt->id}}" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.shop_now')}}</a>
                                                @endif
                            </div>
                            </div>
                        </div>
                        <?php $k++;?>
                            @endforeach
                            @else
                              
                             <?php $k=0;?>
                                  @foreach($productdata as $realt)
                                   @if($realt->category==$product->category_id&&$realt->subcategory==$product->subcategory_id)
                                   <div class="item col-md-12 ">
                                            <div class="home-bg">
                                               @if($realt->stock=='0')
                                                 <div class="out_of_sb">
                                                    <span>{{__('messages.outstock')}}</span>
                                                 </div>
                                                @endif
                                            <div class="img-background">
                                                <a href="{{url('viewproduct/').'/'.$realt->id}}"> <img src="{{asset('public/upload/product').'/'.$realt->basic_image}}" class="img-responsive" ></a>
                                                <div class="img-text">
                                                    <label class="fancy-checkbox">
                                                        @if(Auth::id()!="")
                                                         <input type="checkbox" id="checkrelat{{$k}}" name="checkrelat" onclick="changewishlist('<?php echo $realt->id;?>','checkrelat{{$k}}')" <?=$realt->wish==1? ' checked="checked"' : '';?>/>
                                                        @else
                                                         <input type="checkbox" id="checkrelat{{$k}}" name="checkrelat" data-toggle="modal" data-target="#myModal"/>
                                                        @endif
                                                        <big id="wishfavor{{$realt->id}}"></big>
                                                    </label>
                                                       <i class="fa fa-spinner loadlconwish" aria-hidden="true" id="loading{{$realt->id}}" ></i>
                                                    @if($realt->discount!=0)
                                                    <span>{{$realt->discount}}%</span> @endif
                                                </div>
                                            </div>
                                           <div class="text-s-box text-s-box-2">
                     <h1>{{$realt->name}}</h1>
                     <span class="rating">
                     <?php for($i=0;$i<$realt->avgStar;$i++){ ?>
                     <i class="fa fa-star" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                     <?php }?>
                     <?php for($i=0;$i<(5-$realt->avgStar);$i++){ ?>
                     <i class="fa fa-star-o" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                     <?php }?>
                     </span>
                     <span class="review">
                     ({{$realt->total_review}} {{__('messages.review')}})
                     </span>
                     <span class="compare_icon"> 
                        <a href="javascript:addcomapre('<?=$realt->id?>','realtecompare')"><img src="{{asset('public/Ecommerce/images/compare.png')}}"></a>
                     </span>
                     <div class="price">
                        <h2>{{Session::get("currency")}}{{$realt->selling_price}}</h2>
                        <span >{{Session::get("currency")}}{{$realt->MRP}}</span>
                        @if($realt->stock=='1')
                        <a href="{{url('viewproduct/').'/'.$realt->id}}" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.shop_now')}}</a>
                        @endif
                     </div>
                  </div> 
                                            </div>
                                        </div>
                                        
                                         <?php $k++;?>
                                       @endif  
                                  @endforeach
                            @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop