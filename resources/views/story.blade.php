@extends('HomeMaster')

@section('title')
    {{ $story->title }}
@endsection

@section('content')

    
    <div class="jumbotron">
        <h1>{{ $story->title }}</h1><hr>
        @if(file_exists(public_path().'/uploads/img/story/' . $story->img))
            <img src="{{ asset('uploads/img/story/' . $story->img) }}" class="img-thumbnail mx-auto d-block" alt="Image" height="200" width="auto">
        @endif
        <p name="name" id="IDStory" >{!! $story->story !!}</p>

        <div class="col-6 d-flex justify-content-end">
            <span class="badge badge-info"style="height:17px; font-size: 10px; letter-spacing: 1px;" id="btn-like"><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                <span id="like-value"> {{ $story->likes }}</span>
            </span>
        </div>

        <button type="button" class="btn btn-outline-info" onclick="quay_lai_trang_truoc()">Quay lại</button>
    </div>

    <script type="text/javascript">
            $("#btn-like").click(function() {
                $.ajax({
                    url: "{{ route('like', $story->id) }}", 
                    data: "",
                    type: "POST", 
                    processData: false,
                    contentType: false, 
                    success: function(ketqua) {
                        $("#like-value").text(ketqua.solikela)

                    }
                });
            });
    </script> 
    {{-- Khi nút có id là btn-like đc kick vào, thì chuyển đến url có route trên, do ko cần data nên data là rỗng, trong route đó sẽ thực hiện 1 hành động gì đó, rồi trả về giá trị là story->likes --}}
    <script>
        function quay_lai_trang_truoc(){
            history.back();
        }
    </script>
@endsection