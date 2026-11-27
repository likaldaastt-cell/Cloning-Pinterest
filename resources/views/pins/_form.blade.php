<form method='POST' action='{{ $action }}'>
    @csrf
    @if ($pin) @method('PUT') @endif
    <label>Board</label>
    <select name='board_id' required>
        @foreach ($boards as $b)
            <option value='{{ $b->id }}' @selected(old('board_id', $pin->board_id ?? $selectedBoard ?? null) == $b->id)>{{ $b->name }}</option>
        @endforeach
    </select>
    <label>Judul</label>
    <input type='text' name='title' value='{{ old('title', $pin->title ?? '') }}' required>
    <label>Deskripsi</label>
    <textarea name='description' rows='3'>{{ old('description', $pin->description ?? '') }}</textarea>
    <label>URL gambar</label>
    <input type='url' name='image_url' placeholder='https://...' value='{{ old('image_url', $pin->image_url ?? '') }}' required>
    <label>Kategori</label>
    <select name='category'>
        <option value=''>Tanpa kategori</option>
        @foreach ($categories as $c)
            <option value='{{ $c }}' @selected(old('category', $pin->category ?? null) === $c)>{{ $c }}</option>
        @endforeach
    </select>
    <p><button type='submit'>Simpan</button></p>
</form>