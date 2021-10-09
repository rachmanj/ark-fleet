<li class="nav-item">
  <a href="{{ route('manufactures.index') }}" class="nav-link {{ request()->is('manufactures') || request()->is('manufactures/*') ? 'active' : '' }}">
    <i class="fas fa-industry"></i>
    <p>
      Manufacture
    </p>
  </a>
</li>