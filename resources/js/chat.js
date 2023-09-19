import './bootstrap';

(function($) {
    function getMessages(page = 1) {
        $.ajax({
            method: "get",
            url: messages.list_url,
            headers: {
               "x-api-key" : "dsjkfjfdgidfjhglfdjkjkfdjkdfdsf"
            },
            success: function(response) {
                for (let i in response.data) {
                    let message = response.data[i];
                    addMessage(message , true)

                }
            }
        })
    }

    function addMessage(message, prepend = false) {

        let html = `<div class="bg-success-subtle rounded p-2 mt-2">
                    <div>
                   <b>${message.sender.name} - <span class="text-muted">${message.sent_at}</span></b>
                    </div>

                    <div>
                        ${message.body}
                    </div>
                </div>`;

        if (prepend) {
            return $('#messages').prepend(html);
        }
        $('#messages').append(html);
    }

    function send(message) {
        $.post(
            messages.store_url,
            {
                _token: csrf_token,
                body: message
            },

            function() {
                addMessage({
                    sender: {
                        name: user.name,
                    },
                    body: message,
                    sent_at: (new Date()).toString()
                })
            }

        );
    }

    $("#message-form").on('submit', function(e) {
        e.preventDefault();
        send($(this).find('textarea').val());
        send($(this).find('textarea').val(""));
    })

    $(document).ready(function() {
        getMessages();
    })

    let ch = Echo.join('classroom-' + classroom)
    .here((users) => {
        for (let i in users) {
            let user = users[i];
            $('ul#users').append(`<li id="user-${user.id}">${user.name}</li>`)
        }
    })
    .joining((user) => {
            $('ul#users').append(`<li id="user-${user.id}">${user.name}</li>`)
    })
    .leaving((user) => {
            $(`li#user-${user.id}`).remove()
    })
    .listen('.new-message' , function (event) {
            addMessage(event)
    });

    // $('#message-form textarea').on('input' , function(e) {
    //     ch.whisper('typing' , {
    //         name: user.name
    //     })
    // })

})(jQuery);

