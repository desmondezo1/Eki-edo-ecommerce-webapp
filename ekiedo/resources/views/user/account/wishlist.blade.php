@extends('user.index')
@section('title')
{{__('messages.My_WishList')}}
@stop
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
   <div class="cart-heading wish">
      <h1>{{__('messages.My_WishList')}}</h1>
      <span><a href="{{url('/')}}" style="color: <?= Session::get('site_color') ?> !important">{{__('messages.home')}}</a> / {{__('messages.My_WishList')}}</span>
   </div>
   <div class="cart-detail">
      <table id="mywish">
         <tr class="pro-heading" style="background: <?= Session::get('site_color') ?> !important">
            <th>{{__('messages.del')}}</th>
            <th>{{__('messages.images')}}</th>
            <th>{{__('messages.product')}}</th>
            <th>{{__('messages.stock_status')}}</th>
            <th>{{__('messages.price')}}</th>
            <th></th>
         </tr>
           @if(count($mywish)!=0)
            @foreach($mywish as $mw)
            <tr>
            <td class="Delete-icon">
               <a href="javascript:;" onclick="deletewish('{{$mw->product_id}}')"><i class="fa fa-trash-o" aria-hidden="true"></i>  </a>
               <span>{{__('messages.del')}} :</span>
            </td>
            <td class="cart-img">
               <img src="{{asset('public/upload/product').'/'.$mw->productdata->basic_image}}">
               <span>{{__('messages.images')}} :</span>
            </td>
            <td class="place-text">
               <div class="text-a">
                  <span>{{__('messages.product')}} :</span>
                  <h1>{{$mw->productdata->name}}</h1>
               </div>
            </td>
            <td class="Stock-text">
               @if($mw->productdata->stock=='0')
               {{__("messages.outstock")}}
               @endif
               @if($mw->productdata->stock=='1')
               {{__("messages.in_stock")}}
               @endif
               <span>{{__('messages.stock_status')}} :</span>
            </td>
            <td class="price">
               {{Session::get('currency')}} {{$mw->productdata->price}}
               <span>{{__('messages.price')}} :</span>
            </td>
            <td class="add">
               <a onclick="addwishtocart('{{$mw->product_id}}','{{$mw->productdata->name}}','1','{{$mw->productdata->price}}')" style="border-color: <?= Session::get('site_color') ?> !important">{{__('messages.add_to_cart')}}</a>
            </td>
         </tr>
         @endforeach
         @else
            <tr>
                <td colspan="6" class="emptywish">{{__('messages.Your wishlist is currently empty!')}}</td>
            </tr>
         @endif
        
      </table>
      <div class="continue">
         <a href="{{url('/')}}" style="color: <?= Session::get('site_color') ?> !important">{{__('messages.continue_shopping')}}
         <i class="fa fa-long-arrow-right" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
         </a>
      </div>
   </div>
</div>
@stop