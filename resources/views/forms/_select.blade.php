<div class="form-group">
    <label for="exampleInputEmail1">{{$label}}</label>
    <select class="custom-select" name="{{$name}}">
        <option></option>
        @forelse($elements as $element)
            @if (($value ?? false) === $element->getName())
                <option selected value="{{$element->getKey()}}">{{$element->getName()}}</option>
            @else
                <option value="{{$element->getKey()}}">{{$element->getName()}}</option>
            @endif
        @empty
        @endforelse
    </select>
</div>
