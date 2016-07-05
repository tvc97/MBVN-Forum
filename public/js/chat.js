function getCaret(el) { 
    if (el.selectionStart) { 
        return el.selectionStart; 
    } else if (document.selection) { 
        el.focus();
        var r = document.selection.createRange(); 
        if (r == null) { 
            return 0;
        }
        var re = el.createTextRange(), rc = re.duplicate();
        re.moveToBookmark(r.getBookmark());
        rc.setEndPoint('EndToStart', re);
        return rc.text.length;
    }  
    return 0; 
}

function post() {

    msg = $('#msg').val();
    $.post('http://mbvn.dev/chat/ajax_post/', { content : msg }, function(data){
        $('#chat').html(data);
    });
    $('#msg').val("");

}

var last = 0;

function load_chat() {
    $.get('http://mbvn.dev/chat/ajax_load/' + last +'/', function(data) {
        data = data.trim();
        if(data != '0') {
            last = parseInt(data.substring(0, 8));
            data = data.substring(8);
            $('#chat').html(data);
        }
        setTimeout(load_chat, 5000);
    });
}

$(document).ready(function(){

    setTimeout(load_chat, 5000);


    $('.chat-form').submit(function(e){
        e.preventDefault();

        post();
    });

    $('#msg').keyup(function (event) {
        if (event.keyCode == 13) {
            var content = this.value;  
            var caret = getCaret(this);          
            if(event.shiftKey){
                this.value = content.substring(0, caret - 1) + "\n" + content.substring(caret, content.length);
                event.stopPropagation();
            } else {
                this.value = content.substring(0, caret - 1) + content.substring(caret, content.length);
                post();
            }
        }
    });

});