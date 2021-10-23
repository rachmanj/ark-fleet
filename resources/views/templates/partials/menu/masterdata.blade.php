<li class="nav-item {{ request()->is('asset_categories') || request()->is('asset_categories/*') ||
    request()->is('asset_groups') || request()->is('asset_groups/*') ||
    request()->is('manufactures') || request()->is('manufactures/*') ||
    request()->is('projects') || request()->is('projects/*') ||
    request()->is('planttypes') || request()->is('planttypes/*') ||
    request()->is('suppliers') || request()->is('suppliers/*') ||
    request()->is('unitmodels') || request()->is('unitmodels/*') ||
    request()->is('unitstatuses') || request()->is('unitstatuses/*')
    ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->is('equipments') || request()->is('equipments/*') ? 'active' : '' }}">
    <i class="fas fa-file-alt"></i>
    <p>
      Master Data
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
        @include('templates.partials.menu.asset_categories')
        @include('templates.partials.menu.asset_groups')
        @include('templates.partials.menu.doctypes')
        @include('templates.partials.menu.manufacture')
        @include('templates.partials.menu.project')
        @include('templates.partials.menu.planttypes')
        @include('templates.partials.menu.suppliers')
        @include('templates.partials.menu.unitmodel')
        @include('templates.partials.menu.unitstatus')
    </li>
  </ul>
</li>