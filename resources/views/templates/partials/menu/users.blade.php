<li class="nav-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
    <i class="fas fa-users"></i>
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
      <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }} ">
        <i class="far fa-circle nav-icon"></i>
        <p>User List</p>
      </a>
    </li>
  </ul>
</li>