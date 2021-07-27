@foreach ($errors->all() as $error)
    <div class="alert alert-danger mt-3" role="alert">
      {{ $error }}
    </div>
@endforeach