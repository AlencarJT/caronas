<div class="flex gap-4 border-b border-gray-200 pb-2 mb-4">
    @if (true)
        <a href="{{ route('filament.gescar.resources.pessoas.edit', ['record' => $id]) }}"
           class="{{ request()->routeIs('filament.gescar.resources.pessoas.edit') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:underline' }}">
            Pessoa
        </a>

        <a href="{{ route('filament.gescar.resources.enderecos.index') }}?tableFilters[cd_pessoa][value]={{ $id }}"
           class="{{ str(request()->fullUrl())->contains('enderecos') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:underline' }}">
            Endereços
        </a>
    @else
        <span class="text-gray-400">Pessoa</span>
        <span class="text-gray-400">Endereços</span>
@endif
