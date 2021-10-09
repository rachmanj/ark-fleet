<li class="nav-item">
  <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('categories') || request()->is('categories/*') ? 'active' : '' }}">
    <i class="fas fa-archive"></i>
    <p>
      Documents
    </p>
  </a>
</li>