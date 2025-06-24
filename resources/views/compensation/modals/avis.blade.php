<div class="modal fade" id="modal_list_avis_{{ $view_comp->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Historique des Avis</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="timeline">
                            <div class="time-label">
                                <span class="bg-danger">{{ now()->format('d-m-Y') }}</span>
                            </div>

                            @foreach($view_comp->avis_comp as $avis)
                                <div>
                                    <i class="fas fa-user bg-success"></i>
                                    <div class="timeline-item">
                                        <span class="time">
                                            <i class="fas fa-clock"></i>
                                            {{ $avis->created_at->addHour()->format('d-m-Y H:i:s') }}
                                        </span>
                                        <h3 class="timeline-header no-border">
                                            <a href="#">{{ $avis->user_func->name }} :</a>
                                            {!! nl2br(e($avis->text_avis)) !!}
                                        </h3>

                                        @foreach($view_comp->compensation_status_d as $decision)
                                            @if ($avis->created_at->format('H:i') === $decision->created_at->format('H:i') && $avis->user_id === $decision->user_id)
                                                <h3 class="timeline-header no-border">
                                                    @php
                                                        $decisionLabels = [
                                                            1 => ['class' => 'success', 'text' => 'Accepté'],
                                                            2 => ['class' => 'danger', 'text' => 'Refusé'],
                                                            3 => ['class' => 'warning', 'text' => 'Arbitrage'],
                                                        ];
                                                        $label = $decisionLabels[$decision->designation];
                                                    @endphp

                                                    <span class="badge badge-{{ $label['class'] }}">
                                                        {{ $label['text'] }} par {{ $decision->user_call->name }}
                                                    </span>
                                                    <span class="badge badge-{{ $label['class'] }}">{{ $avis->role_user }}</span>
                                                </h3>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                            <div>
                                <i class="fas fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
