@extends('layouts.app')
@section('styles')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection

@section('content')
<div class="">
  <div class="container card">
    <div class="col-sm-12 voffset-10">
      <div class="col-sm-3">
        <img src="{{ url($profile['dp_permalink']) }}" alt="" width="300" id="dp-image" />
      </div>
      <div class="col-sm-8 col-sm-offset-1">
        <h3 class="caps">{{ $profile['first_name'] }} {{  $profile['last_name'] }} </h3> <br>
        <p class="capitalize">{{ $profile['tagline_1'] }} . {{ $profile['tagline_2'] }}</p>
        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $location['location_short'] }}</p>
        <br><br>
        <p>{{ $profile['about'] }}</p>
      </div>
    </div>
    <hr class="col-xs-12">

    <div class="col-sm-12 voffset-10">
      <h3 class="caps text-left">Portfolio</h3>
      <div class="col-sm-12" id="lightSlider">
        @foreach($works as $work)
        <div class="col-sm-4 works">
          <img src="{{ url($work['image_permalink']) }}" alt="" width='400' height='300' style="padding-right: 20px;"/>
          <strong>{{ $work['title'] }}</strong>
          <p>
            {{ $work['comment'] }}
          </p>
        </div>
      @endforeach
      </div>
    </div>

    <hr class="col-xs-12">

    <div class="col-sm-12 voffset-10"">
      <div class="col-sm-6">
        <h3 class="caps">Skills</h3>
        @if(!empty($skills))
          <ul class="list-unstyled">
            @foreach($skills as $skill)
              <li><a href="#" id="skill" class="editable" data-type="text" data-pk="{{ $skill['id'] }}" data-url="/skills/{{ $skill['id'] }}" data-title="Enter skill">{{ $skill['skill'] }}</a></li>
            @endforeach
          </ul>
        @endif
        <div class="dynamic-form-skill">
        <hr>
          <div class="col-sm-6 col-sm-offset-3">
            <label for="skill">Skill</label>
            <input type="text" name="skill" value="" id="skill-input" class="form-control"> 
          </div>
          
          <div class="form-group col-sm-12 text-center voffset-10">
            <a href="#" class="btn btn-success col-sm-6 col-sm-offset-3" id="post-skill">Add</a>
          </div>
        </div>
        <div class="form-group col-sm-12 text-center voffset-10">
        <button href="" id="add-skill" class="btn btn-default btn-xs col-sm-4 col-sm-offset-4">Add Skill</button>
        </div>
      </div>
  
      <div class="col-sm-6 mid-blocks">
         <h3 class="caps">Education</h3>
         @if(!empty($training))
          @foreach($training as $tr)
           <div class="well">
            Title: <a href="#" id="title" class="editable" data-type="text" data-pk="{{ $tr['id'] }}" data-url="/educations/{{ $tr['id'] }}" data-title="Enter username">{{ $tr['title'] }}</a>

            Place: <a href="#" id="place" class="editable" data-type="text" data-pk="{{ $tr['id'] }}" data-url="/educations/{{ $tr['id'] }}" data-title="Enter username">{{ $tr['place'] }}</a> <br>

            From date: <a href="#" id="from_date" class="editable" data-type="date" data-pk="{{ $tr['id'] }}" data-url="/educations/{{ $tr['id'] }}" data-title="Enter username">{{ $tr['from_date'] }}</a>

            To date: <a href="#" id="to_date" class="editable" data-type="date" data-pk="{{ $tr['id'] }}" data-url="/educations/{{ $tr['id'] }}" data-title="Enter username">{{ $tr['to_date'] }}</a> <br> 
          </div>
          @endforeach
        @endif
        <div class="dynamic-form-education">
        <hr>
          <div class="col-sm-5">
            <label for="title">Course name</label>
            <input type="text" name="title" value="" id="education-title" class="form-control">
          </div>

          <div class="col-sm-5 col-sm-offset-1">
            <label for="place">Place</label>
            <input type="text" name="place" value="" id="education-place" class="form-control">
          </div>

          <div class="col-sm-5">
            <label for="from_date">From</label>
            <input type="date" name="from_date" value="" id="education-fromdate" class="form-control">
          </div>

          <div class="col-sm-5 col-sm-offset-1">
            <label for="to_date">To</label>
            <input type="date" name="to_date" value="" id="education-todate" class="form-control">
          </div>

          <div class="form-group col-sm-12 text-center voffset-10">
            <a href="#" id="post-education" class="btn btn-success col-sm-6 col-sm-offset-3">Add</a>
          </div>
        </div>
        <button id="add-education" class="btn btn-default btn-xs col-sm-4 col-sm-offset-4">Add Education</button>
      </div>
      
      @if($experiences)
      <div class="col-sm-6 mid-blocks" id="experience-section">
        <h3 class="caps">Experience</h3>
        @if(!empty($experiences))
          @foreach($experiences as $exp)
           <div class="well">
            Title: <a href="#" id="title" class="editable" data-type="text" data-pk="{{ $exp['id'] }}" data-url="/experiences/{{ $exp['id'] }}" data-title="Enter username">{{ $exp['title'] }}</a>
            Place: <a href="#" id="place" class="editable" data-type="text" data-pk="{{ $exp['id'] }}" data-url="/experiences/{{ $exp['id'] }}" data-title="Enter username">{{ $exp['place'] }}</a> <br>
            From date: <a href="#" id="from_date" class="editable" data-type="date" data-pk="{{ $exp['id'] }}" data-url="/experiences/{{ $exp['id'] }}" data-title="Enter username">{{ $exp['from_date'] }}</a>
            To date: <a href="#" id="to_date" class="editable" data-type="date" data-pk="{{ $exp['id'] }}" data-url="/experiences/{{ $exp['id'] }}" data-title="Enter username">{{ $exp['to_date'] }} </a><br> 
          </div>
          @endforeach
        @endif
        <div class="dynamic-form-experience">
        <hr>
          <div class="col-sm-5">
            <label for="title">Job title</label>
            <input type="text" name="title" value="" id="experience-title" class="form-control">
          </div>

          <div class="col-sm-5 col-sm-offset-1">
            <label for="place">Place</label>
            <input type="text" name="place" value="" id="experience-place" class="form-control">
          </div>  
          
          <div class="col-sm-5">
            <label for="from_date">From</label>
            <input type="date" name="from_date" value="" id="experience-fromdate" class="form-control">
          </div>

          <div class="col-sm-5 col-sm-offset-1">        
            <label for="to_date">To</label>
            <input type="date" name="to_date" value="" id="experience-todate" class="form-control">
          </div>
          <div class="form-group col-sm-12 text-center voffset-10">
            <a href="#" id="post-experience" class="btn btn-success col-sm-6 col-sm-offset-3">Add</a>
          </div>
        </div>
          <button id="add-experience" class="btn btn-default btn-xs col-sm-4 col-sm-offset-4">Add Experience</button>
      </div>
      @endif

      
      <div class="col-sm-6 mid-blocks">
         <h3 class="caps">Featured-in & Awards</h3>
          @if(!empty($fas))
          @foreach($fas as $fa)
           <div class="well">
            Title: <a href="#" id="title" class="editable" data-type="text" data-pk="{{ $fa['id'] }}" data-url="/fas/{{ $fa['id'] }}" data-title="Enter title">{{ $fa['title'] }} </a><br>
            Date: <a href="#" id="date" class="editable" data-type="text" data-pk="{{ $fa['id'] }}" data-url="/fas/{{ $fa['id'] }}" data-title="Enter date">{{ $fa['date'] }}</a>
          </div>
          @endforeach
        @endif
        <div class="dynamic-form-fa">
        <hr>
          <div class="col-sm-5">
            <label for="title">Title</label>
            <input type="text" name="title" value="" id="fa-title" placeholder="Eg: NY Times Stylist of the year" class="form-control"> <br>
          </div>

          <div class="col-sm-5 col-sm-offset-1">
            <label for="date">Date</label>
            <input type="date" name="date" value="" id="fa-date" class="form-control"> <br>
          </div>

          <div class="col-sm-5">
          This is an Award: <input type="radio" name="achievement" value="1" class="form-control">
          </div>

          <div class="col-sm-5 col-sm-offset-1">
          This is an Feature: <input type="radio" name="achievement" value="0" class="form-control">
          </div>
          <div class="form-group col-sm-12 text-center voffset-10">
            <a href="#" id="post-fa" class="btn btn-success col-sm-6 col-sm-offset-3">Add</a>
          </div>
        </div>
        <button id="add-fa" class="btn btn-default btn-xs col-sm-4 col-sm-offset-4">Add FA</button>

      </div>
      

    </div>
    <hr class="col-xs-12">
    
    <div class="col-sm-12 voffset-10"">
      <h3 class="caps">Latest on Instagram</h3>
      @if(empty($instagrams))
        <a href="/insta_login">Instagram login</a>
      @else
        <div class="col-sm-12" id="lightSlider1">
        @foreach($instagrams as $inst)
          <div class="col-sm-4 works">
            <img src="{{ $inst['images']['low_resolution']['url'] }}" width='400' height='300' alt="">
          </div>
        @endforeach
        </div>
      @endif
    </div>

    <hr class="col-xs-12">
    
    <div class="col-sm-12 voffset-10"">
      <h3 class="caps">Contact info</h3>
      <div class="col-xs-6"><p>{{ $email }}</p></div>
      <div class="col-xs-6"><a href="http://app.joinluli.com/{{ $username }}" class="capitalize"> {{ $username }}</a></div>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<script src="js/profilepage.js"></script>
@endsection