@extends('managerl::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @include('managerl::components.errors')
                        @include('managerl::components.message')
						<h1>Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection