@extends('user.index')
@section('title')
{{__('messages.helpsupport')}}
@stop
@section('content')
<style>
      .help-tab-box .card-header{
      background: <?= Session::get('site_color') ?>;
   }
</style>
<div class="container">
<div class="help-searchbar">
   <h3>{{__('messages.helpnote')}}</h3>
   <form>
      <div class="help-searchbar-part">
         <i class="fa fa-search" aria-hidden="true"></i>
         <input type="text" name="helpsearch" placeholder="Search for topics or questions" id="help-search-bar" onkeypress="return runScript(event)">
      </div>
   </form>
</div>
<div class="myaccount">
   <div class="row">
      <div class="col-md-12 col-lg-4">
         <div class="help-tab">
            <ul class="tabs tabs-2">
               <h1>{{__('messages.help_topic')}}</h1>
               <?php $i=0;?>
               @foreach($getquestion as $ge)
               @if($i==0)
               <li onclick="changehelp('tab-{{$ge->id}}','{{$i}}')" class="tab-link current" style="background: <?= Session::get('site_color') ?> !important" data-tab="tab-{{$ge->id}}" id="{{$i}}">
                  @else
               <li class="tab-link" onclick="changehelp('tab-{{$ge->id}}','{{$i}}')" data-tab="tab-{{$ge->id}}" id="{{$i}}">
                  @endif
                  {{$ge->topic}}
                  <span>
                  <i class="fa fa-chevron-down" aria-hidden="true"></i>
                  </span>
               </li>
               <?php $i++;?>
               @endforeach
            </ul>
         </div>
      </div>
      <input type="hidden" id="total-tab" value="{{$i}}" />
      <div class="col-md-12 col-lg-8 side">
         <?php $i=0;?>
         @foreach($getquestion as $ge)
         @if($i==0)
         <div id="tab-{{$ge->id}}" class="tab-content current account">
            @else
            <div id="tab-{{$ge->id}}" class="tab-content">
               @endif
               <div class="help-tab-box">
                  <div class="help-tab-head">
                     <h2>{{$ge->topic}}</h2>
                  </div>
                  <div class="accordion indicator-plus-before round-indicator" id="accordionH" aria-multiselectable="true">
                     <div class="card m-b-0">
                        @foreach($ge->Question as $qu)
                        <div class="card-header collapsed" role="tab" id="heading{{$ge->id.$qu->id}}" href="#collapse{{$ge->id.$qu->id}}" data-toggle="collapse" data-parent="#accordion{{$ge->id.$qu->id}}" aria-expanded="false" aria-controls="collapse{{$ge->id.$qu->id}}">
                           <a href="#" class="card-title">{{$qu->question}}</a>
                        </div>
                        <div class="collapse" id="collapse{{$ge->id.$qu->id}}" role="tabpanel" aria-labelledby="heading{{$ge->id.$qu->id}}">
                           <div class="card-body">
                              <ul>
                                 <li>{{$qu->answer}}</li>
                              </ul>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
            <?php $i++;?>
            @endforeach
         </div>
      </div>
   </div>
</div>
@stop