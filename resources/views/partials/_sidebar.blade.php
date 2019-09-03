<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ strtolower(auth()->user()->name) }}</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item {{ request()->is('item') ? 'active' : '' }}" href="{{ route('item.index') }}"><i class="app-menu__icon fa fa-bandcamp"></i><span class="app-menu__label"> Items</span></a></li>
        <li><a class="app-menu__item {{ request()->is('customer') ? 'active' : '' }}" href="{{ route('customer.index') }}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"> Customers</span></a></li>

        <li class="treeview {{ request()->segment(1) == 'sale' ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">Sale</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item {{ request()->is('sale/create') ? 'active' : '' }}" href="{{ route('sale.create') }}"><i class="icon fa fa-circle-o"></i> New Sale</a></li>
                <li><a class="treeview-item {{ request()->is('sale') ? 'active' : '' }}" href="{{ route('sale.index') }}"><i class="icon fa fa-circle-o"></i> Sale List</a></li>
            </ul>
        </li>
    </ul>
</aside>