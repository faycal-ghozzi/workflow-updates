<h5>Comptes Client</h5>

{{-- TO DO: VERIFY T24 RESPONSE IF IT HAS RELATED ACCOUNTS --}}

@if(!empty($infosGlobales) && is_iterable($infosGlobales))
    <ul>
        @foreach($infosGlobales as $info)
            <li>{{ json_encode($info) }}</li>
        @endforeach
    </ul>
@else
    <p class="text-muted">Aucune information trouvé.</p>
@endif