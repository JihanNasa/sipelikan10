@extends('stisla.layouts.app')

@section('title', 'Tambah Video')

@section('content')
<div class="section-header">
    <h1>Tambah Video</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('videos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                @error('title') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Link YouTube</label>
                <input type="url" name="youtube_url" value="{{ old('youtube_url') }}" 
                       class="form-control" id="youtube_url" required>
                @error('youtube_url') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div id="preview" class="mt-3"></div>

            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function getYoutubeId(url) {
    const regex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
    const match = url.match(regex);
    return match ? match[1] : null;
}

document.getElementById('youtube_url').addEventListener('input', function() {
    const id = getYoutubeId(this.value);
    const preview = document.getElementById('preview');
    preview.innerHTML = id
        ? `<iframe width="300" height="200" src="https://www.youtube.com/embed/${id}" frameborder="0" allowfullscreen></iframe>`
        : '';
});
</script>
@endpush
