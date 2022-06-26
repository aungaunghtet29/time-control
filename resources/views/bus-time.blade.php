@extends('layouts.app')

@section('title', 'Bus Time')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Bus Time
                    </div>

                    <div class="card-body">

                        <form action="{{ route('bus.store') }}" method="post">

                            @csrf

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

                            <div class="row mb-4 mt-3">
                                <div class="col-md-6">
                                    Bus Time
                                </div>

                                <div class="col-md-3 mb-3">
                                    <select name="bus_time_hr" id="" class="form-control" required>
                                        <option disabled selected value>hr</option>
                                        
                                            @for ($i = 1; $i <= 24; $i++)
                                                @if ($i > (int)$user->alarm)
                                            
                                                <option value="{{ $i }}">{{ $i  }}</option>
                                                @endif
                                            @endfor
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="bus_time_min" id="" class="form-control" required>
                                        <option disabled selected value>min</option>

                                        @for ($i = 0; $i <= 60; $i++)
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">
                                                {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
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
            <div class="col-md-6">
                <table class="table table-striped table-responsive">
                    <thead>
                        <th>NO</th>
                        <th>Bus Time</th>
                        <th>Time to Cinema</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach ($buses as $bus)
                            <tr>
                                <td>
                                    {{ $bus->id }}
                                </td>
                                <td>
                                    {{ $bus->bus_time }}
                                </td>
                                <td>
                                    {{ $bus->time_to_cinema }}
                                </td>

                                <td>
                                    <span>
                                        <a href="{{ route('bus.delete', $bus->id) }}" class="btn btn-sm btn-danger"> <i
                                                class="fa fa-trash"></i> Delete</a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
