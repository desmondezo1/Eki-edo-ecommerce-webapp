@extends('user.index')
@section('title')
{{__('messages.My_Cart')}}
@stop
@section('content')
<div class="container">
   <div class="cart-heading">
      <h1>{{__('messages.My_Cart')}}</h1>
      <span>{{__('messages.home')}} / {{__('messages.My_Cart')}}</span>
   </div>
   <div class="cart-detail">
      <table id="mycart">
         <tr class="pro-heading" style="background: <?= Session::get('site_color') ?> !important">
            <th>{{__('messages.del')}}</th>
            <th>{{__('messages.images')}}</th>
            <th>{{__('messages.product')}}</th>
            <th>{{__('messages.price')}}</th>
            <th>{{__('messages.Quanitity')}}</th>
            <th>{{__('messages.total')}}</th>
         </tr>
         <?php $cartCollection = Cart::getContent();$i=0;?>
         @if($cartCollection->count()!=0)
         @foreach($cartCollection as $item)
         <tr>
            <td class="Delete-icon">
               <a href="javascript:deletecartitem('{{$item->id}}')"><i class="fa fa-trash-o" aria-hidden="true"></i>   
               <span>{{__('messages.del')}} :</span></a>
            </td>
            <td class="cart-img">
               @foreach($productdata as $hs)
               @if($hs->id==$item->id)
               <img src="{{asset('public/upload/product').'/'.$hs->basic_image}}" width="75" height="auto">
               @endif
               @endforeach
               <span>{{__('messages.images')}} :</span>
            </td>
            <td class="cartpro-text">
               <span>{{__('messages.product')}} :</span>
               {{$item->name}}
                <?php $option=explode(",",$item->attributes[0]['option']);
                                                   $label=explode(",",$item->attributes[0]['label']);
                                                   $price=explode(",",$item->attributes[0]['price']);
                                                  ?>
                                               
                                                   <?php for($i=0;$i<count($option);$i++){?>
                                                   </br><p style="font-size:small"><b>{{$option[$i]}}</b>=>{{$label[$i]}}</p>
                                                   <?php }?>
            </td>
            <td class="price">
               <p>{{Session::get('currency')}}</p>
               <circle id="pricecart{{$i}}">{{number_format((float)$item->price, 2, '.', '')}}</circle>
               <span>{{__('messages.price')}} :</span>
            </td>
            <td class="Quanitity">
               <div class="qut-box">
                  <button>
                  <i class="minus" aria-hidden="true" onclick="usqty('{{$i}}',0,'{{$item->id}}')">-</i>
                  </button>
                  <input type="text" name="text" id="quantity{{$i}}" placeholder="1" value="{{$item->quantity}}">
                  <button>
                  <i class="plus" aria-hidden="true" onclick="usqty('{{$i}}',1,'{{$item->id}}')">+</i>
                  </button>
               </div>
               <span>{{__('messages.Quanitity')}} :</span>
            </td>
            <?php $total=$item->price*$item->quantity;?>
            <td class="total">
               {{Session::get('currency')}}
               <circle id="totalprice{{$i}}">{{number_format((float)$total, 2, '.', '')}}</circle>
               <span>{{__('messages.total')}} :</span>
            </td>
         </tr>
         <?php $i++;?>
         @endforeach
         @else
              <tr><td colspan="6" class="emptywish">{{__('messages.cart_empty')}}</td></tr>
         @endif
      </table>
      <input type="hidden" name="coupon_discount_type" id="coupon_discount_type" value="0" />
      <input type="hidden" name="coupon_discount_value" id="coupon_discount_value" value="0" />
      <input type="hidden" name="coupon_min_value" id="coupon_min_value" value="" />
      <input type="hidden" name="coupon_max_value" id="coupon_max_value" value="" />
      <div class="continue">
         <a href="{{url('/')}}" style="color: <?= Session::get('site_color') ?> !important">{{__('messages.continue_shopping')}}
         <i class="fa fa-long-arrow-right" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
         </a>
      </div>
   </div>
   <?php
         if($cartCollection->count()==0){
             $class="is-hide";
         }
         else{
             $class="";
         }
   ?>
   
   <div class="other-detail {{$class}}" id="coupon_section">
      <div class="row">
         <div class="col-md-6">
            <div class="coupon">
               <h1 style="background: <?= Session::get('site_color') ?> !important">{{__('messages.coupon')}}</h1>
            </div>
            <div class="coupon-detail">
               <p>{{__('messages.coupon_note')}}</p>
               <form class="contact1-form validate-form">
                  <input type="text" name="couponcode" id="couponcode" placeholder="Coupon code">
                  <button value="submit" type="button" onclick="addcoupon()" style="background: <?= Session::get('site_color') ?> !important">
                  {{__('messages.apply_coupon')}}
                  </button>
               </form>
            </div>
         </div>
         <div class="col-md-6" id="totalsection">
            <div class="coupon">
               <h1 style="background: <?= Session::get('site_color') ?> !important">{{__('messages.cart_details')}}</h1>
            </div>
            <div class="cart-mt">
               <form action="{{url('checkout')}}" method="post">
                  <div class="subt-box">
                     <h1>{{__('messages.subtotal')}}</h1>
                     <span id="subtotal">{{number_format(Cart::getTotal(), 2, '.', '')}}</span><span>{{Session::get('currency')}}</span>
                     <h1 class="ship">{{__('messages.shipping')}}</h1>
                     <div class="main-d">
                        <?php $i=0;$cost=0;?>
                        @foreach($shipping as $sh)
                        @if($i==0)
                        <?php $cost=$sh->cost;?>
                        @endif
                        <div class="Delivery-opation">
                           <input type="radio" value="{{$sh->id}}#{{$sh->cost}}" name="delivery[]" required="" id="delivery" onchange="Changeradio(this.value)">
                           <h1>{{$sh->label}}</h1>
                           <span>{{Session::get('currency')}}{{number_format((float)$sh->cost, 2, '.', '')}}</span>
                        </div>
                        <?php $i++;?>
                        @endforeach
                     </div>
                     <div id="coupon_total">
                        <h1>{{__('messages.coupon')}}</h1>
                        <span id="couponval"></span><span>-</span>
                        <div class="coupon-apply">
                           <h1 id="couponname"></h1>
                           <p>{{__('messages.offer_on_bill')}}</p>
                        </div>
                     </div>
                     <div class=""  id="free-delivery">
                        <h1>{{__('messages.free_delivery')}}</h1>
                     </div>
                  </div>
                  <div class="cart-totals">
                     <h1>{{__('messages.total')}}</h1>
                     <span id="totalamount">{{number_format(Cart::getTotal(), 2, '.', '')}}</span><span>{{Session::get('currency')}}</span>
                  </div>
                  {{csrf_field()}}
                  <input type="hidden" name="check_delivery" id="checkout_delivery" />
                  <input type="hidden" name="check_discount_type" id="checkout_discount_type" />
                  <input type="hidden" name="check_discount_value" id="checkout_discount_value" />
                  <input type="hidden" name="check_free_shipping" id="checkout_free_shipping" />
                  <input type="hidden" name="check_coupon_value" id="checkout_coupon_value" />
                  <input type="hidden" name="check_couponcode" id="checkout_couponcode" />
                  <button value="submit" type="submit" onclick="Checkout()" style="background: <?= Session::get('site_color') ?> !important">
                  {{__('messages.proceed_to_checkout')}}
                  </button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
<input type="hidden" name="freedelivery" id="freedelivery" value="0" />
@stop