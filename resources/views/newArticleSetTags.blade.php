<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" ></script>
<div class="wrapper">
    <div class="tags_container">

    </div>
    <input type="text" id="tag_search" name="keyword">

    <div class="tags">
    </div>
    <div class="form_tags">
        <form action="{{route('setTag')}}" id="form_tags" method="post">
            @csrf
            <input type="submit" id="submit">
        </form>
    </div>
</div>
<script>

    $(document).ready(function(){
        let tagsList = [];
        $('#submit').hide();
        $('.tags').hide();
        $('#tag_search').on('input',function (){

            if(tagsList.length === 5){
                $('.tags').hide();
            }else{
                $('.tags').show();
            }
            let keyword = $('#tag_search').val();
            $.ajax({
                url:"{{route('searchTags')}}",
                type:"post",
                data:{
                    "_token":"{{csrf_token()}}",
                    keyword:keyword
                },
                success:(res)=>{
                    let tags = '';
                    for(let i=0;i<5;i++){
                        try {
                            tags = tags + '<div><div class="tag_class" id="'+res[i].id+'">'+res[i].tag_name+'</div></div> <br>';
                        }catch (ex){

                        }
                    }
                    console.log(tags);
                    $('.tags').html(tags);
                }
            });
        });

        $('.tags').on('click','.tag_class',function (e){
            let click_id = $(this).attr('id');
            if(tagsList.length === 5){
                $('.tags').hide();
            }else{
                $('.tags').show();
            }
            if(tagsList.indexOf(click_id) === -1){
                tagsList.push(click_id);
                console.log(tagsList);
                $('.tags_container').append('<div class="tag_item" id="tag_item'+click_id+'"><div>'+$(this).text()+'</div>'+'<div class="delete_tag" id="'+click_id+'">x</div></div>');
                $('#form_tags').append('<input type="hidden" id="tag_input'+click_id+'" name="id_input[]" value="'+click_id+'"/>');
                $('#submit').show();
            }

        })

        $('.tags_container').on('click','.delete_tag',function (e){
           let click_id = $(this).attr('id');
           $('#tag_item'+click_id).remove();
           $('#tag_input'+click_id).remove();
           tagsList = $.grep(tagsList,(value)=>{
               return value !== click_id;
           });
           console.log(tagsList)
            if(tagsList.length === 0) {
                $('#submit').hide();
            }
        });
    })
</script>
<style>
    *{
        font-family: Arial,sans-serif;
    }

    .wrapper{
        max-width: 980px;
        margin: 0 auto;
    }

    .tags_container{
        display: flex;

    }

    .tags{
        border-top: 0;
        border-bottom: 1px solid grey;
        border-right: 1px solid grey;
        border-left: 1px solid grey;
        width: 99.8%;
        overflow: auto;
        height: 150px;
    }

    .tags{


    }

    .tags_container *{
        margin: 5px 10px;
    }

    .tag_item{
        background: #3f9ae5;
        display: flex;
        color: white;
        align-items: center;
    }

    .delete_tag:hover{
        cursor: pointer;
    }

    .tag_class:hover{
        cursor: pointer;
        background-color: #8ba9bc;
        color: white;
    }

    #tag_search{
        font-size: 20px;
        outline: none;
        width: 100%;
    }

    .tag_class{
        padding: 5px 20px;
        margin: 0;
        color: #8ba9bc;
        font-size: 15px;

    }

    .tag_item:first-child{
        margin-left: 0;
    }

</style>

