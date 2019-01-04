@if(session('message'))
    <div class="alert alert-{{ session('message.type', 'info')}}" role="alert">
        <strong>{{ session('message.text') }}</strong>
    </div>
@endif