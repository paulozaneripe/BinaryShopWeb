@if(Session::get('warning')).
    <div class="message-spans">
        <span class="warning fade-in" onclick="hideError(this)">{{ Session::get('warning') }}</span>
    </div>
@endif
@if(Session::get('success'))
    <div class="message-spans">
        <span class="success fade-in" onclick="hideError(this)">{{ Session::get('success') }}</span>
    </div>
@endif
@if(Session::get('fail'))
    <ul>
        <li class="fade-in" onclick="hideError(this)">{{ Session::get('fail') }}</li>
    </ul>
@endif
@if(count($errors) > 0)
    <ul>
        @foreach($errors->all() as $error)
            <li class="fade-in" onclick="hideError(this)"> {{$error}} </li>
        @endforeach
    </ul>
@endif