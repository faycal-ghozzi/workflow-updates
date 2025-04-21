@if(!empty($derniereCompensation) && is_iterable($derniereCompensation))
    <ul>
        @foreach($derniereCompensation as $compensation)
            <li>{{ json_encode($compensation) }}</li>
        @endforeach
    </ul>
@else
    <p class="text-muted">Aucune compensation trouvé.</p>
@endif