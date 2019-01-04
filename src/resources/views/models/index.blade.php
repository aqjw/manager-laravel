@extends('managerl::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Title</div>
                    <div class="card-body">
                        @include('managerl::components.errors')
                        @include('managerl::components.message')
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>namespace</th>
                                    <th>Size (byte)</th>
                                    <th>Last updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($models as $model)
                                    <tr>
                                        @php( $namespace = explode('.', $model['name']) )
                                        @php( $modelname = array_pop($namespace) )
                                        <td style="background: #282923;color: #FFF;white-space: nowrap;">
                                            <a href="{{ route('managerl.models.view', $model['name']) }}">
                                            <span style="color: #F92472">use </span>
@foreach($namespace as $namespace_item)<span style="color: #A6DD29">{{ $namespace_item }}</span><span style="color: #FFF">\</span>@endforeach
<span style="color: #67D8EF">{{ $modelname }}</span><span style="color: #FFF">;</span>
                                            </a>
                                        </td>
                                        <td>{{ $model['size'] }}</td>
                                        <td>{{ $model['updated_at'] }}</td>
                                        <td>
                                            <a href="{{ route('managerl.models.view', $model['name']) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection