@props(['id', 'btn'])

<script>
    ClassicEditor
        .create( document.querySelector('#{{ $id }}'), {
            extraPlugins: [MyCustomUploadAdapterPlugin],
            mediaEmbed: {
                previewsInData: true,
                providers: [
                    {
                        name: 'youtube',
                        url: [
                            /^https?:\/\/(?:www\.)?youtube\.com\/watch\?v=([^&]+)/,
                            /^https?:\/\/youtu\.be\/([^?]+)/,
                            /^https?:\/\/(?:www\.)?youtube\.com\/embed\/([^?]+)/,
                        ],
                        html: match => {
                            const id = match[ 1 ];
                            return (
                                '<div style="position: relative; padding-bottom: 56.25%; height: 0; ">' +
                                `<iframe src="https://www.youtube.com/embed/${ id }" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" frameborder="0" allowfullscreen allow="autoplay"></iframe>` +
                                '</div>'
                            );
                        }
                    }
                ]
            }
        })
        .then(editor => {
            const buttons = document.querySelectorAll('{{ $btn }}');
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    @this.set('{{ $id }}', editor.getData());
                });
            });
            editor.model.document.on('change:data', () => {
                const currentImages = getCurrentImages(editor.getData());
                const deletedImages = getDeletedImages(imageList, currentImages);
                if (deletedImages.length > 0) {
                    deleteImagesOnServer(deletedImages);
                }
                imageList = currentImages;
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>

<style>
    .ck-editor .ck-content{
        min-height: 250px;
        font-size: 14px;
        line-height: 1.5;
        color: var(--ck-color-base-text);
    }

    .dark {
        --ck-color-base-foreground: #f9fafb;
        --ck-color-base-background: #374152;
        --ck-color-base-border: #1f2937;
        --ck-color-base-shadow: #374152;
        --ck-color-base-focus: #2563eb;
        --ck-color-base-text: #f9fafb;
        --ck-color-base-text-subtle: #9ca3af;
        --ck-color-base-text-light: #f9fafb;
        --ck-color-base-text-lighter: #f9fafb;
        --ck-color-base-text-lightest: #f9fafb;
        --ck-color-base-text-dark: #9ca3af;
        --ck-color-base-text-darker: #9ca3af;
        --ck-color-base-text-darkest: #9ca3af;
        --ck-color-base-background-subtle: #1f2937;
        --ck-color-base-background-light: #f9fafb;
        --ck-color-base-background-lighter: #f9fafb;
        --ck-color-base-background-lightest: #f9fafb;
        --ck-color-base-background-dark: #374152;
        --ck-color-base-background-darker: #374152;
        --ck-color-base-background-darkest: #374152;
        --ck-color-base-border-subtle: #1f2937;
        --ck-color-base-border-light: #f9fafb;
        --ck-color-base-border-lighter: #f9fafb;
        --ck-color-base-border-lightest: #f9fafb;
        --ck-color-base-border-dark: #374152;
        --ck-color-base-border-darker: #374152;
        --ck-color-base-border-darkest: #374152;
        --ck-color-base-shadow-subtle: #1f2937;
        --ck-color-base-shadow-light: #f9fafb;
        --ck-color-base-shadow-lighter: #f9fafb;
        --ck-color-base-shadow-lightest: #f9fafb;
        --ck-color-base-shadow-dark: #374152;
        --ck-color-base-shadow-darker: #374152;
        --ck-color-base-shadow-darkest: #374152;
        --ck-color-base-focus-subtle: #2563eb;
        --ck-color-button-default-hover-background: #1f2937;
        --ck-color-button-on-hover-background: #1f2937;
        --ck-color-button-on-background: #1f2937;
        --ck-color-split-button-hover-background: #1f2937;
        --ck-color-button-on-color: #f9fafb;
    }
</style>
