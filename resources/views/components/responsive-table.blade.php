{{-- Componente tabla responsiva genérico --}}
<div class="bg-white shadow rounded-lg mb-6">
    <div class="custom-scrollbar overflow-x-auto tabla-responsive">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 sticky top-0 z-10">
                <tr>
                    {{ $head }}
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                {{ $body }}
            </tbody>
        </table>
    </div>
    @if (isset($pagination))
        <div class="p-4 border-t border-gray-200 bg-gray-50">
            {{ $pagination }}
        </div>
    @endif
</div>
