@php
	/** @var array{label:string,value:string,iconPath:string,href:?string,lang:?string,dir:?string} $item */
	$isLink = !empty($item["href"]);
@endphp

@if ($isLink)
	<a class="footer-contact-item group" href="{{ $item["href"] }}"
		@if ($item["lang"]) lang="{{ $item["lang"] }}" @endif
		@if ($item["dir"]) dir="{{ $item["dir"] }}" @endif>
		<span class="footer-contact-icon">
			<svg class="h-4 w-4 text-primary-300 transition-colors duration-200 group-hover:text-white" aria-hidden="true"
				focusable="false" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item["iconPath"] }}" />
			</svg>
		</span>
		<span class="min-w-0 flex-1 break-words">
			<span class="mb-1 block text-xs text-primary-400" dir="rtl">{{ $item["label"] }}</span>
			<span class="text-sm font-medium text-primary-100">{{ $item["value"] }}</span>
		</span>
	</a>
@else
	<div class="footer-contact-item">
		<span class="footer-contact-icon">
			<svg class="h-4 w-4 text-primary-300" aria-hidden="true" focusable="false" fill="none" stroke="currentColor"
				viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item["iconPath"] }}" />
			</svg>
		</span>
		<span class="min-w-0 flex-1 break-words">
			<span class="mb-1 block text-xs text-primary-400">{{ $item["label"] }}</span>
			<span class="text-sm leading-6 text-primary-100">{{ $item["value"] }}</span>
		</span>
	</div>
@endif
