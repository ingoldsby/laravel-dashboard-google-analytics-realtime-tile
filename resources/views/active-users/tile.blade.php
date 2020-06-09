<x-dashboard-tile :position="$position" :fade="false">
	<div class="absolute inset-0 p-4 @if ($activeUsers <= (config('dashboard.tiles.google_analytics_realtime.active_users_warning_threshold'))) bg-warning @endif">
		<div class="grid gap-2 justify-items-center h-full text-center" style="grid-template-rows: auto 1fr auto;">
			<div class="grid gap-4 justify-items-center h-full text-center">
				<div class="font-medium text-dimmed text-sm tracking-wide tabular-nums">Right now</div>
				<div wire:poll.{{ $refreshIntervalInSeconds }}s>
					<div class="self-center font-bold text-4xl tracking-wide leading-none">{{ $activeUsers }}</div>
				</div>
				<div class="flex w-full justify-center space-x-4 items-center text-xs text-dimmed">active users on site</div>
			</div>
		</div>
	</div>
</x-dashboard-tile>