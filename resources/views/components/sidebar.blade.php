
<div style="background: #fff;" class="sidebar h-100 card p-3">
	<div class="card-title"><h4>Search</h4></div>
	<div class="card-block">
		<form method="post" action="{{route('query')}}">
			{{csrf_field()}}
			<input class="form-control" type="text" name="query" placeholder="Search" required>
			<input class="btn mt-2 btn-primary" type="submit" value="search">
		</form>
	</div>

	<div class="card-title mt-2"><h4>Categories</h4></div>
	<div class="card-block">
		
	</div>
</div>
