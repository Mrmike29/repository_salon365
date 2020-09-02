var socket =  io.connect('127.0.0.1:2083', {
    'forceNew': true
});

function execute_room(data){
    socket.emit('rooms_message',data)
}

socket.on('room_message',function(data){
    var instagramIcon = '<i class="fa fa-instagram" style="color: #FFFC00" aria-hidden="true"></i>';
    var instagramNote = data;
    $("body").overhang({
      type: "confirm",
      primary: "#9b59b6",
      accent: "#8e44ad",
      message: instagramIcon + instagramNote,
      custom: true,
      html: true,
      overlay: true,
      overlayColor: "#1abc9c",
      callback: function (value) {
        if (value) {
          window.location.href = "https://goova.co/listar/sala";
        } else {
          alert("Maybe next time then...");
        }
      }
    });
})


socket.on('messages', function(data) {

    let user = document.getElementById('bell-icon');

    console.log(data[0]);

    $('#notifications').append(
        '<div class="white-box">' +
            '<div class="p-h-20">' +
                '<p class="notification">' +
                    data[0].text +
                '</p>' +
            '</div>' +
        '</div>'

    )




    if (user != null) {

        let notiUser = user.getAttribute('data-badge');

        let idUser = user.getAttribute('data-user');



        data.forEach(function (item) {

            if ((item.id * 1) === (idUser * 1)) {

                user.setAttribute('data-badge', (notiUser * 1) + 1);

                notifyMe(item.autor, 'https://s3-us-west-2.amazonaws.com/crearp/crearp/produccion/storage/img/default/happy-box-compress.png', item.text, item.text);

            }

        });

    }

});



function addMessage(data, name, text) {

    // if (data.length > 0) {

        let message = [];

        // data.forEach(function (item) {

            message.push({ autor: name, text: text});

        // });

        socket.emit('new-message', message);

    // }

    return false;

}



function notifyMe(theTitle, theIcon, theBody,theText) {

    if (!("Notification" in window)) {

        notiIE(theIcon,theTitle,theText);

    }



    else if (Notification.permission === "granted") {

        // If it's okay let's create a notification

        spawnNotification(theBody,theIcon,theTitle);

    }



    else if (Notification.permission !== 'denied') {

        Notification.requestPermission(function (permission) {

            if (permission === "granted") {

                var notification = new Notification("Hi there!");

            }

        });

    }

}



Notification.requestPermission().then(function(result) { console.log(result); });



function spawnNotification(theBody,theIcon,theTitle) {

    let options = {

        body: theBody,

        icon: theIcon

    };

    let n = new Notification(theTitle,options);

}



function notiIE(image,theTitle,theText) {

    $.gritter.add({

        title: theTitle,

        text:theText,

        image: image,

        sticky: false,

        before_open: function(){

            if($('.gritter-item-wrapper').length == 3)

            {

                return false;

            }

        }

    });

}

