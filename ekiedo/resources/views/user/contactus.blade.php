@extends('user.index')
@section('title')
{{__('messages.contact_us')}}
@stop
@section('content')
<div class="container">
   <div class="contact-main-box">
      <div class="contact-main-head">
         <h2>{{__('messages.contact_us')}}</h2>
         <p><a href="{{url('/')}}">{{__('messages.home')}}</a> / {{__('messages.contact_us')}}</p>
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
      <div class="contact-map-details">
         <div class="row">
            <div class="col-lg-7 col-md-6">
               <div id="map"></div>
            </div>
            <div class="col-lg-5 col-md-6">
               <div class="contact-content-box">
                  <div class="contact-content-detail">
                     <i class="fa fa-phone call-icon" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                     <h3 style="color: <?= Session::get('site_color') ?> !important">{{__('messages.contact_us')}}</h3>
                  </div>
                  <div class="contact-content-value">
                     <p>{{Session::get('site_phone')}}</p>
                  </div>
               </div>
               <div class="contact-content-box">
                  <div class="contact-content-detail">
                     <i class="fa fa-map-marker call-icon" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                     <h3 style="color: <?= Session::get('site_color') ?> !important">{{__('messages.address')}}</h3>
                  </div>
                  <div class="contact-content-value">
                     <p>{{Session::get('site_address')}}</p>
                  </div>
               </div>
               <div class="contact-content-box">
                  <div class="contact-content-detail">
                     <i class="fa fa-envelope-o call-icon" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i>
                     <h3 style="color: <?= Session::get('site_color') ?> !important">{{__('messages.email')}}</h3>
                  </div>
                  <div class="contact-content-value">
                     <p>{{Session::get('site_email')}}</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="contact-form-box">
         <form action="{{url('storecontact')}}" method="post">
            {{csrf_field()}}
            <div class="row">
               <div class="col-lg-6 col-md-6">
                  <div class="contact-form-part">
                     <div class="contact-form-part1">
                        <label>{{__('messages.name')}}</label><br>
                        <input type="text" name="name" class="inputtext"  id="name" required>
                     </div>
                     <div class="contact-form-part2">
                        <label>{{__('messages.email')}}</label><br>
                        <input type="text" name="email"  class="inputtext" id="email" required>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="contact-form-part">
                     <div class="contact-form-part1">
                        <label>{{__('messages.subject')}}</label><br>
                        <input type="text"  name="subject" class="inputtext" id="subject" reuqired>
                     </div>
                     <div class="contact-form-part2">
                        <label>{{__('messages.phone')}}</label><br>
                        <input type="text"  name="phone" class="inputtext" id="phone" required>
                     </div>
                  </div>
               </div>
            </div>
            <div class="contact-form-part contact-form-part3">
               <div class="contact-form-part1">
                  <label>{{__('messages.message')}}</label><br>
                  <textarea id="message" class="inputtext" name="message"></textarea>
               </div>
               <div class="row con-btn">
                  <input type="submit" class="contactbtn" value="{{__('messages.submit')}}" name="btnsubmit" style="background: <?= Session::get('site_color') ?> !important">
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@stop
@section('footer')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRYhkASG4k8H08cIW-bVdOPqAYn4nyDiY&callback=initMap" async defer></script>
<script type="text/javascript">
  var map;
   var zoom = 13;
   var eiffel = {lat: 21.2285307, lng: 72.897324};
   function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: eiffel,
      zoom: zoom
    });
    var marker = new google.maps.Marker({
      position: eiffel,
      map: map,
      animation: google.maps.Animation.DROP,
      title: 'Ha Noi Vietnamese'
    })
    marker.addListener('click', function() {
      infowindow.open(map,marker);
    });
    var contentString = '<div id="content">'+
      '<h1>Ha Noi Vietnamese</h1>'+
      '<p>Hanoi is the capital of the Socialist Republic of <b>Vietnam</b>.</p> City for peace'+
      '</div>';
    var infowindow = new google.maps.InfoWindow({
      content: contentString
    })
   }
</script>
@stop