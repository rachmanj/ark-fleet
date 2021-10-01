<li class="nav-item">
  <a href="{{ route('project.index') }}" class="nav-link {{ request()->is('projects') || request()->is('projects/*') ? 'active' : '' }}">
    <i class="fas fa-building"></i>
    <p>
      Projects
    </p>
  </a>
</li>
