@extends('user.index')
@section('title')
{{__('messages.Checkout')}}
@stop
@section('content')
<style>
    #stripe button{
       background-color:<?= Session::get('site_color') ?> !important;
   }
</style>
<div class="container">
    
   <div class="cart-heading">
      <h1>{{__('messages.Checkout')}}</h1>
      <span><a href="{{url('/')}}">{{__('messages.home')}}</a> /<a href="{{url('cartdetail')}}">{{__('messages.My_Cart')}}</a> / {{__('messages.Checkout')}}</span>
   </div>
    @if(Session::has('message'))
                     <div class="col-sm-12">
                        <div class="alert  {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">{{ Session::get('message') }}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                     </div>
                     @endif
   <div class="checkout-box">
       
      <div class="row">

         <div class="chek-img">
            <div class="check-icon-box" style="background: <?= Session::get('site_color') ?> !important">
               <div class="icon-images"></div>
            </div>
         </div>
         <div class="col-md-10 col-sm-9">
            @if(!Auth::id())
            <h2>{{__('messages.return_cus')}}</h2>
            @endif
            @if(Auth::id())
            <h2>{{Auth::user()->first_name}}</br>
            <span class="checkemail">{{Auth::user()->email}}</span></h2>
            @endif
         </div>
      </div>
      @if(!Auth::id())
      <div class="check-text">
         <p>{{__('messages.note1')}}
              {{__('messages.note2')}}
         </p>
         <span id="check_error_msg"></span>
         <div class="form">
            <div class="row">
               <div class="col-md-6 name">
                  <h1>{{__('messages.email')}}<span class="reqfield">*</span></h1>
                  <input type="text" name="check_email">
               </div>
               <div class="col-md-6 name">
                  <h1>{{__('messages.password')}}<span class="reqfield">*</span></h1>
                  <input type="Password" name="check_password">
               </div>
            </div>
            <div class="login">
               <button type="button" onclick="loginuser('check_')" style="background-color: <?= Session::get('site_color') ?> !important">{{__('messages.sign_in')}}</button>
               <span>
               <button type="button" onclick="openregsiter()"  data-toggle="modal" data-target="#myModal" style="background-color: <?= Session::get('site_color') ?> !important">{{__('messages.sign_up')}}</button>
               </span>
            </div>
         </div>
         <div class="checkbox-container">
            <input type="checkbox" name="check_remember">
            <h1>{{__('messages.rem_me')}}</h1>
         </div>
      </div>
      @endif
   </div>
   <div class="check-section">
      <div class="row">
         <div class="col-md-6">
            <div class="Billing-box">
               <div class="billing-head">
                  <h1>{{__('messages.billing_detail')}}</h1>
               </div>
               <div class="col-md-12 p-0">
                  <form class="frm">
                     <div class="row">
                        <div class="col-md-12">
                           <label class="frm-name">{{__('messages.name')}} :<span class="reqfield">*</span></label>
                           <input type="text" name="order_firstname" id="order_firstname" value="<?=isset(Auth::user()->first_name)?Auth::user()->first_name:''; ?>">
                        </div>
                      
                     </div>
                     <label class="frm-name">{{__('messages.address')}} :<span class="reqfield">*</span></label>
                     <textarea name="order_billing_address" id="order_billing_address"><?=isset(Auth::user()->billing_address)?Auth::user()->billing_address:''; ?></textarea>
                     <div class="row">
                        <div class="col-md-6">
                           <label class="frm-name">{{__('messages.Town_City')}}:<span class="reqfield">*</span></label>
                           <input type="text" name="order_billing_city" id="order_billing_city">
                        </div>
                        <div class="col-md-6">
                           <label class="frm-name">{{__('messages.Postcode_Zip')}} :<span class="reqfield">*</span></label>
                           <input type="text" name="order_billing_pincode" id="order_billing_pincode">
                        </div>
                     </div>
                     <label class="frm-name">{{__('messages.phone')}} :<span class="reqfield">*</span></label>
                     <input type="text" name="order_phone" id="order_phone" value="<?=isset(Auth::user()->phone)?Auth::user()->phone:''; ?>">	
                     <label class="frm-name">{{__('messages.email')}} :<span class="reqfield">*</span></label>
                     <input type="text" name="order_email" id="order_email" value="<?=isset(Auth::user()->email)?Auth::user()->email:''; ?>">	
                     <div class="checkbox-container-1">
                        <input type="checkbox" name="to_ship" value="1" id="to_ship" onclick="changeship()">
                        <h1>{{__('messages.ship_different')}}</h1>
                     </div>
                     <div id="shipping_address" class="toshop">
                        <div class="row">
                           <div class="col-md-12">
                              <label class="frm-name">{{__('messages.name')}} :<span class="reqfield">*</span></label>
                              <input type="text" name="order_ship_firstname" id="order_ship_firstname">
                           </div>
                          
                        </div>
                        <label class="frm-name">{{__('messages.address')}} :<span class="reqfield">*</span></label>
                        <input type="text" name="order_shipping_address" id="order_shipping_address" value="<?=isset(Auth::user()->shipping_address)?Auth::user()->shipping_address:''; ?>">
                        <div class="row">
                           <div class="col-md-6">
                              <label class="frm-name">{{__('messages.Town_City')}} :<span class="reqfield">*</span></label>
                              <input type="text" name="order_shipping_city" id="order_shipping_city">
                           </div>
                           <div class="col-md-6">
                              <label class="frm-name">{{__('messages.Postcode_Zip')}} :<span class="reqfield">*</span></label>
                              <input type="text" name="order_shipping_pincode" id="order_shipping_pincode">
                           </div>
                        </div>
                     </div>
                     <label class="frm-name">{{__('messages.notes_op')}} :</label>
                     <textarea type="text" name="order_notes" id="order_notes"></textarea>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="check-order">
               <div class="check-order-h">
                  <h1>{{__('messages.your_order')}}</h1>
               </div>
               <table>
                  <tr>
                     <th style="background: <?= Session::get('site_color') ?> !important">{{__('messages.Detail')}}</th>
                     <th style="background: <?= Session::get('site_color') ?> !important">{{__('messages.total')}}</th>
                  </tr>
                  <tr class="check-ord-text">
                     <td>
                        {{__('messages.subtotal')}}
                     </td>
                     <td>{{Session::get('currency').number_format((float)Cart::gettotal(), 2, '.', '')}}</td>
                  </tr>
                  @if($check_couponcode!="")
                  <tr class="check-ord-text">
                     <td>
                        {{__('messages.coupon')}}({{$check_couponcode}})
                     </td>
                     <td>-{{$check_coupon_value}}</td>
                     <input type="hidden" id="couponcode"  value="{{$check_couponcode}}" />
                     <input type="hidden" id="couponval" value="{{$check_coupon_value}}" />
                  </tr>
                  @endif
                  @foreach($product_tax as $pt)
                  <tr class="check-ord-text">
                     <td>
                        {{$pt["name"]}}
                     </td>
                     <td>{{Session::get('currency').number_format((float)$pt["total"], 2, '.', '')}}</td>
                  </tr>
                  @endforeach
                  @if($check_free_shipping==0)
                  <tr class="check-ord-text">
                     <td>
                        {{__('messages.shipping')}}
                     </td>
                     <td>@if($delivery_type==1) {{__("messages.home_delivery")}} @else {{__("messages.local_pickup")}} @endif: {{Session::get('currency').number_format((float)$delivery_charge, 2, '.', '')}}</td>
                  </tr>
                  @endif
                  @if($check_free_shipping==1)
                  <tr class="check-ord-text">
                     <td>
                        {{__('messages.shipping')}}
                     </td>
                     <td>{{__('messages.free_delivery')}}</td>
                  </tr>
                  @endif
                  <input type="hidden" id="freeshipping" value="{{$check_free_shipping}}">
                  <input type="hidden" id="shipping_type" value="{{$delivery_type}}">
                  <input type="hidden" id="shipping_charges" value="{{$delivery_charge}}">
                  <tr class="check-ord-total">
                     <td>
                        {{__('messages.total')}}
                     </td>
                     <?php 
                        $total=0;
                        foreach($product_tax as $pt){
                        	$total=$total+$pt['total'];
                        }?>
                     <input type="hidden" id="total_tax" value="{{$total}}">
                     <?php
                        if($check_free_shipping==1){
                        $delivery=0;
                        }
                        else{
                        	$dt=explode("#",$check_delivery);
                        	if(!empty($dt[1])){
                        		$delivery=$dt[1];
                        	}
                        	else{
                        		$delivery=0;
                        	}
                        }
                        $total=(float)$total+(((float)Cart::gettotal()+(float)$delivery)-((float)$check_coupon_value));
                        ?>
                     <input type="hidden" id="total_order_price" value="{{$total}}">
                     <td>{{Session::get('currency').number_format($total, 2, '.', '')}}</td>
                  </tr>
               </table>
            </div>
            <div class="payment-box">
               @if($payment_method[0]->status=='1')
               <div class="check-payment">
                  <div class="c-box">
                     <input type="radio" name="payment_method" id="payment_method_1" value="1" onclick="orderpayment(this.value)">
                  </div>
                  <div class="payment-text">
                     <div class="pay">
                        <a href="#"><img src="{{asset('public/Ecommerce/images/pay-1.jpg')}}"></a>
                     </div>
                  </div>
               </div>
               @endif
               @if($payment_method[1]->status=='1')
               <div class="check-payment">
                  <div class="c-box">
                     <input type="radio" name="payment_method" id="payment_method_2" value="2" onclick="orderpayment(this.value)">
                  </div>
                  <div class="payment-text">
                     <div class="pay">
                        <a href="#"><img src="{{asset('public/Ecommerce/images/pay-2.jpg')}}"></a>
                        <a href="#"><img src="{{asset('public/Ecommerce/images/pay-3.jpg')}}"></a>
                        <a href="#"><img src="{{asset('public/Ecommerce/images/pay-4.jpg')}}"></a>
                     </div>
                  </div>
               </div>
               @endif
               @if($payment_method[2]->status=='1')
               <div class="check-payment">
                  <div class="c-box">
                     <input type="radio" name="payment_method" id="payment_method_3" value="3" onclick="orderpayment(this.value)">
                  </div>
                  <div class="payment-text">
                     <h1>{{__('messages.case_on_delivery')}}</h1>
                  </div>
               </div>
               @endif
            </div>
            <div class="place-btn" id="paypal">
               <form action="{{url('paywithpaypal')}}" method="post">
                  {{csrf_field()}}
                  <input type="hidden" name="order_firstname" id="pay_order_firstname">
                  <input type="hidden" name="order_billing_address" id="pay_order_billing_address">
                  <input type="hidden" name="order_billing_city" id="pay_order_billing_city">
                  <input type="hidden" name="order_billing_pincode" id="pay_order_billing_pincode">
                  <input type="hidden" name="order_phone" id="pay_order_phone">
                  <input type="hidden" name="order_email" id="pay_order_email">
                  <input type="hidden" name="to_ship" id="pay_order_to_ship">
                  <input type="hidden" name="order_ship_firstname" id="pay_order_ship_firstname">
                  <input type="hidden" name="order_shipping_address" id="pay_order_shipping_address">
                  <input type="hidden" name="order_shipping_city" id="pay_order_shipping_city">
                  <input type="hidden" name="order_shipping_pincode" id="pay_order_shipping_pincode">
                  <input type="hidden" name="order_notes" id="pay_order_notes">
                  <input type="hidden" name="couponcode" id="pay_couponcode">
                  <input type="hidden" name="freeshipping" id="pay_freeshipping">
                  <input type="hidden" name="couponval" id="pay_couponval">
                  <input type="hidden" name="shipping_type" id="pay_shipping_type">
                  <input type="hidden" name="shipping_charges" id="pay_shipping_charges">
                  <input type="hidden" name="total_order_price" id="pay_total_order_price">
                  <input type="hidden" name="payment_method" id="pay_payment_method">
                  <input type="hidden" name="total_taxes" id="pay_total_taxes">
                  <button type="submit" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.place_order')}}</button>
               </form>
            </div>
            <div class="place-btn" id="stripe">
               <form action="{{url('cashorder')}}" method="post">
                  {{csrf_field()}}
                  <input type="hidden" name="order_firstname" id="stri_order_firstname">
                  <input type="hidden" name="order_billing_address" id="stri_order_billing_address">
                  <input type="hidden" name="order_billing_city" id="stri_order_billing_city">
                  <input type="hidden" name="order_billing_pincode" id="stri_order_billing_pincode">
                  <input type="hidden" name="order_phone" id="stri_order_phone">
                  <input type="hidden" name="order_email" id="stri_order_email">
                  <input type="hidden" name="to_ship" id="stri_order_to_ship">
                  <input type="hidden" name="order_ship_firstname" id="stri_order_ship_firstname">
                  <input type="hidden" name="order_shipping_address" id="stri_order_shipping_address">
                  <input type="hidden" name="order_shipping_city" id="stri_order_shipping_city">
                  <input type="hidden" name="order_shipping_pincode" id="stri_order_shipping_pincode">
                  <input type="hidden" name="order_notes" id="stri_order_notes">
                  <input type="hidden" name="couponcode" id="stri_couponcode">
                  <input type="hidden" name="freeshipping" id="stri_freeshipping">
                  <input type="hidden" name="couponval" id="stri_couponval">
                  <input type="hidden" name="shipping_type" id="stri_shipping_type">
                  <input type="hidden" name="shipping_charges" id="stri_shipping_charges">
                  <input type="hidden" name="total_order_price" id="stri_total_order_price">
                  <input type="hidden" name="payment_method" id="stri_payment_method">
                  <input type="hidden" name="total_taxes" id="stri_total_taxes">
                   @if($payment_method[1]->status=='1')
                  <script
                     src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                     data-key="{{Session::get('stripe_key')}}"
                     data-amount=""
                     data-id="stripid"
                     data-name="{{__('messages.site_name')}}"
                     data-label="{{__('messages.place_order')}}"
                     data-description=""
                     data-image="{{asset('public/Ecommerce/images/logo.png')}}"
                     data-locale="auto"></script>
                     @endif
               </form>
            </div>
            <div class="place-btn" id="cod">
               <form action="{{url('cashorder')}}" method="post">
                  {{csrf_field()}}
                  <input type="hidden" name="order_firstname" id="cod_order_firstname">
                  <input type="hidden" name="order_billing_address" id="cod_order_billing_address">
                  <input type="hidden" name="order_billing_city" id="cod_order_billing_city">
                  <input type="hidden" name="order_billing_pincode" id="cod_order_billing_pincode">
                  <input type="hidden" name="order_phone" id="cod_order_phone">
                  <input type="hidden" name="order_email" id="cod_order_email">
                  <input type="hidden" name="to_ship" id="cod_order_to_ship">
                  <input type="hidden" name="order_ship_firstname" id="cod_order_ship_firstname">
                  <input type="hidden" name="order_shipping_address" id="cod_order_shipping_address">
                  <input type="hidden" name="order_shipping_city" id="cod_order_shipping_city">
                  <input type="hidden" name="order_shipping_pincode" id="cod_order_shipping_pincode">
                  <input type="hidden" name="order_notes" id="cod_order_notes">
                  <input type="hidden" name="couponcode" id="cod_couponcode">
                  <input type="hidden" name="freeshipping" id="cod_freeshipping">
                  <input type="hidden" name="couponval" id="cod_couponval">
                  <input type="hidden" name="shipping_type" id="cod_shipping_type">
                  <input type="hidden" name="shipping_charges" id="cod_shipping_charges">
                  <input type="hidden" name="total_order_price" id="cod_total_order_price">
                  <input type="hidden" name="payment_method" id="cod_payment_method">
                  <input type="hidden" name="total_taxes" id="cod_total_taxes">
                  <button type="submit" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.place_order')}}</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@stop