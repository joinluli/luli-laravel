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
              <li>{{ $skill['skill'] }}</li>
            @endforeach
          </ul>
        @endif
        <div class="dynamic-form-skill">
          <label for="skill">Skill</label>
          <input type="text" name="skill" value="" id="skill-input"> <a href="#" class="btn" id="post-skill">Add</a>
        </div>
        <button href="" id="add-skill" class="btn btn-default">Add Skill</button>
      </div>
  
      <div class="col-sm-6">
         <h3 class="caps">Education</h3>
         @if(!empty($training))
          {{  }}
        @endif
        <div class="dynamic-form-education">
          <label for="skill">Skill</label>
          <input type="text" name="skill" value="" id="skill-input"> <a href="#" class="btn" id="post-skill">Add</a>
          <label for="skill">Skill</label>
          <input type="text" name="skill" value="" id="skill-input"> <a href="#" class="btn" id="post-skill">Add</a>
          <label for="skill">Skill</label>
          <input type="text" name="skill" value="" id="skill-input"> <a href="#" class="btn" id="post-skill">Add</a>
        </div>
      </div>
      
      @if($experiences)
      <div class="col-sm-6">
         <h3 class="caps">Experience</h3>
      </div>
      @endif
      @if($fas)
      <div class="col-sm-6">
         <h3 class="caps">Featured-in & Awards</h3>
      </div>
      @endif
    </div>
    
    <hr class="col-xs-12">
    
    <div class="col-sm-12 voffset-10"">
      <h3 class="caps">Latest on Instagram</h3>

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
<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(document).ready(function(){
    $("#lightSlider").lightSlider(); 

    // ------- adding skills ----------
    $("#add-skill").click(function(){
        $('.dynamic-form-skill').show("fast");
    });
    // Post the skill
    $("#post-skill").click(function(){

      var skill = $("#skill-input").val();
      $.post( "/skills", { skill: skill } , function(){
        location.reload();
      });

    });

    // ------------- adding education ------------
     $("#add-education").click(function(){
        $('.dynamic-form-education').show("fast");
    });

    // -------------- adding experience ----------

    // ------------- adding F & A -------------

  });
  $.fn.editable.defaults.mode = 'inline';
  $(document).ready(function() {
    $('#username').editable();
});
</script>
@endsection