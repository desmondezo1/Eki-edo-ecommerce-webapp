@extends('user.index')
@section('title')
{{__('messages.my_account')}}
@stop
@section('content')
<div class="container">
   <div class="cart-heading wish">
      <h1>{{__('messages.my_account')}}</h1>
   </div>
   <div class="myaccount">
      <div class="row">
         <div class="col-md-12 col-lg-4">
            <div class="profile">
               <div class="profile-img">
                  <?php $external_link = asset('public/upload/profile'.'/'.Session::get("profile_pic"));
                     if (Session::get("profile_pic")!="") {
                           $image = $external_link;
                     } else {
                              $image = asset('public/Ecommerce/images/profile.png');
                     }?>
                  <img src="{{$image}}">
               </div>
               <h1>{{$userdata->first_name}}</h1>
               <p>{{$userdata->email}}</p>
            </div>
            <div class="profile-tab">
               <ul class="tabs">
                  <li onclick="changetab('tab-1',1)" id="litab1" class="tab-link current" style="background: <?= Session::get('site_color') ?> !important" data-tab="tab-1">{{__('messages.my_order')}}<span><i class="fa fa-chevron-down" aria-hidden="true"></i></span></li>
                  <li onclick="changetab('tab-2',2)" id="litab2" class="tab-link" data-tab="tab-2">{{__('messages.personal_detail')}}<span><i class="fa fa-chevron-down" aria-hidden="true"></i></span></li>
                  <li onclick="changetab('tab-3',3)" id="litab3" class="tab-link" data-tab="tab-3">{{__('messages.address')}}<span><i class="fa fa-chevron-down" aria-hidden="true"></i></span></li>
                  <li onclick="changetab('tab-4',4)" id="litab4" class="tab-link" data-tab="tab-4">{{__('messages.change_pwd')}}<span><i class="fa fa-chevron-down" aria-hidden="true"></i></span></li>
                  <li onclick="changetab('tab-5',5)" id="litab5" class="tab-link" data-tab="tab-4"  data-toggle="modal" data-target="#myModal1">{{__('messages.logout')}}<span><i class="fa fa-chevron-down" aria-hidden="true"></i></span></li>
               </ul>
            </div>
         </div>
         <div class="col-md-12 col-lg-8 side">
            <div id="tab-1" class="tab-content current account">
               @if(count($myorder)!=0)
               <div class="tab-heading">
                  <h1>{{__('messages.my_order')}}</h1>
               </div>
               <table>
                  <tr class="account-h">
                     <th>{{__('messages.order_id')}}.</th>
                     <th>{{__('messages.date')}}</th>
                     <th>{{__('messages.status')}}</th>
                     <th>{{__('messages.total')}}</th>
                     <th>{{__('messages.action')}}</th>
                  </tr>
                  <?php $i=1;?>
                  @foreach($myorder as $my)
                  <tr class="account-detail" data-aos="zoom-in">
                     <td>
                        <span>{{__('messages.order_id')}}. :</span>
                        {{$i}}
                     </td>
                     <td>
                        <span>{{__('messages.date')}} :</span>
                        {{date('F d,Y', strtotime($my->orderdate))}}
                     </td>
                     <td>
                        <span>{{__('messages.status')}} :</span>
                        @if($my->order_status=='1')
                        {{__("messages.processing")}}
                        @endif
                        @if($my->order_status=='2')
                        {{__("messages.on_hold")}}
                        @endif
                        @if($my->order_status=='3')
                        {{__("messages.pending")}}
                        @endif
                        @if($my->order_status=='5')
                        {{__("messages.completed")}}
                        @endif
                        @if($my->order_status=='6')
                        {{__("messages.canceled")}}
                        @endif
                        @if($my->order_status=='7')
                        {{__("messages.refunded")}}
                        @endif
                        @if($my->order_status=='4')
                        {{__("messages.out_of_delivery")}}
                        @endif
                     </td>
                     <td>
                        <span>{{__('messages.total')}} :</span>
                        {{Session::get('currency')}}{{$my->total}} {{__('messages.for')}} {{$my->total_item}} {{__('messages.item')}}
                     </td>
                     <td class="View">
                        <span>{{__('messages.action')}} :</span>
                        <a href="{{url('vieworder').'/'.$my->id}}" style="border-color: <?= Session::get('site_color') ?> !important" class="myordera" id="myordera{{$i}}">{{__('messages.view')}}</a>
                     </td>
                  </tr>
                  <?php $i++;?>
                  @endforeach
               </table>
               @endif
               @if(count($myorder)==0)
               <div class="order-em">
                  <img src="{{asset('public/Ecommerce/images/empty.png')}}">
                  <h1>{{__('messages.no_order')}}</h1>
               </div>
               @endif
            </div>
            <div id="tab-2" class="tab-content">
               <div class="tab-heading">
                  <h1>{{__('messages.personal_detail')}}</h1>
               </div>
               <div class="per-detail">
                  <form action="{{url('updateuserprofile')}}" method="post" enctype="multipart/form-data">
                     {{csrf_field()}}
                     <div class="personal-form">
                        <?php $external_link = asset('public/upload/profile'.'/'.Session::get("profile_pic"));
                           if (Session::get("profile_pic")!="") {
                                 $image = $external_link;
                           } else {
                                    $image = asset('public/Ecommerce/images/profile.png');
                           }?>
                        <img src="{{$image}}">
                        <label class="per-text">{{__('messages.profile_picture')}}
                        <span>*</span>
                        </label>
                        <input type="file" name="file" >
                        <label class="per-text">{{__('messages.name')}}
                        <span>*</span>
                        </label>
                        <input type="text" name="edit_first_name" id="edit_first_name" value="{{$userdata->first_name}}">
                        <label class="per-text" required="">{{__('messages.email')}}
                        <span>*</span>
                        </label>
                        <input type="text" name="edit_email" id="edit_email" readonly value="{{$userdata->email}}" required="">
                        <label class="per-text">{{__('messages.phone')}}
                        <span>*</span>
                        </label>
                        <input type="text" name="edit_phone" id="edit_phone" value="{{$userdata->phone}}" required="">
                        <label class="per-text">{{__('messages.address')}}
                        </label>
                        <textarea name="edit_address" id="edit_address">{{$userdata->address}}</textarea>   
                     </div>
                     <div class="personal-btn">
                        <button class="update" type="submit" name="btnsubmit" style="background-color: <?= Session::get('site_color') ?> !important">{{__('messages.update')}}</button>
                     </div>
                  </form>
               </div>
            </div>
            <div id="tab-3" class="tab-content">
               <div class="tab-heading">
                  <h1>{{__('messages.address')}}</h1>
               </div>
               <div class="per-detail">
                  <div class="addre">
                     <span><i onclick="editbilling()" style="color: <?= Session::get('site_color') ?> !important" class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                     <h1>{{__('messages.billing_address')}}</h1>
                     <p id="billing_address">{{$userdata->billing_address}}</p>
                     <div id="textbilling">
                        <form>
                           <textarea class="form-control"  id="bill">{{$userdata->billing_address}}</textarea>
                           <input value="Save" type="button" onclick="SaveAddress('bill')" style="background-color: <?= Session::get('site_color') ?> !important">
                           <button onclick="closebill()" type="button" style="background-color: <?= Session::get('site_color') ?> !important">{{__('messages.cancel')}}</button>
                        </form>
                     </div>
                  </div>
                  <div class="addre">
                     <span><i onclick="editshipping()" style="color: <?= Session::get('site_color') ?> !important" class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                     <h1>{{__('messages.shipping_address')}}</h1>
                     <p id="shipping_address">{{$userdata->shipping_address}}</p>
                     <div id="textshipping">
                        <form>
                           <textarea class="form-control"  id="ship">{{$userdata->billing_address}}</textarea>
                           <input value="Save" type="button" name="" onclick="SaveAddress('ship')" style="background-color: <?= Session::get('site_color') ?> !important">
                           <button onclick="closeship()" type="button" style="background-color: <?= Session::get('site_color') ?> !important">{{__('messages.cancel')}}</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div id="tab-4" class="tab-content">
               <div class="tab-heading">
                  <h1>{{__('messages.change_pwd')}}</h1>
               </div>
               <div class="per-detail">
                  <div class="personal-form">
                     <p id="msgres"></p>
                     @if(Auth::user()->password!="")
                     <label class="per-text">{{__('messages.ent_current_pwd')}}<span>*</span></label>
                     <input type="password" name="cpwd" id="cpwd" placeholder="{{__('messages.ent_current_pwd')}}" onchange="checkcurrentpwd(this.value)">
                     <input type="hidden" name="cur_pwd" id="cur_pwd" value="1">
                     @else
                     <input type="hidden" name="cur_pwd" id="cur_pwd" value="0">
                     @endif
                     <label class="per-text">{{__('messages.ent_new_pwd')}}<span>*</span></label>
                     <input type="password" placeholder="{{__('messages.ent_new_pwd')}}" name="npwd" id="npwd">
                     <label class="per-text">{{__('messages.re_enter_pwd_en')}}<span>*</span></label>
                     <input type="password" name="rpwd" placeholder="{{__('messages.re_enter_pwd_en')}}" id="rpwd" onchange="checkboth(this.value)">
                  </div>
                  <div class="personal-btn">
                     <button class="cancel" onclick="cancelpwd()">{{__('messages.cancel')}}</button>
                     <button class="update" onclick="changepassword()" style="background-color: <?= Session::get('site_color') ?> !important">{{__('messages.update')}}</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<input type="hidden" value="{{__('passwords.pwd_same')}}" id="match_error">
<input type="hidden" id="error_current_pwd" value="{{__('passwords.error_cur_pwd')}}">
@stop