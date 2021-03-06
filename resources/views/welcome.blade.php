@extends('layouts.app')

@section('page')
@if ($data === NULL)
<script type="text/javascript">
    alert("data not found");
</script>
<div class="hero" data-bg-image="{{ asset('images/banner.png') }}">
    <div class="container">
        <form action="" method="post" class="find-location">
            {{ csrf_field() }}
            <input type="text" name="q" placeholder="Find your location...">
            <input type="submit" value="Find">
        </form>
    </div>
</div>
@else
<div class="hero" data-bg-image="{{ asset('images/banner.png') }}">
    <div class="container">
        <form action="" method="post" class="find-location">
            {{ csrf_field() }}
            <input type="text" name="q" placeholder="Find your location...">
            <input type="submit" value="Find">
        </form>
    </div>
</div>
<div class="forecast-table">
    <div class="container">
        <div class="forecast-container">
            <div class="today forecast">
                <div class="forecast-header">
                    <div class="day">{{ date('l', strtotime($data[0]['days'])) }}</div>
                    <div class="date">{{ date('d M', strtotime($data[0]['days'])) }}</div>
                </div> <!-- .forecast-header -->
                <div class="forecast-content">
                    <div class="location">{{ $data[0]['city'] }}</div>
                    <div class="degree">
                        <div class="num">{{ $data[0]['temperature'] }}</div>
                        <div class="forecast-icon">
                            <img src="{{ $data[0]['weather_icon'] }}" alt="" width="90">
                        </div>	
                    </div>
                    <span><img src="images/icon-umberella.png" alt="">{{ $data[0]['weather_name'] }}</span>
                    <span><img src="images/icon-wind.png" alt="">{{ $data[0]['wind'] }}</span>
                    <span><img src="images/icon-compass.png" alt="">{{ $data[0]['direction'] }}</span>
                </div>
            </div>
            @for($i = 1; $i<count($data); $i++)
            <div class="forecast">
                <div class="forecast-header">
                    <div class="day">{{ date('l', strtotime($data[$i]['days'])) }}</div>
                </div> <!-- .forecast-header -->
                <div class="forecast-content">
                    <div class="forecast-icon">
                        <img src="{{ $data[$i]['weather_icon'] }}" alt="" width="48">
                    </div>
                    <div class="degree">{{ $data[$i]['max_temp'] }}</div>
                    <small>{{ $data[$i]['min_temp'] }}</small>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
@endif
@endsection