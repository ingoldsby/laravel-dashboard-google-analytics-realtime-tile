<x-dashboard-tile :position="$position">
	<div class="grid gap-2 justify-items-center h-full text-center" style="grid-template-rows: auto 1fr auto;">
		<h1>Realtime Devices</h1>
		<div class="p-2">
			<div class="grid gap-2 h-full">
				<div wire:poll.{{ $refreshIntervalInSeconds }}s>
					@foreach ($devices as $key => $value)
					<div class="text-dimmed p-1 text-xs tracking-wide tabular-nums">{{ $key }}: {{ $value }} @if ($value == 1)visitor @else visitors @endif</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</x-dashboard-tile>