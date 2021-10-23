<li class="nav-item">
  <a href="{{ route('asset_groups.index') }}" class="nav-link {{ request()->is('asset_groups') || request()->is('asset_groups/*') ? 'active' : '' }}">
    <i class="far fa-circle nav-icon"></i>
    <p>
      Asset Groups
    </p>
  </a>
</li>