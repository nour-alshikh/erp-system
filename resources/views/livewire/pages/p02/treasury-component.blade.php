<div>
    {{$this->table}}

    <!-- Modal -->
    @if($showModal)
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-lg font-semibold mb-4">Treasury Details</h2>

            @foreach ($subTreasuries as $subTreasury)
            <p>
                {{ $subTreasury->name}}
            </p>
            @endforeach

            <div class="block mt-2">
                <button wire:click="closeModal"
                    class=" w-full px-4 py-2 bg-gray-600  text-white rounded-lg">Close</button>
            </div>
        </div>
    </div>
    @endif
</div>
