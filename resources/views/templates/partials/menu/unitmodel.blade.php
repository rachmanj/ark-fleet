<li class="nav-item">
  <a href="{{ route('unitmodels.index') }}" class="nav-link {{ request()->is('unitmodels') || request()->is('unitmodels/*') ? 'active' : '' }}">
    <i class="fas fa-drafting-compass"></i>
    <p>
      Unit Model
    </p>
  </a>
</li>