<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" ></script>
<form action="{{route('setTag')}}" id="form" method="post">
    @csrf
    <label for="validationDefault04" class="form-label">Категория</label>
    <select class="form-select" id="validationDefault04" name="tagId" multiple="multiple" required>
        <option selected disabled value="">Выберите...</option>
        @foreach($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
        @endforeach
    </select>
    <input type="submit">

</form>
<button onclick="" id="button">dsasdsad</button>

<script>
    let tags = $('#');



    // let values = $('#validationDefault04').val();
    // $('#button').click(()=>{
    //
    //     console.log(values);
    // });


    $('#form').submit((e)=>{
        $.ajax({
            url: "{{route('setTag')}}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                tags:tags
            },
            success:function(response){
                console.log(response);
            },
        });
    })


    // $('.form-select').on('change', function(event) {
    //     event.preventDefault();
    //     $('#form').submit();
    // });
    //
    // $('form').submit(function(event) { //Отправка всех форм
    //     console.log(123);
    // });
</script>


