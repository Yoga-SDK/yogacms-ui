@foreach($builder->getItems() as $section)
<div class="panel panel-settings">
    <div class="panel-heading">
        <span class="panel-title">{{ $section->getText() }}</span>
    </div>
    <div class="panel-body text-center">
        @foreach($section->children as $configItem)
        <div class="settings-icon" {!! $configItem->printUrl() !!}>
            {!! $configItem->printIcon() !!}
            <div class="settings-title">{{ $configItem->getText() }}</div>
            <div class="settings-description">
                {{ $configItem->description }}
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach
