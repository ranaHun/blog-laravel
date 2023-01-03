<head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<x-layout>
        <!-- <form method="POST" action="" enctype="multipart/form-data"> -->
        @csrf

        <x-form.input name="title" required />
        <x-form.input name="slug" required />
        <!-- <x-form.input name="body" required /> -->
        <div class='bg-gray-100' id="editorjs"></div>
        <!-- <x-form.button>Publish</x-form.button> -->
        <x-form.field>
                <button onClick="display()" class="bg-gray-400 text-gray-800  uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-500">
                        Publish
                </button>
        </x-form.field>
        <!-- </form> -->
</x-layout>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
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
        // setTimeout(() => {
        //         editor.save().then((outputData) => {
        //                 console.log('Article data: ', outputData)
        //         }).catch((error) => {
        //                 console.log('Saving failed: ', error)
        //         });
        // }, 1000 * 20)


        function display() {
                var url = '/admin/articles';

                editor.save().then((outputData) => {
                        console.log('Article data: ', outputData)
                        // $.ajaxSetup({
                        //         headers: {
                        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //         }
                        // });
                        alert($('meta[name="csrf-token"]').attr('content'))
                        $.ajax({
                                url: url,
                                type: 'POST',
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                              
                                dataType: 'json',
                                data: {
                                        _token: $('meta[name="csrf-token"]').attr('content'),
                                        title: "",
                                        slug:"",
                                        body: JSON.stringify(outputData),
                                },
                        }).done(function(response) {
                                console.log('received this response: ' + response);
                        });
                }).catch((error) => {
                        console.log('Saving failed: ', error)
                });

                alert('ssssssssssss')
        }
</script>