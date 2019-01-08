@foreach($relations_list as $relation)
    <div style="background: #282923;color: #FFF;" class="p-2 pr-4 mb-2 mr-3 float-left rounded">
        <span style="color: #67D8EF">function </span>
        <span style="color: #A6DD29">{{ $relation['relationName'] }}</span>
        <span style="color: #FFF">(@include('managerl::models.relations.arguments', ['arguments' => $relation['arguments']]))</span>
        <span>{</span>
        <div class="p-2 ml-4 rounded" style="background: #30312a;">
            <table>
                <tr>@include('managerl::models.relations.option', ['option' => 'parent'])</tr>
                <tr>@include('managerl::models.relations.option', ['option' => 'related'])</tr>
                <tr>@include('managerl::models.relations.option', ['option' => 'foreignKey'])</tr>
                <tr>@include('managerl::models.relations.option', ['option' => 'ownerKey'])</tr>
            </table>
        </div>
        <span>}</span>
    </div>
@endforeach