<x-dashboard-tile :position="$position">
	<div class="grid gap-2 justify-items-center h-full" style="grid-template-rows: auto 1fr auto;">
		<div wire:poll.{{ $refreshIntervalInSeconds }}s>
			<h1 class="text-center">Realtime Pages (top {{ count($urls) }})</h1>
			<div class="p-2">
				<div class="grid gap-2 h-full">
					@foreach ($urls as $key => $value)
					<div class="text-dimmed text-xs tracking-wide tabular-nums">{{ $value }} @if ($value == 1) visitor @else visitors @endif: {{ $key }}</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</x-dashboard-tile>