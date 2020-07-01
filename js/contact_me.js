$(function() {

  $("#contactForm input,#contactForm textarea").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function($form, event, errors) {
      // additional error messages or events
    },
    submitSuccess: function($form, event) {
      event.preventDefault(); // prevent default submit behaviour
      // get values from FORM
      var name = $("input#name").val();
      var email = $("input#email").val();
      var phone = $("input#phone").val();
      //----------------------------------------------------------------------------------------------------------------
      var exists = $("select#exists").val();
      var type = $("select#type").val();
      var address_line1 = $("input#address-line1").val();
      var address_line2 = $("input#address-line2").val();
      var city = $("input#city").val();
      var region = $("select#region").val();
      var postal_code = $("input#postal-code").val();
      console.log(name);
      console.log(email);
      console.log(phone);
      console.log(address_line1);
      console.log(address_line2);
      console.log(city);
      console.log(region);
      console.log(postal_code);
      console.log(exists);
      console.log(type);

      //Ticket format: year-month-day/short_uid
      //uid format: First initial + last intial + random num b/w 0-9 ex:'JV'
      //random num possibilites: (26^2)*10 ~ 6,760 unique combos a day
      var date = new Date();
      var name_arr = name.split(" ");
      var uid = name_arr[0].substring(0,1)+name_arr[1].substring(0,1)+(Math.floor(Math.random() * (9 - 0 + 1)) + 0);
      var ticket = date.getFullYear()+"-"+date.getMonth()+"-"+date.getDay()+"/"+uid;
      console.log(ticket);

      //var message = header + $("textarea#message").val();//$("textarea#message").val();
      //----------------------------------------------------------------------------------------------------------------
      var message = $("textarea#message").val();
      console.log(message);
      var firstName = name; // For Success/Failure Message
      // Check for white space in name for Success/Fail message
      if (firstName.indexOf(' ') >= 0) {
        firstName = name.split(' ').slice(0, -1).join(' ');
      }
      $this = $("#sendMessageButton");
      $this.prop("disabled", true); // Disable submit button until AJAX call is complete to prevent duplicate messages
      /*
      $.ajax({
        url: "././mail/contact_me.php",
        type: "POST",
        data: {
          name: name,
          phone: phone,
          email: email,
          message: message
        },
      */

      $.ajax({
        url: "././mail/contact_me.php",
        type: "POST",
        data: {
          name: name,
          phone: phone,
          email: email,
          address_line1: address_line1,
          //address_line2: address_line2,
          city: city,
          region: region,
          postal_code: postal_code,
          exists: exists,
          type: type,
          message: message,
          ticket: ticket
        },

        cache: false,
        success: function() {
          // Success message
          $('#success').html("<div class='alert alert-success'>");
          $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#success > .alert-success')
            .append("<strong>Your message has been sent. </strong>");
          $('#success > .alert-success')
            .append('</div>');
          //clear all fields
          $('#contactForm').trigger("reset");
        },
        error: function() {
          // Fail message
          $('#success').html("<div class='alert alert-danger'>");
          $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#success > .alert-danger').append($("<strong>").text("Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!"));
          $('#success > .alert-danger').append('</div>');
          //clear all fields
          $('#contactForm').trigger("reset");
        },
        complete: function() {
          setTimeout(function() {
            $this.prop("disabled", false); // Re-enable submit button when AJAX call is complete
          }, 1000);
        }
      });
    },
    filter: function() {
      return $(this).is(":visible");
    },
  });

  $("a[data-toggle=\"tab\"]").click(function(e) {
    e.preventDefault();
    $(this).tab("show");
  });
});

/*When clicking on Full hide fail/success boxes */
$('#name').focus(function() {
  $('#success').html('');
});
