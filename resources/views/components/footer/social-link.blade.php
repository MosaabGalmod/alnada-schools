@php
	/** @var array{href:string,label:string,bg:string,path:string} $item */
@endphp

<li>
	<a class="social-icon {{ $item['bg'] }}" href="{{ $item['href'] }}" aria-label="{{ $item['label'] }} — مدارس الندى"
		target="_blank" rel="noopener noreferrer">
		<svg class="h-4 w-4 text-white" aria-hidden="true" focusable="false" fill="currentColor" viewBox="0 0 24 24">
			<path d="{{ $item['path'] }}" />
		</svg>
	</a>
</li>