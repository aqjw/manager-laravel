@extends('managerl::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div>View the model [<strong>{{ $name }}</strong>]</div>
                    </div>
                    <div class="card-body">
                        <div class="title">Relations</div>
                        @foreach($relations as $relationType => $relations_list)
                            <div class="mt-3 mb-5">
                                <div class="h4">{{ $relationType }}</div>
                                @includeIf('managerl::models.relations.' . $relationType,
                                    compact('relations_list')
                                )
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection