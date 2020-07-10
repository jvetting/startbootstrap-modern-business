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
      var confirmation = $("input#confirmation").val();
      var reply = $("select#reply").val();
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
      console.log(confirmation);
      console.log(reply);

      //Ticket format: year-month-day/short_uid
      //uid format: First initial + last intial + random num b/w 0-9 ex:'JV'
      //random num possibilites: (26^2)*10 ~ 6,760 unique combos a day
      var date = new Date();
      var name_arr = name.split(" ");
      var uid = name_arr[0].substring(0,1)+name_arr[1].substring(0,1)+(Math.floor(Math.random() * (9 - 0 + 1)) + 0);
      var ticket = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDay()+"/"+uid;
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
          form: "contact",
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
          ticket: ticket,
          reply: reply
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

  /**-------------------------------------------------------------------------------------------------------------------
   * Link contact.html to feedback.html
   * (w.i.p.)
   */
  /*
  $("#feedbackContact input,#contactForm textarea").jqBootstrapValidation({

  });
   */
  /**--------------------------------------------------------------------------------------------------------------------
  Feedback form script
   */
  $("#feedbackForm input,#feedbackForm textarea").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function($form, event, errors) {
      // additional error messages or events
    },
    submitSuccess: function($form, event) {
      event.preventDefault(); // prevent default submit behaviour
      // get values from FORM
      var email = $("input#email").val();
      var confirmation = $("input#confirmation").val();
      console.log(email);
      //----------------------------------------------------------------------------------------------------------------
      var header = document.getElementById("feedback");
      var btns = header.getElementsByClassName("btn btn-feedback");
      console.log("CONF:btns length:"+btns.length);
      console.log(i)
      var active = document.getElementsByClassName("btn btn-feedback active");
      console.log("active length:"+active.length);
      if(active.length==0){
        return;
      }
      var last_active = active[active.length-1].id;
      var rating = last_active.charAt(last_active.length-1);

      console.log(rating);
      console.log(confirmation);

      //var message = header + $("textarea#message").val();//$("textarea#message").val();
      //----------------------------------------------------------------------------------------------------------------
      var message = $("textarea#feedbackMessage").val();
      console.log(message);
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
          form: "feedback",
          name: name,
          email: email,
          message: message,
          rating: rating
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
          $('#success > .alert-danger').append($("<strong>").text("Sorry, it seems that my mail server is not responding. Please try again later!"));
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

  $('body').on('click', '.feedback-submit', function (e) {
    var feedbackForm = document.getElementById("feedbackForm");
    console.log(feedbackForm.id);
    $(feedbackForm).submit();
    //$('#exampleModal').modal('hide');
  });
});

/*When clicking on Full hide fail/success boxes */
$('#name').focus(function() {
  $('#success').html('');
});

/*
$(document).ready(function() {

  // Get click event, assign button to var, and get values from that var
  $('#feedback button').on('click', function () {
    var thisBtn = $(this);

    thisBtn.addClass('active').siblings().removeClass('active');
    var btnId = thisBtn.id;
    //var btnValue = thisBtn.val();
    console.log(btnId);

    //$('#selectedVal').text(btnValue);


    // You can use this to set default value
    // It will fire above click event which will do the updates for you
    //$('#aBtnGroup button[value="M"]').click();

    // Add active class to the current button (highlight it)
    var header = document.getElementById("feedback");
    var btns = header.getElementsByClassName("btn btn-feedback");
    console.log("btns length:"+btns.length);
    for (var i = 0; i < btns.length; i++) {
      console.log(i)
      btns[i].addEventListener("click", function() {
        var current=$(this);
        console.log("current:"+current.id);
        var inactive = $('#feedback button');
        //document.getElementsByClassName("btn btn-feedback");
        var active =
            //document.getElementsByClassName("btn btn-feedback active");

        //console.log("id:"+this.id);

        console.log("inactive length:"+inactive.length);
        console.log("active length:"+active.length);

        var rating = this.id.charAt(this.id.length-1);

        console.log("rating:"+rating);

        for(var i = 0; i < inactive.length; i++) {

          if (i < rating) {
            inactive[i].className = "btn btn-feedback active";
            $('#feedback button[i]').className="btn btn-feedback active";
          } else {
            inactive[i].className = "btn btn-feedback";
            $('#feedback button[i]').className="btn btn-feedback";
          }


          console.log(i);
          console.log(inactive[i].id + ":" +inactive[i].className);

        }
      });
    }
  })
});

 */
