@foreach($relations_list as $relation)
    <div style="background: #282923;color: #FFF;" class="p-2 mb-2 rounded">
        <span style="color: #67D8EF">function </span>
        <span style="color: #A6DD29">{{ $relation['relationName'] }}</span>
        <span style="color: #FFF">(@include('managerl::models.relations.arguments', ['arguments' => $relation['arguments']]))</span>
        <span>{</span>
        <div class="p-2 ml-4 rounded" style="background: #30312a;">
            <table>
                <tr>
                    <td><span style="color: #FD9621">$this</span>->parent</td>
                    <td><span style="color: #F92472"> = </span></td>
                    <td><span style="color: #67D8EF">{{ $relation['parent'] }}</span><span>::class</span></td>
                </tr>
                <tr>
                    <td><span style="color: #FD9621">$this</span>->related</td>
                    <td><span style="color: #F92472"> = </span></td>
                    <td><span style="color: #67D8EF">{{ $relation['related'] }}</span><span>::class</span></td>
                </tr>
                <tr>
                    <td><span style="color: #FD9621">$this</span>->foreignKey</td>
                    <td><span style="color: #F92472"> = </span></td>
                    <td><span style="color: #E7D559">"{{ $relation['foreignKey'] }}"</span></td>
                </tr>
                <tr>
                    <td><span style="color: #FD9621">$this</span>->localKey</td>
                    <td><span style="color: #F92472"> = </span></td>
                    <td><span style="color: #E7D559">"{{ $relation['localKey'] }}"</span></td>
                </tr>
            </table>
        </div>
        <span>}</span>
    </div>
@endforeach