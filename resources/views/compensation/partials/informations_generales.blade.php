<h5>Informations Globales</h5>

@if(!empty($infosGlobales) && is_iterable($infosGlobales))
    <ul>
        @foreach($infosGlobales as $info)
            <li>{{ json_encode($info) }}</li>
        @endforeach
    </ul>
@else
    <p class="text-muted">Aucune information globale trouvée.</p>
@endif

<hr>

<h5>Engagements Gérant</h5>

@if(!empty($engagementsGerant) && is_iterable($engagementsGerant))
    <ul>
        @foreach($engagementsGerant as $engagement)
            <li>{{ json_encode($engagement) }}</li>
        @endforeach
    </ul>
@else
    <p class="text-muted">Aucun engagement gérant trouvé.</p>
@endif
