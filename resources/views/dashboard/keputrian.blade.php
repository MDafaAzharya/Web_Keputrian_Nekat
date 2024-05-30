@extends('layouts.nav')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/keputrian.css') }}">
<div class="container">
<h4 class="py-3 mt-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Profile Keputrian</h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section>
        <div class="card mb-5 border-0">
            <div class="card-body p-4">
            <form id="formAuthentication" class="mb-3"
            action="{{ route('keputrian.data-keputrian-update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @foreach($keputrian as $key => $data)
                <input type="hidden" name="id" value="{{$data->id}}">
                <div class="mb-3"> <label for="email" class="form-label">{{ __('Judul') }}</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                        id="judul" name="judul" placeholder="judul" value="{{$data->judul}}" required autocomplete="judul" autofocus
                        value="{{ old('judul') }}" /> @error('judul')
                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3"> <label for="email" class="form-label">{{ __('Deskripsi') }}</label>
                <textarea id="editor" name="text" class="mb-3">{{ $data->text }}</textarea>
                <script>
                    CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
                        toolbar: {
                            items: [
                                'heading', '|',
                                'bold', 'italic', 'strikethrough', 'underline', '|',
                                'bulletedList', 'numberedList', 'todoList',
                                'outdent', 'indent', '|',
                                'undo', 'redo',
                                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                                'alignment', '|',
                                'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                            ],
                            shouldNotGroupWhenFull: true
                        },
                        list: {
                            properties: {
                                styles: true,
                                startIndex: true,
                                reversed: true
                            }
                        },
                        heading: {
                            options: [
                                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                            ]
                        },
                        placeholder: 'Welcome to CKEditor 5!',
                        fontFamily: {
                            options: [
                                'default',
                                'Arial, Helvetica, sans-serif',
                                'Courier New, Courier, monospace',
                                'Georgia, serif',
                                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                                'Tahoma, Geneva, sans-serif',
                                'Times New Roman, Times, serif',
                                'Trebuchet MS, Helvetica, sans-serif',
                                'Verdana, Geneva, sans-serif'
                            ],
                            supportAllValues: true
                        },
                        fontSize: {
                            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                            supportAllValues: true
                        },
                        link: {
                            decorators: {
                                addTargetToExternalLinks: true,
                                defaultProtocol: 'https://',
                                toggleDownloadable: {
                                    mode: 'manual',
                                    label: 'Downloadable',
                                    attributes: {
                                        download: 'file'
                                    }
                                }
                            }
                        },
                        removePlugins: [
                            'AIAssistant',
                            'CKBox',
                            'CKFinder',
                            'EasyImage',
                            'RealTimeCollaborativeComments',
                            'RealTimeCollaborativeTrackChanges',
                            'RealTimeCollaborativeRevisionHistory',
                            'PresenceList',
                            'Comments',
                            'TrackChanges',
                            'TrackChangesData',
                            'RevisionHistory',
                            'Pagination',
                            'WProofreader',
                            'MathType',
                            'SlashCommand',
                            'Template',
                            'DocumentOutline',
                            'FormatPainter',
                            'TableOfContents',
                            'PasteFromOfficeEnhanced'
                        ]
                    });
                </script>
                </div>
                <div class="mb-3"> <label for="email" class="form-label">{{ __('Pilih Foto') }}</label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                        id="gambar" name="gambar" placeholder="gambar" value="{{$data->judl}}" autocomplete="gambar" autofocus
                        value="{{ old('gambar') }}" /> @error('gambar')
                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-start mb-3">
                    <img src="{{ asset('assets/dataimage/' . $data->gambar) }}" id="gambar_edit" alt="" srcset="" width="100" height="100">
                    <p class="ms-md-2"> *Klik pilih gambar jika ingin mengganti gambar</p>
                </div>
                <div class="mt-3 col-md-2 offset-lg-10">
                    {{-- <div class="mb-3"> <div class="form-check"> <input class="form-check-input" type="checkbox" id="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /> <label class="form-check-label" for="remember-me"> Remember Me </label> </div> </div> --}} <button class="btn btn-insert d-grid w-100">{{ __('Update') }}</button>
                </div>
                @endforeach
            </form>
            </div>
        </div>
    </section>
</div>
@endsection