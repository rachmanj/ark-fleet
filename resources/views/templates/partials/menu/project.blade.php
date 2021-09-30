<li class="nav-item {{ request()->is('projects') || request()->is('projects/*') ? 'menu-open' : '' }}">
  <a href="{{ route('project.index') }}" class="nav-link">
    <i class="nav-icon fas fa-building"></i>
    <p>
      Projects
    </p>
  </a>
</li>