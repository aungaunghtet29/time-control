@extends('layouts.app')

@section('title', 'Alarm')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Save Time Schedule</div>

                    <div class="card-body">
                        <form action="{{ route('home.store') }}" method="post">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    @if (session()->has('fail'))
                                        <span class="alert alert-warning">{{ session()->get('fail') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    @if (session()->has('success'))
                                        <span class="alert alert-success">{{ session()->get('success') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <span class="alert alert-danger">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    Set alarm time
                                </div>

                                <div class="col-md-3 mb-3">

                                    <select name="alarm_hr" id="" class="form-control" required>
                                        <option disabled selected value>hr</option>

                                        @for ($i = 1; $i <= 24; $i++)
                                            <option value="{{ $i }}" {{ old('alarm_hr') }}>{{ $i }}
                                            </option>
                                        @endfor
                                    </select>

                                </div>

                                <div class="col-md-3">
                                    <select name="alarm_min" id="" class="form-control" required>
                                        <option disabled selected value>min</option>

                                        @for ($i = 0; $i <= 60; $i++)
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"
                                                {{ old('alarm_min') }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                            </option>
                                        @endfor

                                    </select>

                                </div>
                            </div>


                           


                            <div class="row mt-4">
                                <div class="col-md-6"></div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary w-50" type="submit">Save</button>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-striped table-responsive">
                    <thead>
                        <th>NO</th>
                        <th>Alarm</th>
                        <th>Brush teeth and Take a bath</th>
                        <th>Breakfast</th>
                        <th>Walking to bus stop</th>
                    </thead>

                    <tbody>
                        @foreach ($alarms as $alarm)
                            <tr>
                                <td>
                                    {{$alarm->id}}
                                </td>
                                <td>
                                    {{$alarm->alarm}}
                                </td>
                                <td>
                                    {{$alarm->take_time_bath}}
                                </td>
                                <td>
                                    {{$alarm->take_time_breakfast}}
                                </td>
                                <td>
                                    {{$alarm->walkig_time}}
                                </td>

                                <td>
                                    <span>
                                        <a href="{{route('home.delete' , $alarm->id)}}" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Delete</a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-2">
                {!! $alarms->links('pagination::bootstrap-4') !!}
    
            </div>
        </div>
    </div>
@endsection
