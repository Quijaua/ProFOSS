<div class="table-responsive small">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">Título</th>
            <th scope="col">Link</th>
            <th scope="col">Responsável</th>
            <th scope="col">Votos</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @forelse($issues as $issue)
            <tr>
                <td>{{ $issue->title }}</td>
                <td>
                    <a href="{{ $issue->url }}" target="_blank">
                        {{ $issue->url }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('profile.show', $issue->createdBy->id) }}">
                        {{ $issue->createdBy->name }}
                    </a>
                </td>
                <td>
                    <p class="mb-2">{{ max($issue->totalUpvotes(), 0) }}</p>
                    <livewire:issues.vote :issue="$issue" wire:key="issue-vote-{{ $issue->id }}-{{ time() }}" />
                </td>
                <td>
                    <a href="{{ route('issues.show', $issue->id) }}" class="btn btn-sm btn-outline-primary">
                        Ver
                    </a>

                    @can('update', $issue)
                        <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-sm btn-outline-secondary">
                            Editar
                        </a>
                    @endcan

                    @can('delete', $issue)
                        <form action="{{ route('issues.destroy', $issue->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger ">
                                Excluir
                            </button>
                        </form>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Nenhum dado cadastrado.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $issues->links() }}
</div>
