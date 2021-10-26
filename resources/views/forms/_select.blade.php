<div class="form-group">
    <label for="exampleInputEmail1">{{$label}}</label>
    <select class="custom-select" name="{{$name}}">
        <option></option>
        @forelse($elements as $element)
            <option value="{{$element->getKey()}}">{{$element->getName()}}</option>
        @empty
        @endforelse
    </select>
</div>
