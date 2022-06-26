@extends('layouts.app')


@section('title', 'Movie Time')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Movie Time
                    </div>

                    <div class="card-body">
                        @foreach ($movies as $movie)
                                @if ((int)$user->time_to_cinema < (int)$movie->movie_time)
                                    <h3 class="text-center">
                                        You can catch the time {{ $movie->movie_time }}
                                    </h3>
                                @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
