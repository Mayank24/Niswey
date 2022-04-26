$("#lanuchModal").click(function() {
    $(".modal").addClass("is-active");  
});

$(".modal-close, .delete, .cancel").click(function() {
    $(".modal").removeClass("is-active");
});

$("#closebtn").click(function() {
    $(".modal").removeClass("is-active");
});


// Step 1: Select all the delete buttons 
// which are inside notification element 
// and loop over them using forEach
document.querySelectorAll(".notification .delete")
    .forEach(function ($deleteButton) {

        // Step 2: Get the parent notification 
        // of the delete button
        const parentNotification = $deleteButton.parentNode;

        // Add click event listener on delete 
        // button and when the button get clicked
        // remove the parent notification
        $deleteButton.addEventListener('click', function () {
            parentNotification.parentNode
                .removeChild(parentNotification);
        });
    });

var edit = document.querySelectorAll('.editContact');
var modal = document.querySelector('.modal');

for (let index = 0; index < edit.length; index++) {
    edit[index].addEventListener('click', function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "contacts/edit/"+edit[index].getAttribute('value'),
            type : 'GET',
            success : function(result){
                console.log(result);
                modal.classList.add("is-active");
                document.querySelector(".name").value                       = result.name;
                document.querySelector(".lastname").value                   = result.lastname;
                document.querySelector(".phone").value                      = result.phone;
                document.querySelector(".id").value                         = result.id;
                document.querySelector(".formModal").setAttribute("action", "contacts/update/"+edit[index].getAttribute('value'));
                document.querySelector(".modal-card-title").textContent     = "Update Contact";
            }
        });
    });
}


