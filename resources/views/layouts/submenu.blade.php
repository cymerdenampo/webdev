<div class="col-md-12 sticky header" id="myHeader">
    <div class="row custom-container">
        <a class="btn btn-link flex-icons  {{ Request::routeIs('welcomei') ? 'active' : '' }}" href="/">
            <i class="fa-solid fa-bars-staggered"></i>
            <label>All Listings</label>
        </a>
        <a class="btn btn-link flex-icons {{ request()->is('buy') ? 'active' : '' }}" href="buy">
            <i class="fa-solid fa-bag-shopping"></i>
            <label>Buy</label>
        </a>
        <a class="btn btn-link flex-icons {{ request()->is('lease') ? 'active' : '' }}" href="lease">
            <i class="fa-solid fa-file-signature"></i>
            <label>Lease</label>
        </a>
        <a class="btn btn-link flex-icons {{ request()->is('sold') ? 'active' : '' }}" href="sold">
            <i class="fa-solid fa-file-signature"></i>
            <label>Sold</label>
        </a>
        <a data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
            class="btn btn-link flex-icons {{ request()->is('search') ? 'active' : '' }} navbar-toggle-box" style="line-height: unset; padding: 6px 6px;">
            <i class="fa-solid fa-magnifying-glass"></i>
            <label>Search</label>
    </a>
    </div>
</div>

@push('css')
    <style>
        .non-sticky {
            box-shadow: none;
            background: transparent;
            border-top: none;
        }
    </style>
@endpush
