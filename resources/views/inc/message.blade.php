@if(Session::has('info'))
    <!-- This will make a Toast for Message -->
    <script>
        M.toast({
            html: "<span>{{Session::get('info')}}<span><button class='btn-flat toast-action' onclick='toackInstance.dismiss()'><i class='material-icons'>close<i></button>",
                classes:'rounded',
                inDuration:1000,
                outDuration:1000
        });
        var toastElement = document.querySelector('.toast');
        var toastInstance = M.Toast.getInstance(toastElement);
    </script>
@endif