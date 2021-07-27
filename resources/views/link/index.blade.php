@extends('layouts.app')

@section('content')
    @if(session('short_url'))
        <div class="input-group mt-3">
            <input id="short_url" type="text" class="form-control" value="{{ session('short_url') }}">
            <div class="input-group-append">
                <a href="{{ session('short_url') }}" target="_blank" type="button" class="btn btn-outline-success">Open</a>
                <button type="button" class="btn btn-outline-success" onclick="copyText()">Click to Copy</button>
            </div>
        </div>
    @endif

    <div class="card mt-3">
        <div class="card-header">
            Enter a URL to Shorten
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('link.store') }}">
                @csrf
                <input type="text" class="form-control mb-2" name="url" value="{{ old('url') }}" required>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>

@endsection

<script type="text/javascript">
    function copyText() {

      var text = document.getElementById("short_url");
      text.select();
      document.execCommand("copy");

      alert("Copied to clipboard: " + text.value);
    }
</script>