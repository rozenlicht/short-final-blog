<figure>
    <figcaption>{{ $audioFragment->name }} (audio fragment)</figcaption>
    <audio controls src="{{ Storage::url($audioFragment->path) }}"></audio>
</figure>
