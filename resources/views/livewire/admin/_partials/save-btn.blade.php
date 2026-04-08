<button class="btn-primary" type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-75 cursor-not-allowed"
    wire:target="{{ $target ?? '' }}">
    <span wire:loading.remove wire:target="{{ $target ?? '' }}">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        {{ $label ?? 'حفظ' }}
    </span>
    <span class="flex items-center gap-2" wire:loading wire:target="{{ $target ?? '' }}">
        <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        جاري الحفظ...
    </span>
</button>
