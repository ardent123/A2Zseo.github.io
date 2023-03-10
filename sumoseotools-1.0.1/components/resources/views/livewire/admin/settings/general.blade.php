<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
	@php

		$google_fonts = json_decode($google_fonts, true);

		$timezones = json_decode($timezones, true);

	@endphp

	<form wire:submit.prevent="onUpdateGeneral">
		<div class="row">

			<div class="col-12 mb-3">
				<div class="card">
					<div class="card-body">
						<table class="table table table-vcenter card-table table-hover settings">
							<tr>
								<td class="align-middle"><label for="site_title" class="form-label mb-0">{{ __('Site Title') }}</label></td>
								<td>
									<input id="site_title" type="text" class="form-control" wire:model="appname">
									<small class="form-hint">{{ __('The site title should represent your brand.') }} <a href="https://images.themeluxury.com/sumoseotools/site-title.png" target="_blank">{{ __('See this screenshot.') }}</a></small>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-12 mb-3">
				<div class="card">
					<div class="card-body">
						<table class="table table-hover settings">

							<tr>
								<td class="align-middle"><label for="parallax-status" class="form-label mb-0">{{ __('Enable Parallax') }}</label></td>
								<td class="w-75">
									<div class="form-switch">
										<input id="parallax-status" class="form-check-input" type="checkbox" wire:model="parallax_status">
									</div>
								</td>
							</tr>

							<tr>
								<td class="align-middle"><label for="parallax-image" class="form-label mb-0">{{ __('Parallax Image') }}</label></td>
								<td class="align-middle">
									<div class="input-group">
										<span class="input-group-btn">
											<a id="parallax-image" data-input="parallax-thumbnail" data-preview="parallax-preview" class="btn bg-gradient-primary mb-0 rounded-0 rounded-start">
												<i class="fa fa-picture-o"></i> {{ __('Choose') }}
											</a>
										</span>
										<input id="parallax-thumbnail" class="form-control ps-2" type="text" wire:model="parallax_image">
									</div>

									<div class="screenshot my-2 w-25">
										<div class="img-fluid shadow border-radius-xl overlay-preview rounded" style="
											@if ( $overlay_type == 'solid' )

											background: {{ $solid_color }};opacity: {{ $opacity }};

											@elseif( $overlay_type == 'gradient' )

											background: {{ $gradient_first_color }};
											background: -moz-linear-gradient( {{ $gradient_position }}, {{ $gradient_first_color }}, {{ $gradient_second_color }}  );
											background: -webkit-linear-gradient( {{ $gradient_position }}, {{ $gradient_first_color }}, {{ $gradient_second_color }} );
											background: linear-gradient( {{ $gradient_position }}, {{ $gradient_first_color }}, {{ $gradient_second_color }} );
											opacity: {{ $opacity }};

											@endif

										"></div>
										<img class="img-fluid shadow border-radius-xl parallax-preview" src="{{ $parallax_image }}" style="filter: blur({{ $blur }}px);">
									</div>

								</td>
							</tr>

							<tr>
								<td class="align-middle"><label for="social" class="form-label mb-0">{{ __('Overlay Type') }}</label></td>
								<td class="align-middle">
									<select class="form-control" wire:model="overlay_type">
										<option value="solid">{{ __('Solid') }}</option>
										<option value="gradient">{{ __('Gradient') }}</option>
									</select>
								</td>
							</tr>

							@if ( $overlay_type == 'solid' )

								<tr>
									<td class="align-middle"><label for="color_picker" class="form-label mb-0">{{ __('Choose Solid Color') }}</label></td>
									<td class="align-middle ps-0"><input class="form-control form-control-color" id="color_picker" wire:model="solid_color" type="color"></td>
								</tr>

							@elseif( $overlay_type == 'gradient' )

								<tr>
									<td class="align-middle"><label for="ads-area-1" class="form-label mb-0">{{ __('Choose Gradient Color') }}</label></td>
									<td class="align-middle">
										<table class="table card-table table-hover">
											<tr>
												<td class="align-middle ps-0"><input class="form-control form-control-color" id="gradient_first_color" wire:model="gradient_first_color" type="color"></td>
												<td class="align-middle"><input class="form-control form-control-color" id="gradient_second_color" wire:model="gradient_second_color" type="color"></td>
												<td class="align-middle">
													<select class="form-control" wire:model="gradient_position">
														<option value="to top" selected="selected">{{ __('To Top') }}</option>
														<option value="to right">{{ __('To Right') }}</option>
														<option value="to bottom">{{ __('To Bottom') }}</option>
														<option value="to left">{{ __('To Left') }}</option>
													</select>
												</td>
											</tr>
										</table>
									</td>
								</tr>

							@endif

							<tr>
								<td class="align-middle"><label for="opacity" class="form-label mb-0">{{ __('Opacity') }}</label></td>
								<td class="align-middle">
									<div class="w-100">
										<input id="opacity" class="form-range overlay-opacity" wire:model="opacity" type="range" min="0" max="1" step="0.1" value="0.2">
										<span class="text-muted">{{ __('Opacity') }}: <span>{{ $opacity }}</span>{{ __('px') }}</span>
									</div>
								</td>
							</tr>

							<tr>
								<td class="align-middle"><label for="blur" class="form-label mb-0">{{ __('Blur') }}</label></td>
								<td class="align-middle">
									<div class="w-100">
										<input id="blur" class="form-range background-blur" type="range" wire:model="blur" min="0.0" max="10" step="0.5" value="1.5">
										<span class="text-muted">{{ __('Blur') }}: <span>{{ $blur }}</span>{{ __('px') }}</span>
									</div>
								</td>
							</tr>

						</table>

					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<div class="card-body">

							<table class="table table-hover settings">
								<tr>
									<td scope="row"><label for="maintenance_mode" class="form-label mb-0">{{ __('Enable Maintenance Mode') }}</label></td>
									<td class="w-75">
										<div class="form-check form-switch">
											<input id="maintenance_mode" class="form-check-input" type="checkbox" wire:model="maintenance_mode">
										</div>
									</td>
								</tr>

								<tr>
									<td scope="row"><label for="theme_mode" class="form-label mb-0">{{ __('Enable Theme Mode (Light / Dark)') }}</label></td>
									<td class="w-75">
										<div class="form-check form-switch">
											<input id="theme_mode" class="form-check-input" type="checkbox" wire:model="theme_mode">
										</div>
									</td>
								</tr>

								<tr>
									<td scope="row"><label for="dir_mode" class="form-label mb-0">{{ __('Enable Dir Mode (LTR / RTL)') }}</label></td>
									<td class="w-75">
										<div class="form-check form-switch">
											<input id="dir_mode" class="form-check-input" type="checkbox" wire:model="dir_mode">
										</div>
									</td>
								</tr>

								<tr>
									<td scope="row"><label for="adblock_detection" class="form-label mb-0">{{ __('Enable Adblock Detection') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch">
											<input id="adblock_detection" class="form-check-input" type="checkbox" wire:model="adblock_detection">
										</div>
									</td>
								</tr>

								<tr>
									<td scope="row"><label for="automatic_language_detection" class="form-label mb-0">{{ __('Enable Automatic Language Detection') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch">
											<input id="automatic_language_detection" class="form-check-input" type="checkbox" wire:model="automatic_language_detection">
										</div>
									</td>
								</tr>

								<tr>
									<td scope="row"><label for="language_switcher" class="form-label mb-0">{{ __('Enable Language Switcher') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch">
											<input id="language_switcher" class="form-check-input" type="checkbox" wire:model="language_switcher">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="page-load" class="form-label mb-0">{{ __('Enable Page Load') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch">
											<input id="page-load" class="form-check-input" type="checkbox" wire:model="page_load">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="lazy-loading" class="form-label mb-0">{{ __('Enable Lazy Loading') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch">
											<input id="lazy-loading" class="form-check-input" type="checkbox" wire:model="lazy_loading">
										</div>
									</td>
								</tr>
								
								<tr>
									<td class="align-middle"><label for="back_to_top" class="form-label mb-0">{{ __('Enable Back to Top') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch">
											<input id="back_to_top" class="form-check-input" type="checkbox" wire:model="back_to_top">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="share-icons-status" class="form-label mb-0">{{ __('Enable Share Icons') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch">
											<input id="share-icons-status" class="form-check-input" type="checkbox" wire:model="share_icons_status">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="author-box-status" class="form-label mb-0">{{ __('Enable Author Box') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch">
											<input id="author-box-status" class="form-check-input" type="checkbox" wire:model="author_box_status">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="author-box-status" class="form-label mb-0">{{ __('Enable Search Box') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch">
											<input id="author-box-status" class="form-check-input" type="checkbox" wire:model="search_box_status">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="blog-page-status" class="form-label mb-0">{{ __('Enable Blog Page') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch">
											<input id="blog-page-status" class="form-check-input" type="checkbox" wire:model="blog_page_status">
										</div>
									</td>
								</tr>

								@if ( $blog_page_status == true)
									<tr>
										<td class="align-middle"><label for="blog_page_count" class="form-label mb-0">{{ __('Number of posts to show') }}</label></td>
										<td class="align-middle">
											<div class="input-group">
												<input id="blog_page_count" type="text" class="form-control" wire:model="blog_page_count">
											</div>
										</td>
									</tr>
								@endif

								<tr>
									<td class="align-middle"><label for="related-tools-status" class="form-label mb-0">{{ __('Enable Related Tools') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch">
											<input id="author-box-status" class="form-check-input" type="checkbox" wire:model="related_tools">
										</div>
									</td>
								</tr>

								@if ( $related_tools == true)
									<tr>
										<td class="align-middle"><label for="related_tools_count" class="form-label mb-0">{{ __('Number of tools to show') }}</label></td>
										<td class="align-middle">
											<div class="input-group">
												<input id="related_tools_count" type="text" class="form-control" wire:model="related_tools_count">
											</div>
										</td>
									</tr>

									<tr>
										<td class="align-middle"><label for="related_tools_count" class="form-label mb-0">{{ __('Background for Related Tools') }}</label></td>
										<td class="align-middle">
											<div class="input-group">
					                            <select name="align" class="form-control" wire:model="related_tools_background">
					                                <optgroup label="{{ __('Base colors') }}">
					                                    <option value="bg-white">{{ __('White') }}</option>
					                                    <option value="bg-default">{{ __('Default') }}</option>
					                                    <option value="bg-primary">{{ __('Primary') }}</option>
					                                    <option value="bg-secondary">{{ __('Secondary') }}</option>
					                                    <option value="bg-success">{{ __('Success') }}</option>
					                                    <option value="bg-info">{{ __('Info') }}</option>
					                                    <option value="bg-warning">{{ __('Warning') }}</option>
					                                    <option value="bg-danger">{{ __('Danger') }}</option>
					                                </optgroup>
					                                <optgroup label="{{ __('Gradient colors') }}">
					                                    <option value="bg-gradient-primary">{{ __('Primary') }}</option>
					                                    <option value="bg-gradient-secondary">{{ __('Secondary') }}</option>
					                                    <option value="bg-gradient-success">{{ __('Success') }}</option>
					                                    <option value="bg-gradient-info">{{ __('Info') }}</option>
					                                    <option value="bg-gradient-warning">{{ __('Warning') }}</option>
					                                    <option value="bg-gradient-danger">{{ __('Danger') }}</option>
					                                </optgroup>
					                            </select>
											</div>
										</td>
									</tr>
		                        @endif

								<tr>
									<td class="align-middle"><label for="file_size" class="form-label mb-0">{{ __('Maximum Upload File Size') }}</label></td>
									<td class="align-middle">
										<div class="input-group">
											<input id="file_size" type="text" class="form-control" wire:model="file_size">
											<span class="input-group-text">{{ __('MB') }}</span>
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="prefix" class="form-label mb-0">{{ __('Prefix for Download Files') }}</label></td>
									<td class="align-middle"><input id="prefix" type="text" class="form-control" wire:model="prefix"></td>
								</tr>

								<tr>
									<td class="align-middle"><label for="timezone" class="form-label mb-0">{{ __('Timezone') }}</label></td>
									<td wire:ignore>
										<select id="timezone" class="form-control" wire:model="timezone">
											@foreach ($timezones as $key => $value)
												<optgroup label="{{ $value['group'] }}">

													@foreach ($value['zones'] as $key2 => $value2)
														<option value="{{ $value2['value'] }}">{{ $value2['value'] }}</option>
													@endforeach

												</optgroup>
											@endforeach
										</select>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="font_family" class="form-label mb-0">{{ __('Font Family') }}</label></td>
									<td wire:ignore>
										<select id="font_family" class="form-control" wire:model="font_family">
											<optgroup label="{{ __('Google Fonts') }}">
												@foreach ($google_fonts as $key => $value)

													<option value="{{ $key }}">{{ $key }}</option>

												@endforeach

											</optgroup>
										</select>
									</td>
								</tr>

								<tr>
									<td colspan="2">

										<div class="d-flex mt-2 mb-3">

											<label for="social" class="form-label mb-0">{{ __('Social Media') }}</label>

											<div class="form-check form-switch mb-0">
												<input class="form-check-input ms-auto" type="checkbox" wire:model="social_status">
											</div>
										
										</div>

										@foreach ($socials as $index => $social)
										
											<div class="row">
												<div class="col-md-5">
													<div class="form-group mb-3">
														<select class="form-control" wire:model="socials.{{ $index }}.name">
															<option value="facebook">{{ __('Facebook') }}</option>
															<option value="twitter">{{ __('Twitter') }}</option>
															<option value="instagram">{{ __('Instagram') }}</option>
															<option value="youtube">{{ __('Youtube') }}</option>
															<option value="linkedin">{{ __('Linkedin') }}</option>
															<option value="skype">{{ __('Skype') }}</option>
															<option value="github">{{ __('Github') }}</option>
															<option value="behance">{{ __('Behance') }}</option>
															<option value="dribbble">{{ __('Dribble') }}</option>
															<option value="flickr">{{ __('Flickr') }}</option>
															<option value="pinterest">{{ __('Pinterest') }}</option>
															<option value="tumblr">{{ __('Tumblr') }}</option>
															<option value="vimeo">{{ __('Vimeo') }}</option>
															<option value="vk">{{ __('VK') }}</option>
															<option value="telegram">{{ __('Telegram') }}</option>
															<option value="reddit">{{ __('Reddit') }}</option>
															<option value="whatsapp">{{ __('WhatsApp') }}</option>
														</select>
														@error( 'socials.' . $index . '.name' ) <span class="error">{{ $message }}</span> @enderror
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group mb-3">
														<input type="text" class="form-control" placeholder="URL" wire:model="socials.{{ $index }}.url">
														@error( 'socials.' . $index . '.url' ) <span class="error">{{ $message }}</span> @enderror
													</div>
												</div>

												@if ( $index == 0 )

													<div class="col-md-2">
														<button class="btn text-white bg-gradient-info w-100" wire:click.prevent="addSocial( {{ $i }} )">{{ __('Add new') }}</button>
													</div>

												@else
													<div class="col-md-2">
														<button class="btn bg-gradient-danger w-100" wire:click.prevent="onDeleteSocial({{ $social['id'] }})">{{ __('Remove') }}</button>
													</div>
												@endif

											</div>
										@endforeach

										@foreach($inputs as $key => $value)
											<div class="row">
												<div class="col-md-5">
													<div class="form-group">
														<select wire:model="name.{{ $value }}" class="form-control">
															<option value selected style="display:none;">{{ __('Choose a social...') }}</option>
															<option value="facebook">{{ __('Facebook') }}</option>
															<option value="twitter">{{ __('Twitter') }}</option>
															<option value="instagram">{{ __('Instagram') }}</option>
															<option value="youtube">{{ __('Youtube') }}</option>
															<option value="linkedin">{{ __('Linkedin') }}</option>
															<option value="skype">{{ __('Skype') }}</option>
															<option value="github">{{ __('Github') }}</option>
															<option value="behance">{{ __('Behance') }}</option>
															<option value="dribbble">{{ __('Dribble') }}</option>
															<option value="flickr">{{ __('Flickr') }}</option>
															<option value="pinterest">{{ __('Pinterest') }}</option>
															<option value="tumblr">{{ __('Tumblr') }}</option>
															<option value="vimeo">{{ __('Vimeo') }}</option>
															<option value="vk">{{ __('VK') }}</option>
															<option value="telegram">{{ __('Telegram') }}</option>
															<option value="reddit">{{ __('Reddit') }}</option>
															<option value="whatsapp">{{ __('WhatsApp') }}</option>
														</select>
														@error( 'name.' . $value ) <span class="error">{{ $message }}</span> @enderror
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="URL" wire:model="url.{{ $value }}">
														@error( 'url.' . $value ) <span class="error">{{ $message }}</span> @enderror
													</div>
												</div>
												<div class="col-md-2">
													<button class="btn bg-gradient-danger w-100" wire:click.prevent="removeSocial({{ $key }})">{{ __('Remove') }}</button>
												</div>
											</div>
										@endforeach
									</td>
								</tr>
							</table>
					</div>
				</div>
			</div>

			<div class="form-group mt-4">
				<button class="btn bg-gradient-primary float-end">
					<span>
						<div wire:loading wire:target="onUpdateGeneral">
							<x-loading />
						</div>
						<span>{{ __('Save Changes') }}</span>
					</span>
				</button>
			</div>

		</div>
	</form>

<div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
(function( $ ) {
	"use strict";

    document.addEventListener('livewire:load', function () {

        const timezone = new Choices( document.querySelector('#timezone') );
        const font_family = new Choices( document.querySelector('#font_family') );

        jQuery('#timezone').on('change', function (e) {
        	var time_data = jQuery(this).find(":selected").val();
        	@this.set('timezone', time_data);
        });

        jQuery('#font_family').on('change', function (e) {
        	var font_data = jQuery(this).find(":selected").val();
        	@this.set('font_family', font_data);
        });

		jQuery('#parallax-image').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

		jQuery('input#parallax-thumbnail').change(function() { 
			window.livewire.emit('onSetParallaxImage', this.value)
		});

		jQuery('input#parallax-thumbnail').change(function() { 
			window.livewire.emit('onSetParallaxImage', this.value)
		});

		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});

    });

})( jQuery );
</script>