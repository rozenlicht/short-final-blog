<div class="flex rounded-md relative">
    <div class="flex">
        <div class="px-2 py-3">
            <div style="max-height: 100px; max-width: 400px">
                <img src="{{ Storage::url($path) }}" alt="{{ $caption }}" role="img"
                    style="max-height: 100px; max-width: 400px"
                    class="h-full w-full overflow-hidden shadow object-cover" />
            </div>
        </div>

        <div class="flex flex-col justify-center pl-3 py-2">
            <p class="text-sm font-bold pb-1">{{ $caption }}</p>
        </div>
    </div>
</div>
