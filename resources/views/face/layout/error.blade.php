@if(\Illuminate\Support\Facades\Session::has('error'))

    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">
            &times;
        </button>
        {{\Illuminate\Support\Facades\Session::get('error')}}
    </div>
@endif