@extends('user.index')
@section('title')
{{__('messages.Compare')}}
@stop
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
   <div class="compare_table">
      <table class="table-responsive table">
         <thead>
            @if(count($comparedata)!=0)
            <tr class="th-compare">
               <th class="product-name">{{__('messages.action')}}</th>
               @foreach($comparedata as $d)
               <th class="item-row">
                  <button type="button" onclick="removecomareitem('{{$d->id}}')" class="remove-compare">{{__('messages.Remove')}}</button>
               </th>
               @endforeach	       
            </tr>
         </thead>
         <tbody id="table-compare">
            <tr>
               <th class="product-name">{{__('messages.Product Name')}}</th>
               @foreach($comparedata as $d)
               <td><a href="{{url('viewproduct/').'/'.$d->id}}">{{$d->name}}</a></td>
               @endforeach
            </tr>
            <tr>
               <th class="product-name">{{__('messages.Product Image')}}</th>
               @foreach($comparedata as $d)
               <td class="item-row">
                  <img src="{{asset('public/upload/product/').'/'.$d->basic_image}}" alt="product" class="   featured-image">
                  <div class="product-price product_price"><strong>{{__('messages.On Sale')}}: </strong><span>{{Session::get('currency').$d->selling_price}}</span></div>
                  <form class="variants clearfix">
                     <input type="hidden">
                     <button title="Add to Cart" onclick="addcomparetocart('{{$d->id}}','{{$d->name}}','1','{{$d->selling_price}}')" class="add-to-cart btn btn-normal">{{__('messages.add_to_cart')}}</button>
                  </form>
               </td>
               @endforeach
            </tr>
            <tr>
               <th class="product-name">{{__('messages.Product Sku')}}</th>
               @foreach($comparedata as $d)
               <td class="item-row">
                  <p class="description-compare">{{$d->sku}}</p>
               </td>
               @endforeach	       
            </tr>
            <tr>
               <th class="product-name">{{__('messages.Availability')}}</th>
               @foreach($comparedata as $d)
               <td class="availabel-stock">
                  @if($d->stock=='1')
                  <p>{{__('messages.Availabel In stock')}}</p>
                  @else
                  <p>{{__('messages.Availabel Out Of stock')}}</p>
                  @endif
               </td>
               @endforeach		       
            </tr>
            @foreach($attr_name as $anam)
            <tr>
               <th class="product-name">{{$anam}}</th>
               <?php foreach ($comparedata as $k) {   
                  $temp=0;                      	  
                  foreach ($k->attributes as $k1) {
	                  if($k1['attributename']&&isset($k1['attributename']['name'])&&$k1['attributename']['name']==$anam){
		                  echo '<td>'.$k1['attributename']['values'].'</td>';
		                  $temp=1;
		                  break;           	 		              	
	                  }
                  } ?>
               @if($temp!=1)
               <td>--</td>
               @endif
               <?php } ?>	
            </tr>
            @endforeach
         </tbody>
         @else
         <h1>{{__('messages.No Any Product In Your Compare List')}}</h1>
         @endif
      </table>
   </div>
</div>
@stop