@extends('stisla.layouts.app')

@section('title', 'Daftar Video')

@section('content')
<div class="section-header">
    <h1>Daftar Video</h1>
</div>

<div class="card">
    <div class="card-header">
        <a href="{{ route('videos.create') }}" class="btn btn-primary">Tambah Video</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Preview</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($videos as $video)
                <tr>
                    <td>{{ $video->title }}</td>
                    <td>
                        @if($video->youtube_id)
                            <iframe width="250" height="150"
                                src="https://www.youtube.com/embed/{{ \App\Helpers\Helper::getYoutubeId($video->youtube_url) }}"
                                frameborder="0" allowfullscreen>
                            </iframe>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('videos.edit', $video) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('videos.destroy', $video) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada video.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
