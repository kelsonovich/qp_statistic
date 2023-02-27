
<select class="form-control mb-3">
    @foreach($thematics as $thematic)
        <option value="{{ $thematic->id }}" @selected(app('request')->get('thematic') == $thematic->id)>
            {{ $thematic->title }}
        </option>
    @endforeach
</select>
