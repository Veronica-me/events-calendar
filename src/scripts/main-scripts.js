


function validateForm() {
    // Get form data
    const date = document.getElementById('eventDate').value;
   
    // Check if the date is today or in the future
    const selectedDate = new Date(date);

    const controlDate = new Date();
    controlDate.setDate(controlDate.getDate() - 1);

    if (selectedDate < controlDate) {
        alert('Date must be today or in the future');
        return false;
    }
    return true;
  }

  document.addEventListener('DOMContentLoaded', function() {
    
    if (document.querySelector('#eventForm')) {
        document.querySelector('#eventForm').addEventListener('submit', submitForm);
    }
    });
  // Function to handle form submission
  function submitForm(event) {
    event.preventDefault();
      

    if (!validateForm()) {
      return;
    }

 
    const formData = {
      date: document.getElementById('eventDate').value,
      title: document.getElementById('eventTitle').value,
      time: document.getElementById('eventTime').value,
      place: document.getElementById('eventPlace').value,
      description: document.getElementById('eventDescription').value,
    };

   // console.log(formData);

    $.ajax({
      type: 'POST',
      url: 'src/Controllers/EventController.php', 
      data: formData,
      success: function(response) {
        // Handle the server response (if needed)
        console.log(response);
      },
      error: function(error) {
        // Handle errors (if needed)
        console.error(error);
      }
    });


  }



  $(function() {
    $('#datepicker').datepicker();
    $('#datepicker').datepicker('setDate', new Date());
    
  });