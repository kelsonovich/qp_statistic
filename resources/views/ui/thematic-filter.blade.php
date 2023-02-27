
<div class="row mb-3" data-type="thematic">
    @foreach($thematics as $thematic)
        <div class="col d-grid">
            <button type="button"
                    @class([
                        'btn',
                        'btn-outline-primary' => (@app('request')->thematic !== $thematic['value']),
                        'btn-primary' => (@app('request')->thematic === $thematic['value']),
                    ])
                    data-value="{{ $thematic['value'] }}">
                {{ $thematic['title'] }}
            </button>
        </div>
    @endforeach
</div>

<script type="text/javascript" src="{{ asset('js/custom/changeThematic.js') }}"></script>
