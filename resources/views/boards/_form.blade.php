<form method='POST' action='{{ $action }}'>
    @csrf
    @if ($board) @method('PUT') @endif
    <label>Nama board</label>
    <input type='text' name='name' value='{{ old('name', $board->name ?? '') }}' required>
    <label>Deskripsi</label>
    <textarea name='description' rows='3'>{{ old('description', $board->description ?? '') }}</textarea>
    <p>
        <button type='submit'>Simpan</button>
        <a class='btn btn-light' href='{{ route('boards.index') }}'>Batal</a>
    </p>
</form>