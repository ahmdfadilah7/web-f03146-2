@section('js')

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
{{-- Toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    @if(Session::has('success'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
    }
            toastr.success("{{ session('success') }}");
    @endif
    
    @if(Session::has('errors'))
    toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        @foreach ($errors->all() as $errors)
            toastr.error("{{ $errors }}");
        @endforeach
    @endif
    
    @if(Session::has('warning'))
        toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>

@endsection