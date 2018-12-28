<div class="nav-scroller py-1 mb-2">
<nav class="nav d-flex justify-content-between">
          
          <!-- For sub menus -->
          @foreach($menus as $menu)
            @if ($menu['category']=='sub')
              <a class="p-2 text-muted" href="{!! $menu['url'] !!}">{!! $menu['label'] !!}</a>
            @endif
          @endforeach
        </nav>
        
        </div>