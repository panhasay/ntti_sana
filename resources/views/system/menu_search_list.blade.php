<div class="contentMenu">
    @if(isset($menus))
        <div class="vertical-menu scrollbar-style-12">
            @if(count($menus) > 0)
                @foreach($menus as $menu)
                    <a href="{{ $menu->url_link }}"><i class="mdi mdi-magnify"></i> {{ $menu->title }} </a>
                @endforeach
            @endif
        </div>
    @endif
</div>