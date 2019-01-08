@if(false !== strpos($relation[$option], '\\'))
    <td><span style="color: #FD9621">$this</span>->{{ $option }}</td>
    <td><span style="color: #F92472"> = </span></td>
    <td>
        <a href="{{ route('managerl.models.view', str_replace('\\', '.', $relation[$option])) }}">
            <span style="color: #67D8EF">{{ $relation[$option] }}</span><span style="color: #FFF">::class</span>
        </a>
    </td>
@else
	<td><span style="color: #FD9621">$this</span>->{{ $option }}</td>
	<td><span style="color: #F92472"> = </span></td>
	<td><span style="color: #E7D559">"{{ $relation[$option] }}"</span></td>
@endif