@if(!empty($result))
    <ul>
        @foreach($result as $item)
            <li>{{ json_encode($item) }}</li>
        @endforeach
    </ul>
@else
    <p class="text-muted">Aucune information trouvée.</p>
@endif