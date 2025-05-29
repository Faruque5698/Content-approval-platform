<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                {{-- User Management: শুধু Admin এর জন্য --}}
                @if(auth()->check() && auth()->user()->isAdmin())
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        User Management
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                         data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('admin.users.index')}}">List</a>
                            <a class="nav-link" href="{{route('admin.users.create')}}">Add</a>
                        </nav>
                    </div>
                @endif

                {{-- Post Management: admin & user উভয়ের জন্য --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts_post"
                   aria-expanded="false" aria-controls="collapseLayouts_post">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Post Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts_post" aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('posts.index')}}">List</a>
                        <a class="nav-link" href="{{route('posts.create')}}">Add</a>
                        <a class="nav-link" href="{{route('posts.trash')}}">Trash list</a>
                        @if(auth()->check() && auth()->user()->isAdmin())
                            <a class="nav-link" href="{{route('posts.archive')}}">Archive list</a>
                        @endif
                    </nav>
                </div>

                {{-- Category: admin & user --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts_cat"
                   aria-expanded="false" aria-controls="collapseLayouts_cat">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts_cat" aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('categories.index')}}">List</a>
                        <a class="nav-link" href="{{route('categories.create')}}">Add</a>
                    </nav>
                </div>

                {{-- Tags: admin & user --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts_tag"
                   aria-expanded="false" aria-controls="collapseLayouts_tag">
                    <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                    Tags
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts_tag" aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('tags.index')}}">List</a>
                        <a class="nav-link" href="{{route('tags.create')}}">Add</a>
                    </nav>
                </div>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->name ?? 'Guest' }}
        </div>
    </nav>
</div>
