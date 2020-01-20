
						<div class="timeline-posts">
   
							@if($shares->count() > 0)
								@foreach($shares as $share)
								{!! Theme::partial('share',compact('share','timeline','next_page_url_shares')) !!}
								@endforeach
							@else
								<div class="panel panel-default">
									<div class="panel-heading no-bg panel-settings">
										<h3 class="panel-title">
											{{ trans('common.share') }}
										</h3>
									</div>
									<div class="panel-body">
										<div class="alert alert-warning">{{ trans('messages.no_shares') }}</div>
									</div>
								</div><!-- /panel -->
							@endif

						</div>