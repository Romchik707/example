<?php
if (isset($name)) {
    if (isset($frd, $name)) {
        $frdVal = $frd[$name] ?? null;
    }
    $selected = $value ?? $frdVal ?? old($name);
//    dd($value);
}
?>

<select class="dropdown-primary md-form selectize {{$class??''}}" name="{{$name}}" multiple searchable="Search here..">
    <option disabled>{{$text??''}}</option>
    @forelse($selected ??[] as $object)
        <option class="selectize-dropdown-content" value="{{$object->getKey()}}" selected>
            {{$object->getName()}}</option>
    @empty
    @endforelse

    @forelse($elements as $key=>$object)
        <option class="selectize-dropdown-content" value="{{$object->getKey()}}">
            {{$object->getName()}}</option>
    @empty
    @endforelse

    @forelse($elements as $role)
        @if ($user->hasRole($role->getName()) === true)
        <option class="selectize-dropdown-content" value="{{$role->getKey()}}" selected>
            {{$role->getName()}}</option>
        @endif
    @empty
    @endforelse
</select>
