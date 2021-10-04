<li class="nav-item">
  <a href="{{ route('manufactures.index') }}" class="nav-link {{ request()->is('manufacture') || request()->is('manufacture/*') ? 'active' : '' }}">
    <i class="fas fa-industry"></i>
    <p>
      Manufacture
    </p>
  </a>
</li>