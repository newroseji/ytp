<div class="nav-scroller py-1 mb-2">
<nav class="nav d-flex justify-content-between">
          
          <!-- For sub menus -->
          @foreach($categories as $cat)
            @if ($cat['category']=='sub')
              <a class="p-2 text-muted" href="{!! $cat['url'] !!}">{!! $cat['label'] !!}</a>
            @endif
          @endforeach
        </nav>
        
        </div>