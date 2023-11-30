


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

  $.ajax({
      type: 'POST',
      url: 'src/Controllers/EventController.php',
      data: formData,
      success: function (response) {
          console.log(response);
          clearForm();
          
          fetchUpdatedEvents();
      },
      error: function (error) {
          console.error(error);
      }
  });
}

// Function to fetch updated events and update the planner
function fetchUpdatedEvents() {
  fetch(`src/Controllers/EventsOutputController.php?action=getAllEvents`)
      .then(response => response.json())
      .then(data => {
          eventsData = organizeEventsByDate(data.events || []);
          updatePlanner();
      })
      .catch(error => console.error('Error fetching events:', error));
}

function clearForm() {
  document.getElementById('eventDate').value = '';
  document.getElementById('eventTitle').value = '';
  document.getElementById('eventTime').value = '';
  document.getElementById('eventPlace').value = '';
  document.getElementById('eventDescription').value = '';
}



  $(function() {
    $('#datepicker').datepicker();
    $('#datepicker').datepicker('setDate', new Date());
    
  });


  