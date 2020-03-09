@if(Admin::user()->visible(\Illuminate\Support\Arr::get($item, 'roles', [])) && Admin::user()->can(\Illuminate\Support\Arr::get($item, 'permission')))
    @if(!isset($item['children']))
        <li class="sidebar-item">
            @if(url()->isValidUrl($item['uri']))
                <a href="{{ $item['uri'] }}" target="_blank">
            @else
                 <a href="{{ admin_url($item['uri']) }}">
            @endif
                <i class="fa {{$item['icon']}}"></i>
                @if (Lang::has($titleTranslation = 'admin.menu_titles.' . trim(str_replace(' ', '_', strtolower($item['title'])))))
                    <span>{{ __($titleTranslation) }}</span>
                @else
                    <span>{{ admin_trans($item['title']) }}</span>
                @endif
            </a>
        </li>
    @else
        <li class="sidebar-item">
            <i class="fa {{$item['icon']}}"></i>
            @if (Lang::has($titleTranslation = 'admin.menu_titles.' . trim(str_replace(' ', '_', strtolower($item['title'])))))
                <span>{{ __($titleTranslation) }}</span>
            @else
                <span>{{ admin_trans($item['title']) }}</span>
            @endif
            <ion-icon class="ml-auto" name="chevron-down-outline"></ion-icon>
        </li>

        <li class="sidebar-section">
            @foreach($item['children'] as $child)
            <div data-parent=".sidebar-items" class="sidebar-section-item">
                {{ admin_trans($child['title']) }}
            </div>
            @endforeach
        </li>
    @endif
@endif
