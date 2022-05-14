<!-- Heading -->
<div class="sidebar-heading">
    Master Data
</div>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
        <i class="fas fa-fw fa-user"></i>
        <span>User & Access Control</span>
    </a>
    <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('users.index')}}">Users</a>
            <a class="collapse-item" href="{{route('kelurahan.index')}}">Role & Permission</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Wilayah</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('kecamatan.index')}}">Kecamatan</a>
            <a class="collapse-item" href="{{route('kelurahan.index')}}">Desa / Kelurahan</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="{{route('cabor.index')}}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Cabang Olahraga</span>
    </a>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="{{route('saranaPrasarana.index')}}">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Sarana & Prasarana</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
