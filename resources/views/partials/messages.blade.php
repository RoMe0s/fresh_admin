<!-- Flash Messages -->

<script>
    window.messages = {};
    @foreach(session()->pull('flash_messages', []) as $type => $messages)
        toastr['{{$type}}']({!! json_encode($messages) !!});
    @endforeach
</script>

<!-- End Flash Messages -->