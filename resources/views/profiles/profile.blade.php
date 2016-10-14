@extends('layouts.app')
@section('content')
<div class="">
  <div class="col-sm-12">
    <h1>User profile</h1>
    <img src="{{ url($profile['dp_permalink']) }}" alt="" width="300"/>
    <h3>{{ $profile['tagline_1'] }} . {{ $profile['tagline_2'] }} . {{ $location['location_short'] }}</h3>
    <hr>
    <div class="col-sm-12">
      <h2>Featured In & Awards</h2>
      <div class="">
        @foreach($fas as $fa)
        <div class="col-sm-4">
            @if($fa['achievement'])
              <i class="fa fa-trophy fa-4x" aria-hidden="true"></i>
            @else
              <i class="fa fa-star fa-4x" aria-hidden="true"></i>
          @endif
          <p>
            {{ $fa['title'] }}
          </p>
          <p>
            {{ $fa['description'] }}
          </p>
          </div>
        @endforeach
      </div>
    </div>
    <hr>
    <div class="col-sm-12">
      <h2>Instagram</h2>

    </div>
    <hr>
    <div class="col-sm-12">
      <h2>Works</h2>
      @foreach($works as $work)
        <div class="col-sm-3">
          <img src="{{ url($work['image_permalink']) }}" alt="" width='300' height='300' style="padding-right: 50px;"/>
          <strong>{{ $work['title'] }}</strong>
          <p>
            {{ $work['comment'] }}
          </p>
        </div>
      @endforeach
    </div>
    <hr>
    <div class="col-sm-12">
      <div id="exTab1" class="container">
          <ul  class="nav nav-pills">
        			<li class="active">
                <h4><a  href="#2a" data-toggle="tab">Experience      |</a></h4>
        			</li>
        			<li>
                <h4><a href="#3a" data-toggle="tab">      Freelance      |</a></h4>
        			</li>
        			<li>
                <h2><a href="#4a" data-toggle="tab">Training</a></h2>
        			</li>
        		</ul>
      			<div class="tab-content clearfix">

      				<div class="tab-pane active" id="2a">
                @foreach($experiences as $exp)
                  <ul>
                    <li><h3>{{ $exp['title'] }}</h3></li>
                    <li>{{ $exp['description'] }}</li>
                  </ul>
                @endforeach
      				</div>

              <div class="tab-pane" id="3a">
                @foreach($freelance as $f)
                  <ul>
                    <li><h3>{{ $f['title'] }}</h3></li>
                    <li>{{ $f['description'] }}</li>
                  </ul>
                @endforeach
      				</div>
              <div class="tab-pane" id="4a">
                @foreach($training as $t)
                  <ul>
                    <li><h3>{{ $t['title'] }}</h3></li>
                    <li>{{ $t['description'] }}</li>
                  </ul>
                @endforeach
    				  </div>
      			</div>
        </div>

    </div> <!-- end of experiences div -->

    <div class="col-sm-12">
      <h2>Skills</h2>
        <ul>
      @foreach($skills as $skill)
          <li>{{ $skill['skill'] }}</li>
      @endforeach
      </ul>
    </div> <!-- end of Skills -->

    <div class="col-sm-12">
      <h2>Groups</h2>
        <ul>
        @foreach($groups as $group)
            <li>{{ $group['title'] }}</li>
        @endforeach
        </ul>
    </div>
  </div>
</div>
@endsection
