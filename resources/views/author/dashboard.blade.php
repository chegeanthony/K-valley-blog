<h1>Welcome, {{ $author->name ?? 'Author' }}</h1>

<h2>Update Profile</h2>
<form method="POST" action="{{ route('author.updateProfile') }}">
    @csrf
    <input type="text" name="name" value="{{ $author->name }}" required>
    <input type="email" name="email" value="{{ $author->email }}" required>
    <textarea name="bio">{{ $author->bio }}</textarea>
    <button type="submit">Update Profile</button>
</form>

<h2>Create New Blog</h2>
<form method="POST" action="{{ route('author.createBlog') }}">
    @csrf
    <input type="text" name="title" required>
    <textarea name="content" required></textarea>
    <input type="checkbox" name="is_published" value="1">
    <button type="submit">Create Blog</button>
</form>

<h2>Your Blogs</h2>
@foreach($blogs as $blog)
    <div>
        <h3>{{ $blog->title }}</h3>
        <p>{{ $blog->content }}</p>
        <form method="POST" action="{{ route('author.updateBlog', $blog->id) }}">
            @csrf
            <input type="text" name="title" value="{{ $blog->title }}" required>
            <textarea name="content" required>{{ $blog->content }}</textarea>
            <input type="checkbox" name="is_published" value="1" {{ $blog->is_published ? 'checked' : '' }}>
            <button type="submit">Update Blog</button>
        </form>
    </div>
@endforeach

<form method="POST" action="{{ route('author.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>