<h5>Tombées</h5>

@if(!empty($tombees) && is_iterable($tombees))
    <ul>
        @foreach($tombees as $tombe)
            <li>{{ json_encode($tombe) }}</li>
        @endforeach
    </ul>
@else
    <p class="text-muted">Aucune Tombée trouvée.</p>
@endif

<hr>

<h5>Encours</h5>

@if(!empty($encours) && is_iterable($encours))
    <ul>
        @foreach($encours as $encour)
            <li>{{ json_encode($encour) }}</li>
        @endforeach
    </ul>
@else
    <p class="text-muted">Aucun encour trouvé.</p>
@endif
