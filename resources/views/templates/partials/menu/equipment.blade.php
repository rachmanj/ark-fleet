<li class="nav-item {{ request()->is('equipments') || request()->is('equipments/*') ||
  request()->is('movings') || request()->is('movings/*') ||
  request()->is('unitnohistories') || request()->is('unitnohistories/*')
? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->is('equipments') || request()->is('equipments/*') ? 'active' : '' }}">
    <i class="fas fa-snowplow"></i>
    <p>
      Equipments
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('equipments.index') }}" class="nav-link {{ request()->is('equipments') || request()->is('equipments/*') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>List</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('movings.index') }}" class="nav-link {{ request()->is('movings') || request()->is('movings/*') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Movings</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('unitnohistories.index') }}" class="nav-link {{ request()->is('unitnohistories') || request()->is('unitnohistories/*') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Unit Number Change</p>
      </a>
    </li>
  </ul>
</li>