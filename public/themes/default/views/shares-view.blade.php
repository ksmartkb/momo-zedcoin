<!-- main-section -->	
<div class="container">
	<div class="row">              
		<div class="col-md-8 col-lg-8">

			{!! Theme::partial('shares-view',compact( 'shares','username','group_id','timeline_name')) !!}					

		</div><!-- /col-md-6 -->

		<div class="col-md-4 col-lg-4">
			{!! Theme::partial('home-rightbar',compact('suggested_users', 'suggested_groups', 'suggested_pages')) !!}
		</div>
	</div>
</div>	
<!-- /main-section -->