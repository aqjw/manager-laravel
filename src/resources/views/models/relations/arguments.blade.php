@foreach($arguments as $argument)
	<span style="color: #FD9621">${{ $argument['name'] }}</span>
	<span style="color: #F92472"> = </span>
@if(is_integer($argument['default']))
<span style="color: #AC80FF">{{ $argument['default'] }}</span>@if(!$loop->last), @endif
@else
<span style="color: #E7D559">"{{ $argument['default'] }}"</span>@if(!$loop->last), @endif
@endif
@endforeach