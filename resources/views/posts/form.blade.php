@if($errors->any())
    <div class="error">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" method="POST">
    @csrf
    @if(isset($post))
        @method('PUT')
    @endif

    <p>
        <label>Заголовок:</label><br>
        <input type="text" name="title" size="50" value="{{ old('title', $post->title ?? '') }}">
    </p>

    <p>
        <label>Категория:</label><br>
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </p>

    <p>
        <label>Теги:</label><br>
        @foreach($tags as $tag)
            <label>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tags', isset($post) ? $post->tags->pluck('id')->all() : [])))>
                {{ $tag->name }}
            </label>
        @endforeach
    </p>

    <p>
        <label>Текст:</label><br>
        <textarea name="body" rows="6" cols="60">{{ old('body', $post->body ?? '') }}</textarea>
    </p>

    <p>
        <label>
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $post->is_published ?? false))>
            Опубликован
        </label>
    </p>

    <p><button type="submit">Сохранить</button></p>
</form>
