@extends('layouts.base')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1>Message send receive</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <form action="" method="POST" id="message-form" onsubmit="handleOnSubmit(this)">
                <div class="form-group mb-2">
                    <label for="">message</label>
                    <input type="text" class="form-control" name="message">
                </div>
                <div class="form-group mb-2">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h4>Received:</h4>
            <div id="message-recived" class="border" style="height: 250px">

            </div>
        </div>
    </div>


</div>
    
@endsection

@push('script-footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.7/axios.min.js" integrity="sha512-NQfB/bDaB8kaSXF8E77JjhHG5PM6XVRxvHzkZiwl3ddWCEPBa23T76MuWSwAJdMGJnmQqM0VeY9kFszsrBEFrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    let messageReceivedDiv=document.getElementById('message-recived')
    let url=`{{ url('api/send-message') }}`
    const handleOnSubmit=async(e)=>{
        event.preventDefault()

        let fd=new FormData(e)

        try {
            const res=await axios.post(url,fd)
            e.reset()
            // console.log('INFO',res);
        } catch (error) {
            console.log('ERROR',error);
        }
    }



    // message listen 

    Echo.channel('message-channel')
    .listen('.message.sent',(e)=>{
        console.log('INFO','channel',e.message);
        const node=document.createElement('p')
        node.innerText=e.message
        messageReceivedDiv.appendChild(node)
    })

</script>
@endpush