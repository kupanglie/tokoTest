<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
				<div class="dropdown profile-element">
					<span>
						<img alt="image" class="img-circle" src="img/profile_small.jpg">
					</span>
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<span class="clear">
							<span class="block m-t-xs"> <strong class="font-bold">David Williams</strong></span>
							<span class="text-muted text-xs block">Art Director</span>
						</span>
					</a>
				</div>
				<div class="logo-element">
					IN+
				</div>
			</li>
			<li class="active">
				<a href="/"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
			</li>
			<li>
				<a href="{{ route('projects.index') }}"><i class="fa fa-diamond"></i> <span class="nav-label">Project</span></a>
			</li>
			<li>
				<a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Stock Management</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="{{ route('list-items.index') }}">List Items</a></li>
					<li><a href="{{ route('items-in.index') }}">Items In</a></li>
					<li><a href="{{ route('items-out.index') }}">Items Out</a></li>
					<li><a href="{{ route('list-preorders.index') }}">List Preorders</a></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Report</span></a>
			</li>
			<li>
				<a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Setting</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="{{ route('item-management.index') }}">Item Management</a></li>
					<li><a href="{{ route('sales-management.index') }}">Sales Management</a></li>
					<li><a href="{{ route('worker-management.index') }}">Worker Management</a></li>
					<li><a href="{{ route('suppliers-management.index') }}">Supplier Management</a></li>
					<li><a href="{{ route('expeditions-management.index') }}">Expedition Management</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>
