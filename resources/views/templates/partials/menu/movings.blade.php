<li class="nav-item {{ request()->is('movings') || request()->is('movings/*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->is('movings') || request()->is('movings/*') ? 'active' : '' }}">
    <i class="fas fa-route"> </i>
    <p>
      Movings
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('movings.index') }}" class="nav-link {{ request()->is('movings') || request()->is('movings/*') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>IPA List</p>
      </a>
    </li>
  </ul>
</li>