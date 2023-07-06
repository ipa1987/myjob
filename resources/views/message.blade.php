        @if(Session::has('successMsg'))

            <div class="alert alert-success">{{ Session::get('successMsg') }}</div>

        @endif


        @if(Session::has('errorMsg'))

            <div class="alert alert-danger">{{ Session::get('errorMsg') }}</div>

        @endif