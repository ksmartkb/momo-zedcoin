<form action="{{ url('ajax/create-share') }}" method="post">
  {{ csrf_field() }}

    <div class="panel panel-default panel-create"> <!-- panel-create -->
        <div class="panel-heading">
            <div class="heading-text">
                {{ trans('messages.buyshares') }}
            </div>
        </div>
        <div class="panel-body">        
            <textarea name="description" class="form-control createpost-form comment" cols="30" rows="3" id="createPost" cols="30" rows="2" placeholder="{{ trans('messages.shares-placeholder') }}"></textarea>
               

                <div class="user-tags-added" style="display:none">
                    &nbsp; -- {{ trans('common.with') }}
                    <div class="user-tag-names">
                        
                    </div>
                </div>
                <div class="user-tags-addon post-addon" style="display: none">
                    <span class="post-addon-icon"><i class="fa fa-user-plus"></i></span>
                    <div class="form-group">
                        <input type="text" id="userTags" class="form-control user-tags youtube-text" placeholder="{{ trans('messages.who_are_you_with') }}" autocomplete="off" value="" >
                        <div class="clearfix"></div>
                    </div>
                </div>
                
              <div class="images-selected post-images-selected" style="display:none">
                  <span>3</span> {{ trans('common.photo_s_selected') }}
              </div>
              <div class="images-selected post-video-selected" style="display:none">
                  <span>3</span>
              </div>
              <!-- Hidden elements  -->
              <input type="hidden" name="timeline_id" value="{{ $timeline->id }}">
             
              <input type="hidden" name="group_id" value="{{ $timeline->groups->id }}"> 
              <input type="file"   class="post-images-upload hidden" multiple="multiple"  accept="image/jpeg,image/png,image/gif" name="post_images_upload[]" id="post_images_upload[]">
              <input type="file" class="post-video-upload hidden"  accept="video/mp4" name="post_video_upload" >
              <div id="post-image-holder"></div>
        </div><!-- panel-body -->

        <div class="panel-footer">
            <ul class="list-inline left-list">
                <li><a href="#" id="addUserTags"><i class="fa fa-user-plus"></i></a></li>
                <li><a href="#" id="imageUpload"><i class="fa fa-camera-retro"></i></a></li>
               
            </ul>
            <ul class="list-inline right-list">
               <li><a href="{!! url($username.'/groupshareview/'.$timeline->groups->id) !!}" class="btn btn-default">{{ trans('common.view_shares') }}</a></li>
             
                <li><button type="submit" class="btn btn-submit btn-success">{{ trans('common.buyShares') }}</button></li>
            </ul>

            <div class="clearfix"></div>
        </div>
    </div>
</form>


@if(Setting::get('postcontent_ad') != NULL)
    <div id="link_other" class="page-image">
        {!! htmlspecialchars_decode(Setting::get('postcontent_ad')) !!}
    </div>
@endif

{{-- 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_vuWi_hzMDDeenNYwaNAj0PHzzS2GAx8&libraries=places&callback=initMap"
        async defer></script> --}}

<script>
function initMap(event) 
{    
    var key;  
    var map = new google.maps.Map(document.getElementById('pac-input'), {
    });

    var input = /** @type {!HTMLInputElement} */(
        document.getElementById('pac-input'));        

    if(window.event)
    {
        key = window.event.keyCode; 

    }
    else 
    {
        if(event)
            key = event.which;      
    }       

    if(key == 13){       
    //do nothing 
    return false;       
    //otherwise 
    } else { 
        var autocomplete = new google.maps.places.Autocomplete(input);  
        autocomplete.bindTo('bounds', map);

    //continue as normal (allow the key press for keys other than "enter") 
    return true; 
    } 
}
</script>
<script>
 $('.create-share-form').ajaxForm({
        url: SP_source() + 'ajax/create-share',
        beforeSubmit : function validate(formData, jqForm, options) {
          var form = jqForm[0];   
                
           //Uploading selected images on create post box 
            var hasFile = false
            for(var i=0; i<=validFiles.length; i++){
              if(validFiles[i] != null)
              {
                hasFile = true
                var file = new File([validFiles[i]], validFiles[i].name  ,{type: validFiles[i].type});             
                formData.push({name:'post_images_upload_modified[]', value: file})
              }
            }
            validFiles = []; // making array empty           

           if (!hasFile && !$('.post-video-upload').val() && !form.description.value && !form.youtube_video_id.value && !form.location.value && !form.soundcloud_id.value) {
             alert("Your post cannot be empty!")

               return false;
           }
         
        },
        beforeSend: function() {
            create_post_form = $('.create-post-form');
            create_post_button = create_post_form.find('.btn-submit');
            create_post_button.attr('disabled', true).append(' <i class="fa fa-spinner fa-pulse "></i>');
            create_post_form.find('.post-message').fadeOut('fast');
        },

        success: function(responseText) {
          create_post_button.attr('disabled', false).find('.fa-spinner').addClass('hidden');
            if (responseText.status == 200)
            {
              $('.timeline-posts').prepend(responseText.data.original);
              jQuery("time.timeago").timeago();
              $('.no-posts').hide();
              // Resetting the create post form after successfull message
              $('.video-addon').hide();
              $('.music-addon').hide();
              $('.emoticons-wrapper').hide();
              $('.user-tags-addon').hide();
              $('.user-tags-added').hide();
              $(".user-results").hide();
              create_post_form.find("input[type=text], textarea, input[type=file]").val("");
              create_post_form.find('.youtube-iframe').empty();
              create_post_form.find('#post-image-holder').empty();
              create_post_form.find('.post-images-selected').hide();
              create_post_form.find('#post-video-holder').empty();
              create_post_form.find('.post-videos-selected').hide();
              $('[name="youtube_video_id"]').val('');
              $('[name="youtube_title"]').val('');
              $('[name="soundcloud_id"]').val('');
              $('[name="soundcloud_title"]').val('');
              $('[name="user_tags[]"]').val('');
              $('.user-tags').val('');
              $('.user-tag-names').empty('');
              emojify.run();
              hashtagify();
              mentionify();              
              $('.post-description').linkify()
              $('[data-toggle="tooltip"]').tooltip();
              $('[name="description"]').focus();              
              notify('Your post has been successfully published');
            }
            else
            {
                $('.login-errors').html(responseText.message);

            }

        }
    });

</script>



