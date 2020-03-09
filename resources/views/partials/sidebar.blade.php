<div id="sidebar">
    <div class="sidebar-block pt-3 px-4 justify-content-center">
        <img height="30px"{!! $builder->printHomeLink() !!}} src="{{ $builder->logo }}">
    </div>

    <ul class="sidebar-items accordion">
        @foreach ($builder->getItems() as $section)
        <li id="{{ $section->getId() }}" class="sidebar-divider">
            {{ $section->getText()   }}
        </li>
        @foreach($section->children as $menuItem)
        <li id="{{ $menuItem->getId($section->slug) }}" {!! $menuItem->printUrl() !!} @if($menuItem->hasChildren()) data-toggle="collapse" data-target="#{{ $menuItem->getId($section->slug.'-collapse')  }}" @endif class="sidebar-item {{ $menuItem->isActive('active', '') }}"><!-- fim da abertura do li -->

            {!! $menuItem->printIcon() !!}
            {{ $menuItem->getText() }}

            @if($menuItem->hasChildren())
            <ion-icon class="ml-auto" name="chevron-down-outline"></ion-icon>

            <li id="{{ $menuItem->getId($section->slug.'-collapse') }}" class="sidebar-section collapse {{ $menuItem->isActive('show', '') }}"><!-- fim do li -->

                @foreach($menuItem->children as $menuItemChild)
                <div id="{{ $menuItemChild->getId($section->slug.'-'.$menuItem->slug) }}"  data-parent=".sidebar-items" {!! $menuItemChild->printUrl() !!} class="sidebar-section-item {{ $menuItemChild->isActive('active', '') }}" >
                    {!! $menuItemChild->printIcon() !!}
                    {{ $menuItemChild->getText() }}
                </div>
                @endforeach
            </li>
            @endif
        </li>
        @endforeach
        @endforeach
    </ul>

    <div class="sidebar-block inverse">
        @foreach(array_reverse($builder->getFooterItems()) as $item)
        <span {!! $item->printUrl() !!} class="icon-button" data-toggle="tooltip" title="{{ $item->getText() }}">
            {!! $item->printIcon() !!}
        </span>
        @endforeach
    </div>
</div>
