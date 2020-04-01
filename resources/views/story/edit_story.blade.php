@extends('master')

@section('title')
    <h5 class="navbar-brand"><i class="fab fa-adn"></i> Edit Stories</h5>
@endsection

@section('content')

    <div class="row p-4">
    <div class="col-md-6">
      <form action="{{ route('stories.update', $story->id) }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value={{csrf_token()}}>
        
        <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" class="form-control" id="title" placeholder="Enter Story Title" name="title" value="{{ $story->title }}" required>
        </div>
        
        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category_id" required>
                <option value="{{ $story->tbl_category_id }}" selected="selected">{{$story->category->name}}</option>";
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
          <label for="sound">Mp3 Sound File: </label>
          <br>
          <audio controls="controls"><source src="{{ asset('uploads/audio/story/'.$story->audio)}}" type="audio/mpeg"></audio>
          <br>
          
          <label class="radio-inline"><input type="radio" name="optradio" id="none" onclick="CheckField();" value="None" checked="checked"> None</label>
          <label class="radio-inline"><input type="radio" name="optradio" id="server" onclick="CheckField();" value="Server"> Server</label>
          <label class="radio-inline"><input type="radio" name="optradio" id="external" onclick="CheckField();" value="External"> External Link</label>

          <input id="sound" type="file" class="form-control-file" name="audio" style="display:none" accept="audio/mp3">
          <input id="path" type="text" class="form-control" name="path" style="display:none" value="{{ $story->audio }}" placeholder="Enter External Path">
        </div>

        <div class="form-group">

          <label for="img">Image File</label><br>
          <img src="{{ asset('uploads/img/story/'.$story->img)}}" class="img-thumbnail" alt="" width="100" height="100">
          <br>
          <label class="radio-inline"><input type="radio" name="imgradio" id="imgnone" onclick="CheckImageFieldUpdateStory();" value="None" checked="checked"> None</label>
          <label class="radio-inline"><input type="radio" name="imgradio" id="imgserver" onclick="CheckImageFieldUpdateStory();" value="Server"> Server</label>

          <input id="img" type="file" class="form-control-file" name="image" style="display: none;" accept="image/x-png,image/jpeg,image/jpg">
        </div>

        <div class="form-group">
          <label for="story">Story:</label>
          <textarea class="form-control" rows="10" id="ckeditor2" name="story" placeholder="Enter Story" required>{{ $story->story }}</textarea>
        </div>

        <button type="submit" class="btn btn-success font-weight-bold">Save Story</button>
        <a role="button" class="btn btn-secondary" href="{{ route('stories.index') }}">Close</a>
      </form>
    </div>
    </div>
    </div>
    </div>
    <!-- CK EDITOR -->
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    
    <script>
        var editor = CKEDITOR.replace('ckeditor2');
        editor.on( 'required', function( evt ) {
            editor.showNotification( 'This field is required.', 'warning' );
            evt.cancel();
        } );
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    function CheckField() {
        if (document.getElementById('external').checked) {
            document.getElementById('path').style.display = 'block';
            document.getElementById('sound').style.display = 'none';
            document.getElementById('sound').value = '';

            document.getElementById("sound").required = false;
            document.getElementById("path").required = true;
        }
        else if(document.getElementById('server').checked){
        document.getElementById('path').style.display = 'none';
        document.getElementById('path').value = '';
        document.getElementById('sound').style.display = 'block';

        document.getElementById("sound").required = true;
        document.getElementById("path").required = false;
        }
        else{
        document.getElementById('path').style.display = 'none';
        document.getElementById('sound').style.display = 'none';

        document.getElementById('sound').value = '';
        document.getElementById('path').value = '';
        document.getElementById("sound").required = false;
        document.getElementById("path").required = false;
        }
    }
    function CheckImageField() {
        if(document.getElementById('imgserver').checked){
        document.getElementById('img').style.display = 'block';
        document.getElementById("img").required = true;
        
        }
        else{
        document.getElementById('img').style.display = 'none';
        document.getElementById('img').value = '';
        document.getElementById("img").required = false;
        }
    }
    function CheckImageFieldUpdateStory() {
        if(document.getElementById('imgserver').checked){
        document.getElementById('img').style.display = 'block';
        
        }
        else{
        document.getElementById('img').style.display = 'none';
        document.getElementById('img').value = '';
        }
    }
</script>


@endsection