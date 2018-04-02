<div class="py-3">
	<div class="sidebar-brand text-center ">
		<img src="{{ asset('storage/logos/admin-logo.svg')}}" height="60" width="68" alt="logo" >
	</div>
</div>
<hr>
<nav class="sidebar-nav navbar navbar-dark">
	<ul class="nav flex-column w-100">
	  <li class="nav-item active ">
	    <a class="nav-link" href="#">
	    	<i class="fa fa-home"></i>
	    	<span class="hidden-sm-down">Dashboard</span>
	    </a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="#"><i class="fa fa-line-chart mr-1"></i>
	    	<span class="hidden-sm-down">Analytics</span></a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="#"><i class="fa fa-server mr-1"></i>
	    	<span class="hidden-sm-down">Server</span></a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="{{route('post.index')}}">
	    	<i class="fa fa-paper-plane mr-1"></i>
	    	<span class="hidden-sm-down">Videos</span>
	    </a>
	    	
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="{{route('article.index')}}">
	    	<i class="fa fa-paper-plane mr-1"></i>
	    	<span class="hidden-sm-down">Articles</span>
	    </a>
	    	
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="{{route('category.index')}}">
	    	<i class="fa fa-paper-plane mr-1"></i>
	    	<span class="hidden-sm-down">Categories</span>
	    </a>
	    	
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="{{route('tag.index')}}">
	    	<i class="fa fa-paper-plane mr-1"></i>
	    	<span class="hidden-sm-down">Tags</span>
	    </a>
	    	
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="{{route('role.index')}}">
	    	<i class="fa fa-paper-plane mr-1"></i>
	    	<span class="hidden-sm-down">Roles</span>
	    </a>
	    	
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="{{route('permission.index')}}">
	    	<i class="fa fa-paper-plane mr-1"></i>
	    	<span class="hidden-sm-down">Permissions</span>
	    </a>
	    	
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="#"><i class="fa fa-envelope mr-1"></i>
	    	<span class="hidden-sm-down">Mail</span></a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link " href="#"><i class="fa fa-bell mr-1"></i>
	    	<span class="hidden-sm-down">Notifications</span></a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link " href="{{ route('user.index')}}"><i class="fa fa-users mr-1"></i>
	    	<span class="hidden-sm-down">Users</span></a>
	  </li>
	</ul>
</nav>