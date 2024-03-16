<x-app-layout>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Issues</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('issues.create') }}" class="btn btn-sm btn-outline-secondary">
                    Adicionar
                </a>
            </div>
        </div>
    </div>

    <livewire:issues.table />
</x-app-layout>
