<x-layout>
        <form method="POST" action="/admin/articles" enctype="multipart/form-data">
                @csrf

                <x-form.input name="title" required />
                <x-form.input name="slug" required />
                <!-- <x-form.input name="body" required /> -->
                <div class='bg-gray-100' id="editorjs" name="body"></div> -->
                <x-form.button>Publish</x-form.button>
        </form>
</x-layout>
<script>
        // const SimpleImage = window.SimpleImage;
        const editor = new window.EditorJS({
                /**
                 * Id of Element that should contain Editor instance
                 */
                holder: 'editorjs',
                tools: {
                        image: window.SimpleImage,
                        GifTool: GifTool
                }
        });
        setTimeout(()=>{
                editor.save().then((outputData) => {
                console.log('Article data: ', outputData)
                }).catch((error) => {
                console.log('Saving failed: ', error)
                });
        }, 1000 * 20)
      
</script>