<li class="nav-item {{ request()->is('equipments') || request()->is('equipments/*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->is('equipments') || request()->is('equipments/*') ? 'active' : '' }}">
    <i class="fas fa-snowplow"></i>
    <p>
      Users
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('user.activate_index') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Activate User</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('users.index') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>User List</p>
      </a>
    </li>
  </ul>
</li>