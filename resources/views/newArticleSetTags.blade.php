<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" ></script>
<input type="text" id="tag_search" name="keyword">
<div class="tags" STYLE="padding: 20px;border: 1px solid red">

</div>
<div class="tags_container" STYLE="padding: 20px;border: 1px solid red">

</div>
<div class="form_tags">
    <form action="" id="form_tags">

        <input type="submit" id="submit">
    </form>
</div>


<script>

    $(document).ready(function(){
        let tagsList = [];
        $('#submit').hide();
        $('#tag_search').on('input',function (){
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
            if(tagsList.indexOf(click_id) === -1){
                tagsList.push(click_id);
                console.log(tagsList);
                $('.tags_container').append('<div class="tag_item" id="tag_item'+click_id+'"><div>'+$(this).text()+'</div>'+'<div class="delete_tag" id="'+click_id+'">x</div></div>');
                $('.form_tags').append('<input type="text" id="tag_input'+click_id+'" value="'+click_id+'"/>');
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
    .tags_container{
        display: flex;

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
    }

</style>

