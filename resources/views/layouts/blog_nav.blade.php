<div class="nav-scroller py-1 mb-2">

<ul class="nav nav-pills nav-fill d-flex justify-content-between">
  
          <!-- For sub menus -->
          @foreach($menus as $menu)
            @if ($menu['category']=='sub')
            <li class="nav-item">
              <a class="p-2 nav-link {{ Request::segment(1) === strtolower($menu['label']) ? 'active' : null }}"  href="{!! $menu['url'] !!}">{!! $menu['label'] !!}</a>
            </li>
            @endif
          @endforeach
          </ul>
      
        </div>

        