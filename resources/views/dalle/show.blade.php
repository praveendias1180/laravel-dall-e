<h1>Hello Dall-E</h1>

<form>
    <input type="text" name="prompt" value="{{ $prompt }}" style="width:800" /><br /><br />
    <input type="text" name="n" value="{{ $n }}" /><br /><br />
    <input type="text" name="size" value="{{ $size }}" /><br /><br />
    <button type="submit">Generate</button>
</form>


@forelse ($image_urls as $image_url)
    <img src="{{ $image_url }}" />
@empty
    <p>No images</p>
@endforelse
