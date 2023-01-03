<x-layout>
        <x-form.input name="title" required />
        <x-form.input name="slug" required />
        <x-form.editor name="body"></x-form.editor>
        <x-form.button form_id="create-article">Publish</x-form.button>
</x-layout>
<script>
        const editor = new window.EditorJS({
                /**
                 * Id of Element that should contain Editor instance
                 */
                holder: 'editorjs',
                tools: {
                        GifTool: {
                                class: GifTool,
                                config: {
                                        endpoint: 'http://localhost:3000'
                                }
                        }
                }
        });


        $('.savebtn').click(function(e) {
                e.preventDefault();
                editor.save().then((outputData) => {
                        const title = document.getElementById('title').value;
                        const slug = document.getElementById('slug').value;
                        saveData(title, slug, outputData)

                }).catch((error) => {
                        console.log('Saving failed: ', error)
                });
        });

        function saveData(title, slug, data) {
                var url = '/admin/articles';
                $.ajaxSetup({
                        headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                });
                $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                                title: title,
                                slug: slug,
                                body: JSON.stringify(data),
                        },
                        success: function(data) {
                                window.location.href = url;
                        },
                        error: function(data) {

                                var errors = data.responseJSON;

                                alert(errors.message);
                        }
                }).done(function(response) {
                        // window.location.href = url;
                });
        }
</script>