@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class = "chat-content"></div>
                <ul class="ul">
                  
                </ul>
           <div class="chat-form">
           <div class="form-group">
                <label for="enter-name">Enter Name</label>
                <input type="email" class="form-control" id="enter-name" placeholder="Enter name">
           </div>
           <div class="form-group row">
                 <div class="col-sm-10">
                    <label for="enter-chat">Enter Chat</label>
                    <textarea class="form-control" id="enter-chat" rows="3"></textarea>
                 </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <button type="submit" id ="submit-chat" class="btn btn-primary mb-2 send-button">Send</button>
                </div>
            </div>
          
           </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="{{ asset('js/socket.js') }}" ></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js" ></script> -->
<script type="text/javascript">
    var socket = io.connect('http://localhost:8881');
    jQuery(document).ready(function($){
        $('#submit-chat').click(function(){
            if($('enter-chat').val() != ""){
                var data = {'name': $('#enter-name').val(), 'message': $('#enter-chat').val()}
                socket.emit('sendChatToServer', data)
                $('#enter-chat').val('');
            }else{
                alert('Please enter text to chat');
            }
            return false;
        });
        socket.on('serverChatToClient', function(message){
            console.log(message);
            $('.ul').append('<li><strong>' + message.name + '</strong>' + ' ' + message.message +'</li>');
        });
    });
</script>
@endsection
