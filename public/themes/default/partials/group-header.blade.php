<div class="timeline-cover-section">
	<div class="timeline-cover">			
		<img src=" @if($timeline->cover_id) {{ url('group/cover/'.$timeline->cover->source) }} @else {{ url('group/cover/default-cover-group.png') }} @endif" alt="{{ $timeline->name }}" title="{{ $timeline->name }}">
		@if($timeline->groups->is_admin(Auth::user()->id) == true)
		<a href="#" class="btn btn-camera-cover change-cover"><i class="fa fa-camera" aria-hidden="true"></i><span class="change-cover-text">{{ trans('common.change_cover') }}</span></a>
		@endif
		<div class="user-cover-progress hidden">
		</div>
		<div class="user-timeline-name">
			<a href="{{ url($timeline->username) }}">{{ $timeline->name }}</a>
			{!! verifiedBadge($timeline) !!}
		</div>
		
	</div>

	<div class="timeline-list">
		<ul class="list-inline pagelike-links">			
			@if(Auth::user()->get_group($group->id) != NULL)
			@if(($group->member_privacy == "only_admins" && $group->is_admin(Auth::user()->id)) || 
			($group->member_privacy == "members" && Auth::user()->get_group($group->id) == 'approved'))			
			<li class="{{ Request::segment(2) == 'add-members' ? 'active' : '' }}"><a href="{{ url($timeline->username.'/add-members')}}">
				<span class="top-list">{{ trans('common.addmembers') }}</span></a></li>	
				@endif
				@endif

				<li class="{{ Request::segment(2) == 'members' ? 'active' : '' }}">
					<a href="{{ url($timeline->username.'/members/'.$group->id)}}">
						<span class="top-list">
							{{ $group->members() != false ? count($group->members()) : 0 }} {{ trans('common.members') }}
						</span>
					</a>
				</li>
				
				<li class="{{ Request::segment(2) == 'groupadmin' ? 'active' : '' }}">
					<a href="{{ url($timeline->username.'/groupadmin/'.$group->id) }}">
						<span class="top-list">{{ $group->admins() != false ? count($group->admins()) : 0 }}  {{ trans('common.admins') }}
						</span>
					</a>
				</li>
				<li class="{{ Request::segment(2) == 'groupshares' ? 'active' : '' }}">
					<a href="{{ url($timeline->username.'/groupshares/'.$group->id) }}" >
						<span class="top-list">
							{{ count($timeline->shares()->where('approve', 1)->get()) }} {{ trans('common.shares') }}
						</span>
					</a>
				</li>
				<li class="{{ Request::segment(2) == 'groupsocialfund' ? 'active' : '' }}">
					<a href="{{ url($timeline->username.'/groupsocialfund/'.$group->id) }}" >
						<span class="top-list">
							{{ count($timeline->shares()->where('approve', 1)->get()) }} {{ trans('common.socialfunds') }}
						</span>
					</a>
				</li>
				<li class="{{ Request::segment(2) == 'grouploans' ? 'active' : '' }}">
					<a href="{{ url($timeline->username.'/grouploans/'.$group->id) }}" >
						<span class="top-list">
							{{ count($timeline->shares()->where('approve', 1)->get()) }} {{ trans('common.loans') }}
						</span>
					</a>
				</li>
				<li class="{{ Request::segment(2) == 'groupposts' ? 'active' : '' }}">
					<a href="{{ url($timeline->username.'/groupposts/'.$group->id) }}" >
						<span class="top-list">
							{{ count($timeline->posts()->where('active', 1)->get()) }} {{ trans('common.posts') }}
						</span>
					</a>
				</li>

				@if($group->type == "closed" && $group->is_admin(Auth::user()->id))
				<li class="{{ Request::segment(3) == 'join-requests' ? 'active' : '' }}">

					<a href="{{ url($timeline->username.'/group-settings/join-requests/'.$group->id) }}" >
						<span class="top-list">
							{{ $group->pending_members() != false ? count($group->pending_members()) : 0 }} {{ trans('common.join_requests') }}
						</span>					
					</a>
				</li>
				@endif	
				@if(!$group->is_admin(Auth::user()->id))
				<li class="dropdown largescreen-report"><a href="#" class=" dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="top-list"> <i class="fa fa-ellipsis-h"></i></span></a>
					<ul class="dropdown-menu  report-dropdown">

						<li class="">
							<a href="#" class="save-timeline" data-timeline-id="{{ $timeline->id }}">
								<span class="top-list"><i class="fa fa-save"></i>
									@if($timeline->usersSaved()->where('user_id',Auth::user()->id)->get()->isEmpty())
									{{ trans('common.save') }}
									@else
									{{ trans('common.unsave') }}
									@endif
								</span>
							</a>
						</li>

						@if(!$timeline->reports->contains(Auth::user()->id))
						<li class=""><a href="#" class="page-report report text-danger" data-timeline-id="{{ $timeline->id }}"> <i class="fa fa-flag" aria-hidden="true"></i> {{ trans('common.report') }}</a></li>
						
						<li class="hidden "><a href="#" class="page-report reported text-danger" data-timeline-id="{{ $timeline->id }}"> <i class="fa fa-flag" aria-hidden="true"></i> {{ trans('common.reported') }}</a></li>
						@else
						<li class="hidden "><a href="#" class="page-report report text-danger" data-timeline-id="{{ $timeline->id }}"> <i class="fa fa-flag" aria-hidden="true"></i> {{ trans('common.report') }}</a></li>
						
						<li class=""><a href="#" class="page-report reported text-danger" data-timeline-id="{{ $timeline->id }}"> <i class="fa fa-flag" aria-hidden="true"></i> {{ trans('common.reported') }}</a></li>
						@endif

						@if(!$timeline->reports->contains(Auth::user()->id))
						<li class="smallscreen-report"><a href="#" class="page-report report" data-timeline-id="{{ $timeline->id }}">{{ trans('common.report') }}</a></li>

						<li class="hidden smallscreen-report"><a href="#" class="page-report reported" data-timeline-id="{{ $timeline->id }}">{{ trans('common.reported') }}</a></li>
						@else
						<li class="hidden smallscreen-report"><a href="#" class="page-report report" 
							data-timeline-id="{{ $timeline->id }}">{{ trans('common.report') }}</a></li>

							<li class="smallscreen-report"><a href="#" class="page-report reported" data-timeline-id="{{ $timeline->id }}">{{ trans('common.reported') }}</a></li>
						@endif
								
						</ul>
					</li>
					@endif		
				</ul>
				<div class="status-button">
					<a href="#" class="btn btn-status">{{ trans('common.status') }}</a>
				</div>
				<div class="timeline-user-avtar">			
					<img src=" @if($timeline->avatar_id) {{ url('group/avatar/'.$timeline->avatar->source) }} @else {{ url('group/avatar/default-group-avatar.png') }} @endif" alt="{{ $timeline->name }}" title="{{ $timeline->name }}">
					@if($timeline->groups->is_admin(Auth::user()->id) == true)
					<div class="chang-user-avatar">
						<a href="#" class="btn btn-camera change-avatar"><i class="fa fa-camera" aria-hidden="true"></i><span class="avatar-text">{{ trans('common.update_profile') }}<span>{{ trans('common.picture') }}</span></span></a>
					</div>
					@endif		
					<div class="user-avatar-progress hidden">
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			@if($timeline->background_id != NULL)
			$('body')
			.css('background-image', "url({{ url('/wallpaper/'.$timeline->wallpaper->source) }})")
			.css('background-attachment', 'fixed');

			@endif
		</script>