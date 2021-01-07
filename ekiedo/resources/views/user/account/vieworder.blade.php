@extends('user.index')
@section('title')
{{__('messages.view_order')}}
@stop
@section('content')
<div class="container">
   <div class="cart-heading pro-heading">
      <h1>{{__('messages.order_detail')}}</h1>
      <span><a href="{{url('/')}}">{{__('messages.home')}} </a>/<a href="{{url('myaccount')}}">{{__('messages.my_account')}}</a>/ {{__('messages.order_detail')}}</span>
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
   <div class="order-process">
      <div class="progress">
         <?php $width="0.00%";
                  if($order->processing_datetime!=0){
            	      $width="33.33%";
                   }
                   if($order->onhold_datetime!=0)
                  {
               	 $width='66.66%';
                  }
                  if($order->completed_datetime!=0){
                  	$width='99.99%';
                  }
                  if($order->cancel_datetime!=0){
                     $width='99.99%';
                  }
            ?>
         <div class="progress-bar" role="progressbar" aria-valuenow="70"
            aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $width;?>;background-color:<?= Session::get('site_color') ?> !important">
            <span class="sr-only">100% {{__('messages.completed')}}</span>
         </div>
      </div>
      <div class="main-process">
         <div class="process-pos">
            <div class="process-1">
               <div class="process-1-circle" style="border-color: <?= Session::get('site_color') ?> !important" ></div>
               <div class="pro-text">
                  <h1>{{__('messages.orders')}} {{__("messages.pending")}}</h1>
                  <p style="color: <?= Session::get('site_color') ?> !important">{{date("h:i  F d,Y ",strtotime($order->orderdate))}}</p>
               </div>
            </div>
            @if(!$order->cancel_datetime)
            <div class="process-1">
               <div class="process-1-circle" style="border-color: <?= Session::get('site_color') ?> !important"></div>
               <div class="pro-text">
                  <h1>{{__('messages.orders')}} {{__("messages.processing")}}</h1>
                  <p style="color: <?= Session::get('site_color') ?> !important">@if($order->processing_datetime!=0){{date("h:i  F d,Y ",strtotime($order->processing_datetime))}}@endif</p>
               </div>
            </div>
            <div class="process-1">
               <div class="process-1-circle" style="border-color: <?= Session::get('site_color') ?> !important"></div>
               <div class="pro-text">
                  <h1>{{__('messages.orders')}} {{__("messages.on_hold")}}</h1>
                  <p style="color: <?= Session::get('site_color') ?> !important">@if($order->onhold_datetime!=0){{date("h:i  F d,Y ",strtotime($order->onhold_datetime))}}@endif</p>
               </div>
            </div>
            <div class="process-1">
               <div class="process-1-circle" style="border-color: <?= Session::get('site_color') ?> !important"></div>
               <div class="pro-text">
                  <h1>{{__('messages.orders')}} {{__('messages.Delivered')}}</h1>
                  <p style="color: <?= Session::get('site_color') ?> !important">@if($order->completed_datetime!=0){{date("h:i  F d,Y ",strtotime($order->completed_datetime))}}@endif</p>
               </div>
            </div>
            @else
              <div class="process-1 visiable">
               <div class="process-1-circle" style="border-color: <?= Session::get('site_color') ?> !important"></div>
               <div class="pro-text">
                 
               </div>
            </div>
            <div class="process-1 visiable" style="display: hidden">
               <div class="process-1-circle" style="border-color: <?= Session::get('site_color') ?> !important"></div>
               <div class="pro-text">
                 
               </div>
            </div>
                <div class="process-1">
               <div class="process-1-circle" style="border-color: <?= Session::get('site_color') ?> !important"></div>
               <div class="pro-text">
                  <h1>{{__('messages.orders')}} {{__('messages.cancel')}}</h1>
                  <p style="color: <?= Session::get('site_color') ?> !important">@if($order->cancel_datetime!=0){{date("h:i  F d,Y ",strtotime($order->cancel_datetime))}}@endif</p>
               </div>
            </div>
            @endif
         </div>
      </div>
   </div>
   <div class="process-info" >
      <li>
         <div class="info-text">
            <h1>{{__('messages.order_id')}} :</h1>
            <p>#{{$order->id}}</p>
         </div>
      </li>
      <li>
         <div class="info-text">
            <h1>{{__('messages.date')}} :</h1>
            <p>{{date("F d,Y",strtotime($order->orderdate))}}</p>
         </div>
      </li>
      <li>
         <div class="info-text">
            <h1>{{__('messages.email')}} :</h1>
            <p>{{$order->email}}</p>
         </div>
      </li>
      <li>
         <div class="info-text">
            <h1>{{__('messages.total')}} :</h1>
            <p>{{Session::get('currency').$order->total}}</p>
         </div>
      </li>
      <li>
         <div class="info-text">
            <h1>{{__('messages.payment_method')}} :</h1>
            <p>@if($order->payment_method==1)
               {{__('messages.paypal')}}
               @elseif($order->payment_method==2)
               {{__('messages.stripe')}}
               @else
               {{__('messages.case_on_delivery')}}
               @endif
            </p>
         </div>
      </li>
       <li>
         <div class="info-text">
            <h1>{{__('messages.order_status')}} :</h1>
            <p>
               @if($order->order_status==1)
                 {{__("messages.processing")}}
               @elseif($order->order_status==2)
                   {{__("messages.on_hold")}}
               @elseif($order->order_status==3)
                   {{__("messages.pending")}}
               @elseif($order->order_status==4)
                   {{__("messages.out_of_delivery")}}
               @elseif($order->order_status==5)
                    {{__("messages.completed")}}
               @elseif($order->order_status==6)
                    {{__("messages.canceled")}}
               @elseif($order->order_status==7)  
                    {{__("messages.refunded")}}
               @endif
            </p>
         </div>
      </li>
   </div>
   <div class="cart-detail">
      <h4>{{__('messages.orders')}}</h4>
      <table>
         <tr class="pro-heading" style="background-color: <?= Session::get('site_color') ?> !important">
            <th>{{__('messages.order_id')}}</th>
            <th>{{__('messages.images')}}</th>
            <th>{{__('messages.product')}}</th>
            <th>{{__('messages.Quanitity')}}</th>
            <th>{{__('messages.price')}}</th>
         </tr>
         <?php $i=1;?>
         @foreach($orderdata as $od)
         <tr>
            <td class="order-num">
               {{$i}}.
               <span>{{__('messages.order_id')}}</span>
            </td>
            <td class="cart-img">
               <img src="{{asset('public/upload/product').'/'.$od->productdata->basic_image}}">
               <span>{{__('messages.images')}} :</span>
            </td>
            <td class="place-text">
               <div class="text-a">
                  <span>{{__('messages.product')}} :</span>
                  <h1>{{$od->productdata->name}}</h1>
                  <?php $option=explode(",",$od->option_name);
                     $label=explode(",",$od->label);
                     ?>
                  <?php for($i=0;$i<count($option);$i++){?>
                  <p><b>{{$option[$i]}}</b> {{$label[$i]}} </p>
                  <?php } ?>
               </div>
            </td>
            <td class="Quanitity">
               <div class="qut-box">
                  <button>
                  <i class="minus" aria-hidden="true">-</i>
                  </button>
                  <input type="text" readonly name="text" placeholder="2" value="{{$od->quantity}}">
                  <button>
                  <i class="plus" aria-hidden="true">+</i>
                  </button>
               </div>
               <span>{{__('messages.Quanitity')}} :</span>
            </td>
            <td class="price">
               {{Session::get('currency').number_format((float)$od->price, 2, '.', '')}}
               <span>{{__('messages.price')}} :</span>
            </td>
         </tr>
         <?php $i++;?>
         @endforeach
      </table>
   </div>
   <div class="other-detail" >
      <div class="row">
         <div class="col-md-6">
            <div class="coupon">
               <h1 style="background-color: <?= Session::get('site_color') ?> !important">{{__('messages.billing_address')}}</h1>
               <div class="address-info">
                  <p>{{$order->billing_first_name}}</p>
                  <p>{{$order->billing_address}}</p>
                  <p>{{$order->billing_city." ".$order->billing_pincode}}</p>
               </div>
            </div>
            <div class="col-md-12 p-0 bill">
               <div class="coupon">
                  <h1 style="background-color: <?= Session::get('site_color') ?> !important">{{__('messages.shipping_address')}}</h1>
                  <div class="address-info">
                     @if($order->to_ship=='0')
                     <p>{{__('messages.same_ship')}}</p>
                     @endif
                     @if($order->to_ship=='1')
                     <p>{{$order->shipping_first_name}}</p>
                     <p>{{$order->shipping_address}}</p>
                     <p>{{$order->shipping_city." ".$order->shipping_pincode}}</p>
                     @endif
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="coupon">
               <h1 style="background-color: <?= Session::get('site_color') ?> !important">{{__('messages.cart_total')}}</h1>
            </div>
            <div class="cart-mt">
               <div class="subt-box">
                  <h1>{{__('messages.subtotal')}}</h1>
                  <span>{{Session::get('currency').number_format((float)$order->subtotal, 2, '.', '')}}</span>
                  @if($order->coupon_code!="")
                  <h1>{{__('messages.coupon')}} ({{$order->coupon_code}})</h1>
                  <span>-{{Session::get('currency').number_format((float)$order->coupon_price, 2, '.', '')}}</span>
                  @endif
                  <h1>{{__('messages.taxes')}}</h1>
                  <span>{{Session::get('currency').number_format((float)$order->taxes_charge, 2, '.', '')}}</span>
                  <h1>{{__('messages.shipping')}}(@if($order->shipping_method==1) {{__("messages.home_delivery")}} @else {{__("messages.local_pickup")}} @endif)</h1>
                  @if($order->is_freeshipping=='1')
                  <span>{{Session::get('currency')}}0.00</span>
                  @else
                  <span>{{Session::get('currency').number_format((float)$order->shipping_charge, 2, '.', '')}}</span>
                  @endif
                  @if($order->is_freeshipping=='1')
                  <h1 class="free-d">{{__('messages.free_delivery')}}</h1>
                  @endif
               </div>
               <div class="cart-totals">
                  <h1>{{__('messages.total')}}</h1>
                  <span>{{Session::get('currency').$order->total}}</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop