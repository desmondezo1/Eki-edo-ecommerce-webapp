@extends('user.index')
@section('title')
{{__('messages.termscon')}}
@stop
@section('content')
<div class="container">
   <div class="tc-main-box">
      <div class="tc-main-head">
         <h2>{{__('messages.termscon')}}</h2>
         <p>{{__('messages.home')}} / {{__('messages.termscon')}}</p>
      </div>
      <?php $i=1;?>
      @foreach($getquestion as $ge)
      <div class="tc-topic-box">
         <div class="tc-main-topic">
            <h3>{{$i}}. {{$ge->topic}}</h3>
         </div>
         <?php $k=1;?>
         @foreach($ge->Question as $gq)
         <div class="tc-sub-topic">
            <h4>{{$i}}.{{$k}} &nbsp {{$gq->question}}</h4>
            <p>{{$gq->answer}}</p>
         </div>
         <?php $k++;?>
         @endforeach	
      </div>
      <?php $i++;?>
      @endforeach
   </div>
</div>
@stop