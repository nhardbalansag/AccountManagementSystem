<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item
                        {{
                            (Request::route()->getName() === "social-media-category" ? 'menu-open' :
                            (Request::route()->getName() === "service-category-list" ? 'menu-open' : ''))
                        }}
                        "
                    >
                    <a href="#" class="nav-link
                        {{
                            (Request::route()->getName() === "social-media-category" ? 'active' :
                            (Request::route()->getName() === "service-category-list" ? 'active' : ''))
                        }}
                        "
                    >
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Platforms
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('social-media-category') }}" class="nav-link
                                {{
                                    (Request::route()->getName() === "social-media-category" ? 'active' :
                                    (Request::route()->getName() === "service-category-list" ? 'active' :
                                    (Request::route()->getName() === "add-email" ? 'active' : '')))
                                }}
                                "
                            >
                                <i class="far fa-circle nav-icon"></i>
                                <p>Social Media Category</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item
                        {{
                            (Request::route()->getName() === "network-list" ? 'menu-open' :
                            (Request::route()->getName() === "simcard-list" ? 'menu-open' :
                            (Request::route()->getName() === "add-email" ? 'menu-open' :
                            (Request::route()->getName() === "trash-sim" ? 'menu-open' : ''))))
                        }}
                        "
                    >
                    <a href="#" class="nav-link
                        {{
                            (Request::route()->getName() === "network-list" ? 'active' :
                            (Request::route()->getName() === "simcard-list" ? 'active' :
                            (Request::route()->getName() === "add-email" ? 'active' :
                            (Request::route()->getName() === "trash-sim" ? 'active' : ''))))
                        }}
                        "
                    >
                        <i class="nav-icon fas fa-sim-card"></i>
                        <p>
                            Sim Manage
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('network-list') }}" class="nav-link
                                {{
                                    (Request::route()->getName() === "network-list" ? 'active' :
                                    (Request::route()->getName() === "simcard-list" ? 'active' :
                                    (Request::route()->getName() === "add-email" ? 'active' : '')))
                                }}
                                "
                            >
                                <i class="far fa-circle nav-icon"></i>
                                <p>Networks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('trash-sim') }}" class="nav-link
                                {{
                                    (Request::route()->getName() === "trash-sim" ? 'active' : '')
                                }}
                                "
                            >
                                <i class="far fa-circle nav-icon"></i>
                                <p>Trash</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item
                        {{
                            (Request::route()->getName() === "email-list" ? 'menu-open' : '')
                        }}
                        "
                    >
                    <a href="#" class="nav-link
                        {{
                            (Request::route()->getName() === "email-list" ? 'active' : '')
                        }}
                        "
                    >
                        <i class="nav-icon fab fa-google-plus-g"></i>
                        <p>
                            Accounts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('email-list') }}" class="nav-link
                                {{
                                    (Request::route()->getName() === "email-list" ? 'active' : '')
                                }}
                                "
                            >
                                <i class="far fa-circle nav-icon"></i>
                                <p>Google Accounts</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
