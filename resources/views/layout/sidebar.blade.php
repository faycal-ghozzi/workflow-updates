<div class="bg-light border-end vh-100 p-3" id="sidebar-wrapper">
  <h6 class="text-muted">Navigation</h6>
  <div class="list-group list-group-flush">
    <a href="#" class="list-group-item list-group-item-action">Dashboard</a>
    
    <a class="list-group-item list-group-item-action" data-bs-toggle="collapse" href="#compensationMenu" role="button" aria-expanded="false" aria-controls="compensationMenu">
      Compensation
    </a>
    <div class="collapse ps-3" id="compensationMenu">
      <a href="{{ route('compensation.list') }}" class="list-group-item list-group-item-action">Liste</a>
      <a href="{{ route('compensation.historique') }}" class="list-group-item list-group-item-action">Historique</a>
      <a href="#" class="list-group-item list-group-item-action">Allowances</a>
      <a href="{{ route('compensation.etat_journalier') }}" class="list-group-item list-group-item-action">État Journalier</a>
    </div>

    <a href="#" class="list-group-item list-group-item-action">Reports</a>
    <a href="#" class="list-group-item list-group-item-action">Settings</a>
  </div>
</div>
