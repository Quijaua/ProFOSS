<x-app-layout>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $user->name }}</h1>
    </div>

    <div class="my-4">
        <ul class="list-group list-group-horizontal">
            @if($website = $user->website)
                <li class="list-group-item">
                    <p class="fw-bold mb-0">Website:</p>
                    <a href="{{ $website }}" target="_blank">{{ $website }}</a>
                </li>
            @endif

            @if($local = $user->local)
                <li class="list-group-item">
                    <p class="fw-bold mb-0">Localidade:</p>
                    <p class="mb-0">{{ $local }}</p>
                </li>
            @endif
        </ul>
    </div>

    <h4>Issues</h4>

    <livewire:issues.table :creator="$user" />
</x-app-layout>
