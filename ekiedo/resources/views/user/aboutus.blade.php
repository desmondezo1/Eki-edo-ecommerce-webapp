@extends('user.index')
@section('title')
{{__('messages.about')}}
@stop
@section('content')
<div class="container">
   <div class="about-heading">
      <h2>{{__('messages.about')}}</h2>
      <p>{{__('messages.a1')}}</p>
   </div>
   <div class="about-history-1">
     <?php echo html_entity_decode($page->description);?>
   </div>
</div>
@stop