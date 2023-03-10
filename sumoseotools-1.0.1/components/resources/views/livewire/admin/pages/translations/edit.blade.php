<div>

    <div class="card">
        <div class="card-body">

          <div class="alert alert-info bg-gradient-info text-white" role="alert">
              <strong>{{ __('You are editing the :langNative version', ['langNative' => localization()->getSupportedLocales()[app()->getLocale()]->native()]) }} (<a href="{{ ( $page_type == 'home' ) ? localization()->getLocalizedURL(app()->getLocale(), route('home') . '/', [], true) : localization()->getLocalizedURL(app()->getLocale(), route('home') . (($page_type == 'post') ? '/blog/' : '/') . $slug, [], true) }}" class="text-light">{{ __('View page') }}</a>).</strong>
          </div>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="onEditPageTranslation">

                <div class="form-group mb-3">
                    <label for="page-title" class="form-label">{{ __('Page Title') }}</label>
                    <input class="form-control @error('page_title.' . app()->getLocale()) is-invalid @enderror" type="text" wire:model="page_title.{{ app()->getLocale() }}" id="page-title" required>
                    <small class="form-hint">{{ __('This is what will appear in the first line when this post shows up in the search results. It should be less than or equal to') }} <code>{{ __('60 characters') }}</code>.</small>
                </div>

                <div class="form-group mb-3">
                    <label for="content-title" class="form-label">{{ __('Title') }}</label>
                    <input class="form-control @error('title.' . app()->getLocale()) is-invalid @enderror" type="text" wire:model="title.{{ app()->getLocale() }}" id="content-title" required>
                </div>

                <div class="form-group mb-3">
                    <label for="subtitle" class="form-label">{{ __('Subtitle') }}</label>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" wire:model="subtitle.{{ app()->getLocale() }}" id="subtitle">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="short-description" class="form-label">{{ __('Short description') }}</label>
                    <input class="form-control" type="text" wire:model="short_description.{{ app()->getLocale() }}" id="short-description">
                    <small class="form-hint">{{ __('This description will show up on search engines.') }}</small>
                </div>

                <div class="form-group mb-3" wire:ignore>
                    <label for="description" class="form-label">{{ __('Description') }}</label>
                    <textarea class="description" id="description" rows="15" wire:model="description.{{ app()->getLocale() }}"></textarea>
                </div>

                <div class="form-group">
                    <button class="btn bg-gradient-primary float-end">
                        <span>
                            <div wire:loading wire:target="onEditPageTranslation">
                                <x-loading />
                            </div>
                            <span>{{ __('Save Changes') }}</span>
                        </span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
(function( $ ) {
    "use strict";

    document.addEventListener('livewire:load', function () {

        tinymce.init({
            selector: '.description',
			relative_urls: false,
			remove_script_host: false,
            setup: function (editor) {
                editor.on('init change', function () {
				editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('description.{{ app()->getLocale() }}', editor.getContent());
                });
            },
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help'
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | lignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media code",
            file_picker_callback: function (callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                let type = 'image' === meta.filetype ? 'Images' : 'Files',
                    url  = '{{ url('/') }}/filemanager?editor=tinymce5&type=' + type;

                tinymce.activeEditor.windowManager.openUrl({
                    url : url,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
                //
            }
        });
		
		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});
	
    });

})( jQuery );
</script>